# CLI app - import metadata

## Usage instructions

Install all the project dependencies via composer:

``` $ composer install ```

If php cli is globally available in your system, you can run the import command (found in bin/ directory) by typing:

``` $ import site-name ```

## Project structure

* **composer.json**         Package manager configuration file
* **README.md**            This file
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

## Implemented design patterns

* Command pattern for the CLI app
* Chain of Responsibilities for the Requests and Parsing strategies
* Repository pattern for the data persistence strategies

### Unit and functional testing

You can run the tests by using the composer script:

``` $ composer test ```
 
Alternatively, if your system has phpunit globally available, you can run the tests with the command:

``` $ phpunit test ``` 
