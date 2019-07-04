# CodeKandis / Phlags

[![Version][xtlink-version-badge]][srclink-changelog]
[![License][xtlink-license-badge]][srclink-license]
[![Minimum PHP Version][xtlink-php-version-badge]][xtlink-php-net]

With Phlags you can declare flagable enums to provide types with varying and multiple states. While depending on binary operations Phlags provides high performance and reliabilty.

## Index

* [Installation](#installation)
* [How to use](#how-to-use)
    * [Declaration](#declaration)
    * [General hints](#general-hints)
    * [Instantiation](#instantiation)
    * [Reading](#reading)
    * [Determination](#determination)
    * [Manipulation](#manipulation)
    * [Fluent Manipulation](#fluent-manipulation)
    * [String Representation](#string-representation)
    * [Traitful Extensions](#traitful-extensions)
        * [Conditional Manipulation](#conditional-manipulation)
* [Validation](#validation)
    * [Flagables](#flagables)
    * [Values](#values)

## Installation

Install the latest version with

```bash
$ composer require codekandis/phlags
```

## How to use

**Example: Simple permissions in a file system**

### Declaration

Declare a class extending the flagable base class [`AbstractFlagable`][srclink-abstract-flagable].

```php
class Permissions extends AbstractFlagable
{
    public const READ     = 1;
    public const WRITE    = 2;
    public const EXECUTE  = 4;
}
```

### General Hints

In the context of manipulating the flagable the following values are supposed to be equal and can similarly passed to all methods of the flagable.

```php
1
Permissions::READ
new Permissions( 1 )
new Permissions( Permission::READ )
new Permissions( 'READ' );
```

In the other hand the type restriction of PHP does not allow any combination of an integer value with a string with a flagable.

```php
new Permission( 1 | 'READ' | new Permissions( READ ) )
```

### Instantiation

You can easily instantiate your flagable in different ways.

```php
// with the default flag 'Permissions::NONE' (inherited from `FlagableInterface::NONE`)
$permissions = new Permissions();

// with a single flag
$permissions = new Permissions( Permissions::READ );

// with multiple flags
$permissions = new Permissions( Permissions::READ | Permissions::WRITE );

// with another flagable
$permissions = new Permissions( new Permissions( Permissions::READ ) );

// with string representations instead
$permissions = new ( 'READ' );
$permissions = new ( 'READ|WRITE' );
```   

### Reading

You can read the value of the flagable in 2 different ways.

```php
$permissions = new Permissions( Permissions::READ );
echo $permissions->getValue();    // 1
echo $permissions();              // 1
```

### Determination

You can determine if one or more specific flags have been set.

```php
$permissions = new Permissions( Permissions::READ | Permissions::WRITE );
$permissions->has( Permissions::READ );       // true
$permissions->has( Permissions::WRITE );      // true
$permissions->has( Permissions::EXECUTE );    // false
```

### Manipulation

You can set, unset and switch flags.

```php
$permissions = new Permissions();
$permissions->set( Permissions::READ );
$permissions->unset( Permissions::READ );
$permissions->switch( Permissions::READ );
$permissions->has( Permissions::READ );      // true
```

### Fluent Manipulation

The base class [`AbstractFlagable`][srclink-abstract-flagable] implements the fluent interface. So the manipulation of the flagable can be chained.

```php
$permissions = new Permissions();
$permissions->set( Permissions::READ )
            ->unset( Permissions::READ )
            ->switch( Permissions::READ )
            ->has( Permissions::READ );     // true
```

### String Representation

A flagable can stringified in different ways with different outputs.

```php
$permissions = new Permissions();
(string)$permissions->getValue();    // 0
(string)$permissions();              // 0
(string)$permissions;                // NONE
$permissions->__toString();          // NONE

$permissions = new Permissions( PERMISSIONS::READ | PERMISSIONS::EXECUTE );
(string)$permissions->getValue();    // 5
(string)$permissions();              // 5
(string)$permissions;                // READ|EXECUTE
$permissions->__toString();          // READ|EXECUTE
```

### Traitful Extensions

To keep the simplicity and performance Phlags provides [`Traitful Extensions`][srclink-traitful-extensions]. Instead of implementing a complex and heavyweight inheritance you can combine the extensions of your choice into the flagable of your needs.

```php
class Permissions extends AbstractFlagable
{
    use SomeTraitfulExtension;

    public const READ    = 1;
    public const WRITE   = 2;
    public const EXECUTE = 4;
}
```

#### Conditional Manipulation

— [`ConditionalManipulationExtension`][srclink-conditional-manipulation-extension]

The Conditional Manipulation provides you with methods to set, unset and switch a flag value while a passed statement must evaluate to true.

```php
$pathToFile = '/some-random-file.txt';
$permissions = new Permissions();
$permissions->ifSet( Permissions::DIRECTORY, is_dir( $pathToFile ) );
$permissions->has( Permissions::DIRECTORY );    // false

$pathToFile = '/some-random-directory/';
$permissions = new Permissions();
$permissions->ifSet( Permissions::DIRECTORY, is_dir( $pathToDirectory ) );
$permissions->has( Permissions::DIRECTORY );    // true
```

## Validation

### Flagables

While instantiating your very first flagable your flagable has to pass a one-time validation.

* all declared constants are an `unsigned integer`
* all constants are a power of 2
* there is no duplicates of any of the constant values
* there is no missing values, e. g. a flagable with a flags set `1, 2, 8` ist invalid, while the flag `4` is missing

If the flagable does not pass the validation an [`InvalidFlagableException`][srclink-invalid-flagable-exception] will be thrown and you can retreive an array of detailed error messages of the validation.

```php
try
{
    $permissions = new Permissions();
}
catch ( InvalidFlagableException $e )
{
    $errorMessages = $e->getErrorMessages();
}
```

### Values

A flag value passed to the methods of the flagable has to pass a validation on every method call.

* it is an `unsigned integer` less or equal than the maximum value of the called flagable
* it is a `string` representation of a flagable with an identic type as the type of the called flagable
* it is a flagable with an identic type as the type of the called flagable
* it does not exceeds the maximum flag value of the called flagable

If the value does not pass the validation an [`InvalidValueException`][srclink-invalid-value-exception] will be thrown and you can retreive an array of detailed error messages of the validation.

```php
try
{
    $permissions->set( $value );
}
catch ( InvalidValueException $e )
{
    $errorMessages = $e->getErrorMessages();
}
```



[xtlink-version-badge]: https://img.shields.io/badge/version-1.2.0-blue.svg
[xtlink-license-badge]: https://img.shields.io/badge/license-MIT-blue.svg
[xtlink-php-version-badge]: https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg?style=flat-square
[xtlink-php-net]: https://php.net

[srclink-changelog]: ./CHANGELOG.md
[srclink-license]: ./LICENSE
[srclink-abstract-flagable]: ./src/AbstractFlagable.php
[srclink-invalid-flagable-exception]: src/Validation/InvalidFlagableException.php
[srclink-invalid-value-exception]: src/Validation/InvalidValueException.php
[srclink-traitful-extensions]: ./src/TraitfulExtensions
[srclink-conditional-manipulation-extension]: ./src/TraitfulExtensions/ConditionalManipulationExtension.php
