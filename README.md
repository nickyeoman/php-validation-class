# PHP Validation Class

A simple yet effective validation class written in PHP.

## Introduction

Originally created on October 31, 2009, using CodeIgniter, this class has been revived to meet the needs of numerous projects. 


### Full Documentation

Github: https://github.com/nickyeoman/php-validation-class

### Packagist

Composer: https://packagist.org/packages/nickyeoman/php-validation-class

```
composer require nickyeoman/php-validation-class
```

#### Usage

Include the class in your project.
```php
USE Nickyeoman\Validation;
$validate = new Nickyeoman\Validation\Validate();
```

And use:
```php
$validate = new Validate;
$validate->isEmail($email);
$validate->isPhone($phone);
$validate->isPostalCode($postal);
$validate->isZipCode($zip);
```
