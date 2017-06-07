<?php
/**
 * Default View for Ironcode CMB2 Slider
 *
 * @package Ironcode\FeCmb2Slider
 */

if ( ! $slider_data ) { return; }

printf( '<ul data-slider-id="%1$s" class="fe-cmb2-slider-default fe-cmb2-slider-default-%1$s">',
	intval( $slider_id )
);


foreach ( $slider_data as $index => $slide ) {

	printf( '<li class="fe-cmb2-slider-default-slide"><img data-image-id="%1$s" src="%2$s" alt=""></li>',
		esc_attr( $slide['image_id'] ),
		esc_attr( $slide['image'] )
	);

}


echo '</ul>';
