# Laravel markdown documentation

TL;DR
-----
Markdown documentation for Laravel.
**Install with composer, create a route to `MddocController`**.
Automatic analysis of documentation folders, read markdown file content rendering web page, Highest support two level classification.
No public assets, automatic registration routing, UI based on [Antd Desgin Vue](https://github.com/vueComponent/ant-design-vue) .
Inspired by star7th's [showdoc](https://github.com/star7th/showdoc) (run in ThinkPHP).


Install
-------
Install via composer
```
composer require cirlmcesc/laravel-mddoc
```

Add Service Provider to `config/app.php` in `providers` section
```php
Cirlmcesc\LaravelMddoc\LaravelMddocServiceProvider::class,
```

Then run the following command to **publish the resource**.
**Configuration file** will be published to `config/`.
The mode of operation can be customized by modifying parameters and attributes.
```
php artisan mddoc:install
```


Usage
-----
**Generating a template with a artisan command**.
The markdown file will be placed under the `documentation/` folder under the root directory.
You can also change the parameters in the configuration file to change the directory where the files are stored.
```
php artisan make:documentation filename
```

Visit
-----
You can visit on
```
http://www.example.com/documentation
```

The routing path can be changed in the published configuration file, or the automatic registration route is cancelled.
**If the route is registered by yourself, add a route in your web routes file**.
```php
Route::get("your/router/path/{first?}/{second?}/{third?}", "Cirlmcesc\LaravelMddoc\MddocController@view");
```

Other
-----
**The home page displays the project's README.md file by default**.
You can modify the contents of the home page in the published configuration file.
An auxiliary function is provided to handle markdown content for home page display.
```php
function parse_markdown(String $markdown_file_path) : String
```