<?php
/*
Plugin Name: HS Simple Share
Plugin URI: http://hotsource.io/
Description: Add simple sharing to your posts
Author: Matthew Zalewski @ HotSource.io
Author URI: http://www.hotsource.io/
Version: 1.0
License: GNU General Public License v2.0 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

require_once __DIR__ . "/vendor/hotsource/wppm/wppm.php";
if ( ! WPPM::autoload( __FILE__ ) )
    return;



add_filter( 'mb_settings_pages', 'simpleshare_settings_page' );
function simpleshare_settings_page( $settings_pages )
{

    $settings_pages[] = array(
        'id'          => 'simpleshare',
        'option_name' => 'simpleshare',
        'menu_title'  => __( 'Share Settings', 'simple-share' ),
        'icon_url'    => 'dashicons-edit',
        'style'       => 'no-boxes',
        'columns'     => 1,
        'tabs'        => array(
            'general' => __( 'General Settings', 'simple-share' )

        ),
        'position'    => 68,
    );
    return $settings_pages;
}

add_filter( 'rwmb_meta_boxes', 'simple_share_register_meta_boxes' );
function simple_share_register_meta_boxes( $meta_boxes ) {
    $prefix = 'simpleshare_';
    // 1st meta box
    $meta_boxes[] = array(
        'id'         => 'shareurls',
        'title'      => __( 'Share URLs', 'simple-share' ),
        'settings_pages' =>  'simpleshare',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => __( 'Facebook', 'simple-share' ),
                'desc'  => 'Your Facebook Page URL',
                'id'    => $prefix . 'facebook',
                'type'  => 'text',
                'class' => 'custom-class',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Twitter', 'simple-share' ),
                'desc'  => 'Your Twitter Page URL',
                'id'    => $prefix . 'twitter',
                'type'  => 'text',
                'class' => 'custom-class',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Google', 'simple-share' ),
                'desc'  => 'Your Google Page URL',
                'id'    => $prefix . 'google',
                'type'  => 'text',
                'class' => 'custom-class',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Dribbble', 'simple-share' ),
                'desc'  => 'Your Dribbble Page URL',
                'id'    => $prefix . 'dribbble',
                'type'  => 'text',
                'class' => 'custom-class',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Skype', 'simple-share' ),
                'desc'  => 'Your Skype Page URL',
                'id'    => $prefix . 'skype',
                'type'  => 'text',
                'class' => 'custom-class',
                'clone' => false,
            ),
        )
    );

    return $meta_boxes;
}

function simple_share_add_social_share_icons($content)
{

    global $post;
    $option =get_option('simpleshare');
    $url = get_permalink($post->ID);
    $url = esc_url($url);
  ob_start();
?>
    <div class="social-buttons">
        <?php if (isset($option['simpleshare_facebook'])): ?>
            <a href="<?php echo $option['simpleshare_facebook']; ?>" class="social-button facebook"><i class="fa fa-facebook"></i></a>
        <?php endif;?>
        <?php if (isset($option['simpleshare_facebook'])): ?>
            <a href="<?php echo $option['simpleshare_twitter']; ?>" class="social-button twitter"><i class="fa fa-twitter"></i></a>
        <?php endif;?>
        <?php if (isset($option['simpleshare_facebook'])): ?>
            <a href="<?php echo $option['simpleshare_google']; ?>" class="social-button google"><i class="fa fa-google"></i></a>
        <?php endif;?>
        <?php if (isset($option['simpleshare_facebook'])): ?>
            <a href="<?php echo $option['simpleshare_dribbble']; ?>" class="social-button dribbble"><i class="fa fa-dribbble"></i></a>
        <?php endif;?>
        <?php if (isset($option['simpleshare_facebook'])): ?>
            <a href="<?php echo $option['simpleshare_skype']; ?>" class="social-button skype"><i class="fa fa-skype"></i></a>
        <?php endif;?>
    </div><?php
    return $content . ob_get_clean();

}

add_filter("the_content", "simple_share_add_social_share_icons");