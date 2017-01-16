# laravel-intempus

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]
<img src="https://styleci.io/repos/76856364/shield?branch=master" alt="StyleCI Shield">

## Install

Via Composer

``` bash
$ composer require lasserafn/laravel-intempus
```

### Laravel Service Provider
Add the follwing to your ```providers``` array in ```config/app.php```:
```` php
\LasseRafn\LaravelIntempus\LaravelIntempusServiceProvider::class,
````

### Publish configs
Run this in your terminal
```` bash
php artisan vendor:publish --provider="LasseRafn\LaravelIntempus\LaravelIntempusServiceProvider" --tag="config"
````

### Route (for Auth)
Add this to your web.php file (or where-ever you desire)
``` php
Route::get('intempus/connect', function(\Illuminate\Http\Request $request) {
	dd($request->all()); // Of cause, you can do whatever you need.
	// Returned attributes are:
	    // pk
	    // hash
	    // token
});
```

## Usage

### Auth
``` php
$intempus = new Intempus();

$auth = $intempus->getAuth(); // returns url, hash and nonce in an array

return Redirect::to($auth['url']);
```
Remember to store the nonce, as you'll need it do send future requests.

### Doing stuff
In order to send a request, you'll need the nonce (returned from the getAuth() method) and the token that is returned from Intempus.
Look at the "Route (for Auth)" section for help.

An example of this could be:

``` php
Route::get('intempus/start', function(\Illuminate\Http\Request $request) {
    $intempus = new Intempus();
    
    $auth = $intempus->getAuth(); // returns url, hash and nonce in an array
    
    $request->session()->set('intempus_nonce', $auth['nonce']);
    
    return Redirect::to($auth['url']);
});
```
``` php
Route::get('intempus/connect', function(\Illuminate\Http\Request $request) {
    $nonce = $request->session()->get('intempus_nonce');
    $token = $request->get('token');
    $pk = $request->get('pk');

   	$intempus = new Intempus($nonce, $token, $pk);
   	
   	dd( $intempus->products()->find(1) );
});
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email lasserafn@gmail.com instead of using the issue tracker.

## Credits

- [Lasse Rafn][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lasserafn/laravel-intempus.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/lasserafn/laravel-intempus.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lasserafn/laravel-intempus.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lasserafn/laravel-intempus
[link-downloads]: https://packagist.org/packages/lasserafn/laravel-intempus
[link-author]: https://github.com/lasserafn
[link-contributors]: ../../contributors

# todo
* Allow deleting models/entities through the API
* Allow creating models/entities through the API
* Allow updating models/entities through the API
* Limit ->get() method to X results and include an ->all() method that uses pagination
* Add missing models
* Add relationship-ish behaviour, like:

## Reason for doing this
As of creating this package, I'm employeed at [Bizz Zolutions](https://bizzz.dk) - and one of my tasks was integrating [Intempus timeregistrering](https://bizzz.dk/partnere/intempus-timeregistrering) with [e-conomic regnskabsprogram](https://bizzz.dk/partnere/e-conomic-regnskabsprogram).
I believe in open sourcing as much as possible so this felt very natural. Had a talk with the boss and we're equally minded :-)

Use as you please. Oh, and sorry for the shameless backlinks. 