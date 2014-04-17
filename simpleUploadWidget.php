<?php
/*
Plugin Name: Simple Upload Widget
Description: Widget that allows for files to be uploaded
Author: Nick Smith
Author URI: http://iliketheideaof.us
<<<<<<< HEAD
Version: 0.1.2
=======
Version: 0.1.1
>>>>>>> 02424ddd5dae98c12a46a69a28e6d8b637249aa8
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
        $image_instance = $instance['suw_image_loca'];

        // basic output
        printf( __('<img src="%1$s" />'), $image_instance);
    }

    public function form( $instance )
    {
      ?>
     <p>
       <label for="<?php echo $this->get_field_id('suw_image_loca'); ?>">Image</label><br />
       <input type="text" class="suw-input-field <?php echo $this->get_field_name('suw_image_loca'); ?>" name="<?php echo $this->get_field_name('suw_image_loca'); ?>" id="<?php echo $this->get_field_id('suw_image_loca'); ?>" value="<?php echo $instance['suw_image_loca']; ?>" />
       <input type="button" class="suw-button-select button button-primary <?php echo $this->get_field_name('suw_image_loca'); ?>" id="<?php echo $this->get_field_name('suw_image_loca'); ?>" value="Select Image" />
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
    wp_enqueue_media();
    wp_enqueue_script('hrw', '/wp-content/plugins/simple-upload-widget/script.js', null, null, true);
}
add_action('admin_enqueue_scripts', 'suw_enqueue');
