<?php
class Whitelabel_WP_Logo_Login_Customizations {
    
    public static function init() {
        add_action('login_enqueue_scripts', array(__CLASS__, 'custom_login_logo'));
        add_filter('login_headerurl', array(__CLASS__, 'custom_login_logo_url'));
        add_filter('login_headertitle', array(__CLASS__, 'custom_login_logo_title'));
    }
    
    public static function custom_login_logo() {
        $options = get_option('whitelabel_wp_logo_settings');
        $logo_url = isset($options['login_logo']) ? $options['login_logo'] : '';
        
        if (empty($logo_url)) {
            return;
        }
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo_url); ?>);
                height: 80px;
                width: 100%;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                padding-bottom: 30px;
            }
            
            body.login {
                background-color: #f1f1f1;
            }
            
            .login form {
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
        </style>
        <?php
    }
    
    public static function custom_login_logo_url() {
        return home_url();
    }
    
    public static function custom_login_logo_title() {
        return get_bloginfo('name');
    }
}
