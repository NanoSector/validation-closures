# Validation Closures
[![Build Status](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/badges/build.png?b=3.0)](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/badges/quality-score.png?b=3.0)](https://scrutinizer-ci.com/g/Yoshi2889/validation-closures/?branch=master)
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

## License
This code is released under the MIT License. Please see `LICENSE` to read it.