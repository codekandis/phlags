# phlags

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)

With Phlags you can declare flagable enums to provide a type with varying and multiple states.

## How to use

Declare a class extending the flagable base class. All constants must be declared with an unsigned integer in a power of 2.

```php
class Permissions extends FlagableAbstract
{
        public const DIRECTORY = 1;
        public const UREAD     = 2;
        public const UWRITE    = 4;
        public const UEXECUTE  = 8;
        public const GREAD     = 16;
        public const GWRITE    = 32;
        public const GEXECUTE  = 64;
        public const OREAD     = 128;
        public const OWRITE    = 256;
        public const OEXECUTE  = 512;
}
```

**First:** In the context of manipulating the flagable the following values are meant to be equal and can be passed to all methods of the flagable.

```php
1
Permissions::DIRECTORY
new Permissions( 1 )
new Permissions( Permission::DIRECTORY )
```

You can easily instantiate your flagable in several ways.

```php
// with the default flag 'Permissions::NONE'
$permissions = new Permissions();

// or with a single flag
$permissions = new Permissions( Permissions::DIRECTORY );

// or with multiple flags
$permissions = new Permissions( Permissions::DIRECTORY | Permissions::UREAD );

// or with another flagable
$permissionsA = new Permissions( Permissions::DIRECTORY );
$permissionsB = new Permissions( $permissionsA );
```

You can check, if one or more specific flags have been set.

```php
$permissions = new Permissions( Permissions::DIRECTORY | Permissions::UREAD );
$permissions->has( Permissions::DIRECTORY );   // true
$permissions->has( Permissions::UREAD );       // true
$permissions->has( Permissions::UWRITE );      // false
```

You can set, unset and switch flags.

```php
$permissions = new Permissions( );
$permissions->set( Permissions::DIRECTORY );
$permissions->unset( Permissions::DIRECTORY );
$permissions->switch( Permissions::DIRECTORY );
```

You can retreive the value of the flagable in 2 several ways.

```php
$permissions = new Permissions( Permissions::DIRECTORY );
echo $permissions->getValue();   // 1
echo $permissions();             // 1
```
