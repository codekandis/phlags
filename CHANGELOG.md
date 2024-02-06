# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog 1.1.0][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

## [4.0.0] - 2024-07-28

### Fixed

* type hints
* method naming
* PHPDoc

### Changed

* composer package
  * changed
    * description
    * require
      * `php` [>=8.3]
    * require-dev
      * `codekandis/phpunit` [^5.0.0]
  * added
    * version
    * require
      * `ext-ctype` [*]
    * require-dev
      * `rector/rector` [^1.2.2]
    * autoload-dev
      * psr-4
        * `CodeKandis\Phlags\Build\`
          * `build/`
    * scripts
      * `test`
* PHPUnit tests
  * configuration
  * externalized data providers
* error and exception handling
* conditions in `ValueValidator`
* `CHANGELOG.md`
* `CODE_OF_CONDUCT.md`
* `README.md`
  * PHP version `8.3`

### Removed

* sealed classes

### Added

* read-only fields
* type hints
* `Override` attributes
* rector
  * configuration script
  * shell script
* `.gitattributes` to ignore dev-assets

[4.0.0]: https://github.com/codekandis/phlags/compare/3.0.0...4.0.0

---
## [3.0.0] - 2021-01-17

### Changed

* composer package dependencies.
  * removed
    * `sensiolabs/security-checker`
    * `phpunit/phpunit`
    * `phpmetrics/phpmetrics`
  * changed
    * `php` [^7.4]
  * added
    * `codekandis/phpunit` [^3]

[3.0.0]: https://github.com/codekandis/phlags/compare/2.0.0...3.0.0

---
## [2.0.0] - 2019-07-10

### Added

* flagable state to prevent issues with static members

### Changed

* added test cases for interfaces and removed obsolete test cases for specific classes
* name of the conditional maninipulation extension
* increased performance
* moved all unit tests to a new namespace

### Fixed

* a major issue caused while accessing static members

[2.0.0]: https://github.com/codekandis/phlags/compare/1.2.0...2.0.0

---
## [1.2.0] - 2019-07-01

### Added

* flagable instantiation with string values
* `CODE_OF_CONDUCT.md`
* `PHPUnit` configuration

### Changed

* argument types to instantiate and set a flagable with strings
* updates the tests
* the value validator due to multiple return points
* moved the package `roave/security-advisories` to the section `require-dev` in the `composer.json`
* the naming scheme of private members
* namespace syntax in all code files
* `README.md`

### Fixed

* the `PHPDoc` class description of the abstract flagable
* the values in all `PHPDoc` package tags
* `PSR-4` issues in the tests
* the imports in the code files
* the inheritance in the invalid flagable exception

[1.2.0]: https://github.com/codekandis/phlags/compare/1.1.0...1.2.0

---
## [1.1.0] - 2017-08-31

### Added

* flagable is iterable
* traitful features
* traitful feature: conditional manipulation
* additional `PHPUnit` tests

### Changed

* refactored manipulation methods
* package name, keywords and author information in `composer.json`
* `README.md`

### Fixed

* decreased performance due value validation
* decreased performance due stringifying the flagable
* `PHPDoc`

[1.1.0]: https://github.com/codekandis/phlags/compare/1.0.0...1.1.0

---
## [1.0.0] - 2017-08-30

### Added

* interface and abstract implementation of the flagable
* flagable and value validators
* flagable and value validation results
* exceptions
* `PHPUnit` tests
* `LICENSE`
* `README.md`

[1.0.0]: https://github.com/codekandis/phlags/tree/1.0.0



[xtlink-keep-a-changelog]: http://keepachangelog.com/en/1.1.0/
[xtlink-semantic-versioning]: http://semver.org/spec/v2.0.0.html
