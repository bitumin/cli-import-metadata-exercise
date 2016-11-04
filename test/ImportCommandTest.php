<?php

namespace VideoShare\Tests;

use VideoShare\Command\ImportCommand;
use VideoShare\Command\StreamOutput;
use VideoShare\Command\StringInput;

class ImportCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testAllowedSite()
    {
        $mockImportCmdConfig = [
            'sites' => [
                'test-site' => [
                    'request' => [
                        'type' => 'local_file',
                        'base' => __DIR__ . '/',
                        'filename' => 'test-feed.json'
                    ],
                    'parse' => [
                        'type' => 'json'
                    ],
                    'map' => [
                        'parent_key' => 'test-list',
                        'fields' => [
                            'field-1' => 'title',
                            'field-2' => 'url',
                            'field-3' => 'tags'
                        ]
                    ]
                ]
            ]
        ];

        $this->expectOutputString(<<<'EOF'
importing: "test-element-1"; Url: http://test.field-2/1; Tags: tag-1-1,tag-1-2,tag-1-3,tag-1-4,tag-1-5
importing: "test-element-2"; Url: http://test.field-2/2; Tags: tag-2-1,tag-2-2,tag-2-3,tag-2-4,tag-2-5
importing: "test-element-3"; Url: http://test.field-2/3; Tags: tag-3-1,tag-3-2,tag-3-3,tag-3-4,tag-3-5
importing: "test-element-4"; Url: http://test.field-2/4; Tags: tag-4-1,tag-4-2,tag-4-3,tag-4-4,tag-4-5
importing: "test-element-5"; Url: http://test.field-2/5; Tags: tag-5-1,tag-5-2,tag-5-3,tag-5-4,tag-5-5

EOF
        );

        $importCmd = new ImportCommand($mockImportCmdConfig, new StringInput('test-site'), new StreamOutput());
        $importCmd->execute();
    }

    public function testDisallowedSite()
    {
        $mockImportCmdConfig = [
            'sites' => ['good-1' => [], 'good-2' => []]
        ];
        $mockStreamOutput = $this->getMockBuilder(StreamOutput::class)
            ->setMethods(['callExit'])
            ->getMock();
        $mockStreamOutput->expects($this->any())
            ->method('callExit')
            ->will($this->returnCallback(function () {
                throw new \RuntimeException();
            }));

        $this->expectOutputString(<<<'EOF'
Error: Unknown site provided. List of allowed sites: good-1, good-2
Error: Import exited with code 1

EOF
        );


        $importCmd = new ImportCommand($mockImportCmdConfig, new StringInput('bad-site'), new $mockStreamOutput());
        $importCmd->execute();
    }

    public function testNoArgumentsProvided()
    {
        $mockImportCmdConfig = [
            'sites' => ['allowed-site-1', 'allowed-site-2', 'allowed-site-3']
        ];

        $mockStreamOutput = $this->getMockBuilder(StreamOutput::class)
            ->setMethods(['callExit'])
            ->getMock();
        $mockStreamOutput->expects($this->any())
            ->method('callExit')
            ->will($this->returnCallback(function () {
                throw new \RuntimeException();
            }));

        $this->expectOutputString(<<<'EOF'
Error: Required site parameter is missing
Error: Import exited with code 1

EOF
        );

        $importCmd = new ImportCommand($mockImportCmdConfig, new StringInput(null), new $mockStreamOutput());
        $importCmd->execute();
    }
}
