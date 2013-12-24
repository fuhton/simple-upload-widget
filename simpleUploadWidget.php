<?php
/*
Plugin Name: Simple Upload Widget
Description: Widget that allows for files to be uploaded
Author: Nick Smith
Author URI: http://iliketheideaof.us
Version: 0.1.1
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
      ?>
     <p>
       <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
       <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" />
       <input type="button" class="select-img" value="Select Image" />
     </p>
     <?php
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
