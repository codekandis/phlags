# CodeKandis / Phlags

[![Minimum PHP Version][php-version-badge]](https://php.net/)
[![SensioLabs Insight][sensio-labs-insight-badge]](http://insight.sensiolabs.com/projects/b5d47b55-216f-4247-ad41-902dc0f8ac44)

[![Version][version-badge]][changelog]
[![License][license-badge]][license]

With Phlags you can declare flagable enums to provide types with varying and multiple states. While depending on binary operations Phlags provides high performance and reliabilty.

## Index

* [How to use](#how-to-use)
    * [Declaration](#declaration)
    * [Instantiation](#instantiation)
    * [Reading](#reading)
    * [Determination](#determination)
    * [Manipulation](#manipulation)
    * [Fluent Manipulation](#fluent-manipulation)
    * [String Representation](#string-representation)
* [General hints](#general-hints)
* [Validation](#validation)
    * [Flagables](#flagables)
    * [Values](#values)

## How to use

**Example: Simple permissions in a file system**

### Declaration

Declare a class extending the flagable base class `AbstractFlagable`.

```php
class Permissions extends AbstractFlagable
{
    public const READ     = 1;
    public const WRITE    = 2;
    public const EXECUTE  = 4;
}
```

### Instantiation

You can easily instantiate your flagable in different ways.

```php
// with the default flag 'Permissions::NONE' (inherited from `FlagableInterface::NONE`)
$permissions = new Permissions();

// or with a single flag
$permissions = new Permissions( Permissions::READ );

// or with multiple flags
$permissions = new Permissions( Permissions::READ | Permissions::WRITE );

// or with another flagable
$permissions = new Permissions( new Permissions( Permissions::READ ) );
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
```

### Fluent Manipulation

The base class `AbstractFlagable` implements the fluent interface. So the manipulation of the flagable can be chained.

```php
$permissions = new Permissions();
$permissions->set( Permissions::READ )
            ->unset( Permissions::READ )
            ->switch( Permissions::READ )
            ->has( Permissions::READ );      // true
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

## General Hints

In the context of manipulating the flagable the following values are supposed to be equal and can similarly passed to all methods of the flagable.

```php
1
Permissions::READ
new Permissions( 1 )
new Permissions( Permission::READ )
```

In the other hand the type restriction of PHP does not allow any combination of an integer value with a flagable.

```php
new Permission( 1 | new Permissions( READ ) )
```

## Validation

### Flagables

While instantiating your very first flagable your flagable has to pass a one-time validation.

* all declared constants are an `unsigned integer`
* all constants are a power of 2
* there's no duplicates of any of the constant values
* there's no missing values, e. g. a flagable with a flags set `1, 2, 8` ist invalid, while the flag `4` is missing

If the flagable does not pass the validation an `InvalidFlagableException` will be thrown and you can retreive an array of detailed error messages of the validation.

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

* it's an `unsigned integer` or is an flagable with an identic type as the type of the called flagable
* it does not exceeds the maximum flag value of the called flagable

If the value does not pass the validation an `InvalidValueException` will be thrown and you can retreive an array of detailed error messages of the validation.

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

[php-version-badge]: https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square
[sensio-labs-insight-badge]: https://insight.sensiolabs.com/projects/b5d47b55-216f-4247-ad41-902dc0f8ac44/mini.png
[version-badge]: https://img.shields.io/badge/version-1.0.0-blue.svg
[changelog]: ./CHANGELOG.md
[license-badge]: https://img.shields.io/badge/license-MIT-blue.svg
[license]: ./LICENSE
