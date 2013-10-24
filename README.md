## Laravel 4 - Artisan Produce

A highly configurable Laravel 4 resource producer/generator.

This package can create the following using only ONE command:
    - Controllers
    - Models
    - Views
    - View Composers
    - Repositories
    - Validators
    - Migrations
    - Seeds
    - Tests
    - ... and soon to be more! (Events, Service etc)

#### Author

- Twitter [@JasonMortonNZ](https://twitter.com/jasonmortonnz)
- [Issues](https://github.com/JasonMortonNZ/Laravel-Artisan-Produce/issues)


### Installation

1) Add `jason-nz/produce` as a requirement to composer.json:

```javascript
{
    "require": {
        "jason-nz/produce": "@1.0.*"
    }
}
```

2) Update your packages with `composer update` or `composer install`.

3) Next, register the `JasonNZ\Produce\ProduceServiceProdiver` in the prodivers array located in app/config/app.php:

```php
'JasonNZ\Produce\ProduceServiceProdiver'
```

4) Finally, publish the config file by running the following artisan command in the terminal:

```
$ php artisan config:publish jason-nz/produce
```

### Usage

Adjust the configuration setting located in `app/config/packages/jason-nz/product/config.php` to your liking.

Then simply run the artisan command:

```
$ php artisan produce <NAME>
```

Note: Replace <NAME> with the singular name of the resource/s you want to create.