#!/usr/bin/env php
<?php

namespace VideoShare;

require __DIR__ . '/../vendor/autoload.php';

use VideoShare\Command\App;
use VideoShare\Command\ArgvInput;
use VideoShare\Command\ImportCommand;
use VideoShare\Command\StreamOutput;

$app = new App();
$importConfigPath = __DIR__ . '/../config/import.php';
$cmdConfig = file_exists($importConfigPath) ? include $importConfigPath : [];
$app->setCommand(new ImportCommand($cmdConfig, new ArgvInput(), new StreamOutput()));
$app->run();
