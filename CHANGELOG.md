# Changelog
All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].


[2.0.0]: https://github.com/codekandis/phlags/compare/1.1.0...1.2.0
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


[1.2.0]: https://github.com/codekandis/phlags/compare/1.1.0...1.2.0
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


[1.1.0]: https://github.com/codekandis/phlags/compare/1.0.0...1.1.0
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


## 1.0.0 - 2017-08-30

### Added

* interface and abstract implementation of the flagable
* flagable and value validators
* flagable and value validation results
* exceptions
* `PHPUnit` tests
* `LICENSE`
* `README.md`



[xtlink-keep-a-changelog]: http://keepachangelog.com/en/1.0.0/
[xtlink-semantic-versioning]: http://semver.org/spec/v2.0.0.html
