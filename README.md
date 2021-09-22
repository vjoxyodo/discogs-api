# discogs
Package for use of www.discogs.com API

<p align="center">
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/packagist/dt/vjoxyodo/discogs-api?style=plastic&color=orange" alt="Total Downloads"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/github/languages/code-size/vjoxyodo/discogs-api?style=plastic" alt="Package Size"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/github/last-commit/vjoxyodo/discogs-api?style=plastic" alt="Last Commit"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/packagist/v/vjoxyodo/discogs-api?style=plastic&logo=php&color=informational" alt="Latest Stable Version"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/packagist/l/vjoxyodo/discogs-api?style=plastic&color=A60001" alt="License"></a>
	<a href="https://packagist.org/packages/vjoxyodo/discogs-api"><img src="https://img.shields.io/github/languages/top/vjoxyodo/discogs-api?style=plastic&color=7178A9" alt="Languages"></a>
	
</p>
	


## Discogs API Parser ##

**Discogs API** is a simplified parser for the [Discogs API](https://www.discogs.com/developers)

### Installation ###

Install via [composer](http://getcomposer.org) in the root directory of a Laravel application
```
composer require vjoxyodo/discogs-api
```
The install will create the file `config/discogs-api.php` containing the Service variables for usage of the package. Check the file and add the same names with the corresponding values in your project env file

After instaling run your Laravel folder project:
```
php artisan vendor:publish --provider="Vjoxyodo\DiscogsApi\DiscogsServiceProvider"
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<!--


https://shields.io/
### Usage ###

This package has several pages with many features

Give them a try (URLs):

- `/default`
- `/default/manage`

### Overview ###

General gist

### Tools ###

List of tools, everything needed to develop.

### Credits ###

All thanks to me and the community

--!>