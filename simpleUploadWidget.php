<?php
/*
Plugin Name: Simple Upload Widget
Description: Displays an Image for your homepage.
Author: Nick Smith
Author URI: http://iliketheideaof.us
Version: 0.0.1
*/

//Class Init
class Simple_Upload_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'simple-upload-widget',
            'Simple Upload Widget',
            array(
                'description' => 'Simple Upload Widget'
            )
        );
    }

    public function widget( $args, $instance )
    {
        $image_instance = $instance['image_uri'];

        // basic output
        printf( __('<img src="%1$s" />'), $image_instance);
    }

    public function form( $instance )
    {
        $text  = '<p>';
        $text .= '<label for="%1$s">Media</label><br />';
        $text .= '<input type="text" class="img" name="%1$s" id="%1$s" value="%2$s" />';
        $text .= '<input type="button" class="select-img" value="Select Media" />';
        $text .= '</p>';

        $image_uri = $this->get_field_id('image_uri');
        $image_instance = $instance['image_uri'];
        printf(__($text), $image_uri, $image_instance);
    }
}

// end class

// init the widget
add_action( 'widgets_init', create_function('', 'return register_widget("Simple_Upload_Widget");') );

// queue up the necessary js
function suw_enqueue()
{
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('hrw', '/wp-content/plugins/simple-upload-widget/script.js', null, null, true);
}
add_action('admin_enqueue_scripts', 'suw_enqueue');
