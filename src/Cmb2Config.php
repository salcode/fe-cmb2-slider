<?php
/**
 * Ironcode CMB2 Slider plugin CMB2 config..
 *
 * @package Ironcode\FeCmb2Slider
 */

namespace Ironcode\FeCmb2Slider;

/**
 * Ironcode CMB2 Slider plugin CMB2 config..
 */
class Cmb2Config {

	protected $cmb;

	protected $cpt_slug;

	public function __construct( $cpt_slug ) {
		$this->cpt_slug = $cpt_slug;
	}

	public function hook_in() {
		add_action( 'cmb2_admin_init', array( $this, 'define' ) );
	}

	public function define() {
		$this->cmb = new_cmb2_box( array(
			'id'           => 'fe_cmb2_slider_metabox',
			'title'        => esc_html__( 'Slides', 'fe-cmb2-slider' ),
			'object_types' => array( $this->cpt_slug ), // Post type.
		) );

		// Setup repeatable field group.
		$group_field = $this->cmb->add_field( array(
			'id'      => 'fe_cmb2_slider_repeat_grp',
			'type'    => 'group',
			'options' => array(
				'group_title'   => __( 'Item {#}', 'fe-cmb2-slider' ),
				'add_button'    => __( 'Add Item', 'fe-cmb2-slider' ),
				'remove_button' => __( 'Remove Item', 'fe-cmb2-slider' ),
				'sortable'      => true,
			),
		) );

		$this->cmb->add_group_field( $group_field, array(
			'name'       => __( 'Image', 'fe-cmb2-slider' ),
			'id'         => 'image',
			'type'       => 'file',
		) );
	}
}

