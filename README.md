# Validation Closures
[![Build Status](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/badges/build.png)](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/badges/quality-score.png)](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/?branch=master)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/badges/coverage.png)](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/code-structure/master/code-coverage)
[![Latest Stable Version](https://poser.pugx.org/yoshi2889/validation-closures/v/stable)](https://packagist.org/packages/yoshi2889/validation-closures)
[![Latest Unstable Version](https://poser.pugx.org/yoshi2889/validation-closures/v/unstable)](https://packagist.org/packages/yoshi2889/validation-closures)
[![Total Downloads](https://poser.pugx.org/yoshi2889/validation-closures/downloads)](https://packagist.org/packages/yoshi2889/validation-closures)

Closures useful for validating data. Provides type validation amongst other filters.

## Installation
You can install this class via `composer`:

```composer require yoshi2889/validation-closures```

## Usage
All closures are exposed as public static methods. For example, to use the Types\string() closure:

```php
$closure = \ValidationClosures\Types::string();

$is_string = $closure('This is a string');

// True
echo $is_string ? 'True' : 'False';
```

In the following documentation, all methods return a value of type `boolean` unless stated otherwise.

### Ranges
The Ranges class contains methods to check if values are within a range. It contains the following methods:

* `stringWithLengthBetween(int $minimumLength, int $maximumLength)`: Test if a given string has a length within the range
`$minimumLength <= length <= $maximumLength`
* `intBetween(int $minimum, int $maximum)`: Test if a given int is inside the range of `$minimum <= int <= $maximum`
* `intBetweenExclusive(int $minimum, int $maximum)`: Test if a given int is inside the range of `$minimum < int < $maximum`
* `floatBetween(float $minimum, float $maximum)`: Identical to `intBetween`, except it tests on floats.
* `floatBetweenExclusive(float $minimum, float $maximum)`: Identical to `intBetweenExclusive`, except it tests on floats.
* `enum(...$allowedValues)`: Test if a given value exists inside `$allowedValues`, similar to an Enum type in other languages.
* `typeEnum(...$allowedTypes)`: Test if a given value is of a type inside `$allowedTypes`.
* `stringOneOf(...$allowedValues)`: Test if a given string exists inside `$allowedValues`.

### Reflection
The Reflection class allows you to create closures out of all methods found in [PHP's ReflectionClass](http://php.net/manual/en/class.reflectionclass.php).
It is most useful with the `is*` methods. For example, to create a closure for the [implementsInterface method](http://php.net/manual/en/reflectionclass.implementsinterface.php):

```php
$closure = Reflection::implementsInterface(stdClass::class);
```

The Reflection class will take care of instantiating a `ReflectionClass` object automatically.

### Types
The Types class contains methods to use for type validation. It contains the following methods:

* `string()`: Test if a given value is a string.
* `int()`: Test if a given value is an integer.
* `float()`: Test if a given value is a float.
* `boolean()`: Test if a given value is a boolean.
* `array()`: Test if a given value is an array.
* `callable()`: Test if a given value is a callable function/method.
* `object()`: Test if a given value is an instantiated object.
* `numeric()`: Test if a given value is a numeric value. (see [is_numeric](https://secure.php.net/manual/en/function.is-numeric.php) in the PHP manual for details)
* `instanceof(string $class)`: Test if a given value is an instance of the given class.

### Utils
The Utils class contains methods to manipulate closures. It contains the following methods:

* `invert(\Closure $closure): \Closure`: Invert a closure. For example, `Types::string()` inverted would pass all values which are **not** strings.
* `merge(\Closure $closure1, \Closure $closure2): \Closure`: Merge two closures together. The resulting closure will return true if **either** closure
or both closures resolve(s) to true.
* `both(\Closure $closure1, \Closure $closure2): \Closure`: Merge two closures together. The resulting closure will return true only if **both**
closures resolve to true.
* `validateArray(\Closure $closure, array $values): bool`: Tests if all values in a given array validate with the given closure.
Returns false if 1 or more values do not validate, returns true if all elements validate.

## License
This code is released under the MIT License. Please see `LICENSE` to read it.