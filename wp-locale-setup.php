<?php
 /**
  * Plugin Name: setup local language.
  * Plugin URI: https://www.example.com
  * Description: To change wordpress local language, admin side and frontend.
  * Version: 0.1
  * Author: Muhammed Shafaf
  * Author URI: https://muhammad-shafaf123.github.io/personal/
  */

  if ( ! defined( 'ABSPATH' ) ) {
	exit;
  }
  if(!class_exists("wp_locale_root_class")){
    class wp_locale_root_class{
      public function __construct(){
        add_filter('the_content', array($this, 'the_content_callback'));
        add_action('admin_menu', array($this, 'wp_locale_menu_setup'));
        add_action('admin_notices', array($this, 'show_motivation_text'));
      }

      public function wp_locale_menu_setup(){
        add_menu_page('Locale Admin', 'locale title', 'manage_options', 'translator_settings', array($this, 'locale_text_disaplay'));
      }
      public function locale_text_disaplay(){
        echo "hello world";
      }
      public function the_content_callback($content){
        $locale_text = "Hello world";
        return $locale_text.$content;
      }
      public function get_motivation_text(){
        $motivation = array(
          'you are awesome',
          'This website is boss',
          'You look great today',
          'Your earlobes are well rounded, good job!'
        );
        shuffle( $motivation );

        return $motivation[0];
      }
      public function show_motivation_text(){
        $text = $this->get_motivation_text();
        $this->write_log($text);
        echo "<p id='wp-admin-motivation'>$text</p>";
      }




      public function write_log ( $log )  {
		      if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
				       error_log( print_r( $log, true ) );
			      } else {
				        error_log( $log );
			      }
		       }
	    }
    }
  }
new wp_locale_root_class;

?>
