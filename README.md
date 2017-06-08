# Iron Code CMB2 Slider

While there are many pre-packaged slider solutions out there, I find that due to the nuiances of display I often like to put together my own.  However, the backend process is almost always the same.  To this end, this plugin creates a CPT called "Sliders".

Each "Slider" can contain multiple slides. By default a slide consists of a single image.

The slider can then be displayed with either the shortcode `[fe_slider id=5]` where `5` is the post id of the slider.

## Templating

This plugin contains a basic template for displaying items, however override templates can be added to the theme.  The shortcode takes an optional second parameter `template`.  This is the template suffix used for the custom template.

```
[fe_slider id=5 template=home]
```

For this shortcode, we'll check for custom templates at:

- `/wp-content/my-theme/fe-cmb2-slider/template-home.php`
- `/wp-content/my-theme/fe-cmb2-slider/template.php`

If neither of these are found, the default template with the plugin will be used.

If the `template` parameter is omitted

```
[fe_slider id=5]
```

We'll check  
`/wp-content/my-theme/fe-cmb2-slider/template.php`  
for a custom template.


## Building This Project

This project uses [Composer](https://getcomposer.org/) to managed dependencies.  To build the project [install Composer](https://getcomposer.org/doc/00-intro.md#globally) and run the following from the root of the plugin.

```
$ composer install --no-dev -o
```

### What this composer install command does

- reads the `composer.json` file, see [composer install](https://getcomposer.org/doc/03-cli.md#instal://getcomposer.org/doc/03-cli.md#install). Any `require` projects are installed in the folder `/vendor`
- configure the [Composer autoloader](https://getcomposer.org/doc/01-basic-usage.md#autoloading)
- `--no-dev` Skip installing packages listed in require-dev. (currently there are none)
- `-o` Convert PSR-0/4 autoloading to classmap to get a faster autoloader. This is recommended especially for production, but can take a bit of time to run so it is currently not done by default.
- Configure the autoloader to load the file `vendor/johnbillion/extended-cpts/extended-cpts.php`

## Credits

[Sal Ferrarello](https://salferrarello.com/) / [@salcode](https://twitter.com/salcode)
