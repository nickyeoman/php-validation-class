# php-validation-class

I wrote this back on Oct 31 2009 when I was using CodeIgniter.
I recently had new project where this came in handy so I brought it back to life.
12 year old code, still not dead.

### Full Documentation
https://www.nickyeoman.com/blog/php/php-validation-class/

### Packagist
https://packagist.org/packages/nickyeoman/php-validation-class

```
composer require nickyeoman/php-validation-class
```

### GitHub
https://github.com/nickyeoman/php-validation-class

## Getting Started

```
$validate = new Validate;
$validate->isEmail($email);
$validate->isPhone($phone);
$validate->isPostalCode($postal);
$validate->isZipCode($zip);
```

## Testing

I want to be sure this works, so I have a test kit for myself included.
