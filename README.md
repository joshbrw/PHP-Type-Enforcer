# Type Enforcement

If you've ever come across a time where you're writing loosely-coupled code but want to check a parameters type at the start of a method, then this library is for you.

## How you're probably doing it

```php
class UserRegistrar {
    public function register(array $usersDetails, $author)
    {
        if (!$author instanceof SomeAuthor) {
            throw new \InvalidArgumentException('The author must be an instance of SomeAuthor');
        }
        
        ...
    }
}
```

## Let's refactor!
```php
use Joshbrw\TypeEnforcement\Type;

class UserRegistrar {
    public function register(array $usersDetails, $author)
    {
        /* Throws \InvalidArgumentException on invalid input */
        Type::enforce($author, SomeAuthor::class);
        
        ...
    }
}
```

## Custom Exception Messages

By default the package will provide a useful exception message, stating which type is expected and which type has been provided, i.e:

```
Expected [Tests\NonExistentClass], [array '["array"]'] provided.
```

This exception message can be switched out by providing a custom message as the third parameter, i.e.:

```php
Type::enforce($variable, Type::class, 'The variable must be a Type!');
```

## Not a fan of static method calls?

This package also includes a helper method that accepts the same parameters:

```
enforce_type($variable, Type::class, 'The variable must be a Type!');
```
