# Video Share cli application

## Usage instructions

Install all the project dependencies via composer:

``` $ composer install ```

If php cli is globally available in your system, you can run the import command (found in bin/ directory) by typing:

``` $ import site-name ```

## Project structure

* **composer.json**         Package manager configuration file
* **SUMMARY.md**            This file
* **bin/**
    * **import.php**        Import command
* **config/**
    * **import.php**        Import command configuration (sites)
* **src/**
    * **Command/**          CLI app files
    * **Mapper/**           Video fields mapper
    * **Parse/**            Video feed response parsers
    * **Repository/**       Database handlers       
    * **Request/**          Request handlers
* **test/**                 Unit and functional testing

## Project dependencies

* [symfony/yaml](http://symfony.com/doc/current/components/yaml.html) YAML parser
* [phpunit/phpunit](https://phpunit.de/) Unit testing

## PHP version

I have written the cli app with maximum compatibility in mind, thus I have avoided the use of PHP7-only features like strict typing or new operators (null coalescing, spaceship...). I have run-test the app successfully with PHP 5.6 and PHP 7 interpreters, but it should be able to run with any interpreter version >= 5.4.

## Implemented design patterns

* Command pattern for the CLI app
* Chain of Responsibilities for the Requests and Parsing strategies
* Repository pattern for the data persistence strategies

### Unit and functional testing

You can run the tests by using the composer script:

``` $ composer test ```
 
Alternatively, if your system has phpunit globally available, you can run the tests with the command:

``` $ phpunit test ``` 
