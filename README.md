# Iron Code CMB2 Slider

While there are many pre-packaged slider solutions out there, I find that due to the nuiances of display I often like to put together my own.  However, the backend process is almost always the same.  To this end, this plugin creates a CPT called "Sliders".

Each "Slider" can contain multiple slides. By default a slide consists of a single image.

The slider can then be displayed with either the shortcode `[fe_slider id=5]` where `5` is the post id of the slider.

## Templating

This plugin contains a basic template for displaying items, however override templates can be added to the theme.

- `/wp-content/my-theme/fe-cmb2-slider/template-7.php` will override display on the slider with post id `7`
- `/wp-content/my-theme/fe-cmb2-slider/template.php` will override display on any slider (that doesn't have a post id specific template)

## Credits

[Sal Ferrarello](https://salferrarello.com/) / [@salcode](https://twitter.com/salcode)
