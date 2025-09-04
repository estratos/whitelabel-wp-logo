<?php
class Whitelabel_WP_Logo_Admin_Customizations {
    
    public static function init() {
        add_action('admin_head', array(__CLASS__, 'custom_admin_logo'));
        add_action('admin_head', array(__CLASS__, 'replace_menu_icons'));
    }
    
    public static function custom_admin_logo() {
        $options = get_option('whitelabel_wp_logo_settings');
        $logo_url = isset($options['admin_logo']) ? $options['admin_logo'] : '';
        
        if (empty($logo_url)) {
            return;
        }
        ?>
        <style type="text/css">
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                background-image: url(<?php echo esc_url($logo_url); ?>) !important;
                background-size: 20px 20px;
                background-repeat: no-repeat;
                background-position: center;
                content: '' !important;
                color: transparent;
            }
            
            #wpadminbar #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon {
                background-position: center;
            }
        </style>
        <?php
    }
    
    public static function replace_menu_icons() {
        $options = get_option('whitelabel_wp_logo_settings');
        $replace_icons = isset($options['replace_menu_icons']) ? $options['replace_menu_icons'] : false;
        
        if (!$replace_icons) {
            return;
        }
        ?>
        <style type="text/css">
            /* Reemplazar iconos principales */
            .dashicons-dashboard:before {
                content: "📊" !important;
            }
            
            .dashicons-admin-post:before {
                content: "📝" !important;
            }
            
            .dashicons-admin-media:before {
                content: "🖼️" !important;
            }
            
            .dashicons-admin-page:before {
                content: "📄" !important;
            }
            
            .dashicons-admin-comments:before {
                content: "💬" !important;
            }
            
            .dashicons-admin-appearance:before {
                content: "🎨" !important;
            }
            
            .dashicons-admin-plugins:before {
                content: "🔌" !important;
            }
            
            .dashicons-admin-users:before {
                content: "👥" !important;
            }
            
            .dashicons-admin-tools:before {
                content: "🛠️" !important;
            }
            
            .dashicons-admin-settings:before {
                content: "⚙️" !important;
            }
            
            /* Iconos de WooCommerce */
            .dashicons-cart:before {
                content: "🛒" !important;
            }
            
            .dashicons-products:before {
                content: "📦" !important;
            }
            
            .dashicons-woocommerce:before {
                content: "💰" !important;
            }
        </style>
        <?php
    }
}
