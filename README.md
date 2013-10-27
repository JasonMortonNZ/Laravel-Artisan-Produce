## Laravel 4 - Artisan Produce

A highly configurable Laravel 4 resource producer / generator for rapidly scaffolding applications.

- [About](#about)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Video Example](#video)
- [Author](#author)
- [License](#license)


### About
This package can create the following using only ONE command. E.g `$ php artisan produce Post` :

* Controllers
* Models
* Views
* View Composers
* Repositories
* Validators
* Migrations
* Seeds
* Tests
* ... and soon to be more! (Events, Service etc)

### Installation

1) Add `jason-nz/produce` as a requirement to composer.json:

```javascript
{
    "require": {
        "jason-nz/produce": "1.0.*"
    }
}
```

2) Update your packages with `composer update`.

3) Next, register the `JasonNZ\Produce\ProduceServiceProvider` in the prodivers array located in app/config/app.php:

```php
'JasonNZ\Produce\ProduceServiceProvider'
```

4) Finally, publish the config file by running the following artisan command in the terminal:

```
$ php artisan config:publish jason-nz/produce
```

### Usage

Adjust the configuration setting located in `app/config/packages/jason-nz/produce/config.php` to your liking. See [configuration](#configuration) for more details.

Then simply run any of the following artisan commands:

* ``` $ php artisan produce NAME ```
* ``` $ php artisan produce:all NAME ```
* ``` $ php artisan produce:composer NAME ```
* ``` $ php artisan produce:controller NAME ```
* ``` $ php artisan produce:migration NAME ```
* ``` $ php artisan produce:model NAME ```
* ``` $ php artisan produce:repository NAME ```
* ``` $ php artisan produce:seed NAME ```
* ``` $ php artisan produce:test NAME ```
* ``` $ php artisan produce:validator NAME ```
* ``` $ php artisan produce:view NAME ```

**Note:** Replace NAME with the singular name of the resource/s you want to create.

### Configuration

Almost every element of this package can be customised to your project and programming needs.

If you open the `app/config/packages/jason-nz/produce/config.php` file, you will see a number of well documented configuration options.

Their are usually at least 3 options available for each resource type. The first being a boolean value, which allow you to set whether you want this package to produce this type of resource. The second is the path location for the created resource, and third is an optional namespace field, for those of use who like to namespace our files.

**Note:** If your namespacing files and adding new folder/directory paths, **DONT** forget to tell laravel to autoload them. This can be done via the composer.json file or in the `app/global.php` file.

### Video
[![ScreenShot](https://raw.github.com/JasonMortonNZ/Laravel-Artisan-Produce/master/produce-video.png)](http://www.youtube.com/watch?v=0XfUnKc0ycU)

### TODO

I would like to add the following resources to this package soon:

- Events
- Services
- Service Providers

If anyone feels that other resources or additional functionality could be useful. Let me know!

### Author

- Twitter [@JasonMortonNZ](https://twitter.com/jasonmortonnz)
- Website [JasonNZ.com](http://jasonnz.com)
- [Report Issues & Suggestions Here](https://github.com/JasonMortonNZ/Laravel-Artisan-Produce/issues)

### License

Laravel Artisan Produce - Laravel 4 package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
