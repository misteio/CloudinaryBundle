MisteioCloudinaryBundle
=========
[![Latest Stable Version](https://poser.pugx.org/misteio/cloudinary-bundle/v/stable)](https://packagist.org/packages/misteio/cloudinary-bundle)
[![Latest Unstable Version](https://poser.pugx.org/misteio/cloudinary-bundle/v/unstable)](https://packagist.org/packages/misteio/cloudinary-bundle) 
[![License](https://poser.pugx.org/misteio/cloudinary-bundle/license)](https://packagist.org/packages/misteio/cloudinary-bundle)
[![Build Status](https://travis-ci.org/misteio/CloudinaryBundle.svg?branch=master)](https://travis-ci.org/misteio/CloudinaryBundle)
[![Code Climate](https://codeclimate.com/repos/586d2bd9fa6a943e97001bc5/badges/36b972b7a31123e8d235/gpa.svg)](https://codeclimate.com/repos/586d2bd9fa6a943e97001bc5/feed)

MisteioCloudinaryBundle is a Symfony2/3 Bundle forked from laravel4-cloudinary (thanks [Teeplus](https://github.com/teepluss/laravel4-cloudinary)) and cloudinary-bundle (thanks [Speicher210](https://github.com/Speicher210/CloudinaryBundle)). You can use it as a service, and some extends are implemented for Twig. 
[Cloudinary Library v1.7.1](http://cloudinary.com/documentation/php_integration).

## Install

Via Composer

``` bash
$ composer require misteio/cloudinary-bundle
```
or in composer.json file
``` bash
"misteio/cloudinary-bundle": "dev-master"
```

Register the bundle in `app/AppKernel.php`:

``` php
public function registerBundles()
{
    return array(
        // ...
        new Misteio\CloudinaryBundle\MisteioCloudinaryBundle(),
        // ...
    );
}
```

Configuration
-------------

Configure the connection to cloudinary in your `config.yml` :

``` yaml
misteio_cloudinary:
  cloud_name: yourCloudRegistrationName
  api_key: yourApiKey
  secret_key: yourSecretApiKey
```

## Usage

This wrapper api provide simple methods to upload, rename, delete, tag manage and full features from original cloudinary class methods.
You can use it via Dependency Injection Component(DIC) service.

```php
	$cloudinary = $this -> container -> get('misteio_cloudinary_wrapper');
```


Upload Image
```php
	$cloudinary -> upload('path/to/file', 'name', $tags, $options)
```
Upload Video (Latest argument is for large files)
```php
	$cloudinary -> uploadVideo('path/to/file', 'name', $tags, true)
```

Display an image
```php
	$cloudinary -> show('public_name', array('width' => 150, 'height' => 150, 'crop' => 'fit', 'radius' => 20));
```

Display an image using HTTPS
```php
  $cloudinary -> show('public_name', array('width' => 150, 'height' => 150, 'crop' => 'fit', 'radius' => 20, 'secure' => true));
```

Display a video
```php
	$cloudinary -> showVideo('public_name', array('width' => 150, 'height' => 150, 'crop' => 'fit', 'radius' => 20));
```

Display a video using HTTPS
```php
  $cloudinary -> showVideo('public_name', array('width' => 150, 'height' => 150, 'crop' => 'fit', 'radius' => 20, 'secure' => true));
```

> More document from [cloudinary.com](http://cloudinary.com/documentation/image_transformations)

Rename file

```php
	$cloudinary -> rename('from_public_id', 'to_public_id');
```

Delete file
```php
	$cloudinary -> destroy('public_id');
```

Manage with tag

```php
    $cloudinary -> addTag('my_tag_1', array('my_public_id', 'my_public_id_2'));
    $cloudinary -> removeTag('my_tag_2', array('my_public_id', 'my_public_id_2'));
    $cloudinary -> replaceTag('my_tag_3', array('my_public_id', 'public_id_2'));
```

## Twig for displaying image
```php
	{{ 'my_public_id'|cloudinary_url({"width" : 150, "height" : 150, "crop" : "fill", "radius" : 20}) }}
```

## Twig for displaying image using HTTPS
```php
  {{ 'my_public_id'|cloudinary_url({"width" : 150, "height" : 150, "crop" : "fill", "radius" : 20, "secure" : true}) }}
```

## Twig for displaying video
```php
	{{ 'my_public_id'|cloudinary_url_video({"width" : 150, "height" : 150, "crop" : "fill", "radius" : 20}) }}
```

## Twig for displaying video using HTTPS
```php
  {{ 'my_public_id'|cloudinary_url_video({"width" : 150, "height" : 150, "crop" : "fill", "radius" : 20, "secure" : true}) }}
```

## Security

If you discover a security vulnerability , please email instead of using the issue tracker. All security vulnerabilities will be promptly addressed.


### License
This Wrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
