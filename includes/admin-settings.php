<?php
class Whitelabel_WP_Logo_Admin_Settings {
    
    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_admin_menu'));
        add_action('admin_init', array(__CLASS__, 'settings_init'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin_scripts'));
    }
    
    public static function enqueue_admin_scripts($hook) {
        if ($hook != 'settings_page_whitelabel-wp-logo-settings') {
            return;
        }
        
        wp_enqueue_media();
        wp_enqueue_script('whitelabel-wp-logo-admin', WHITELABEL_WP_LOGO_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), '1.0.0', true);
        wp_enqueue_style('whitelabel-wp-logo-admin', WHITELABEL_WP_LOGO_PLUGIN_URL . 'assets/css/admin.css');
    }
    
    public static function add_admin_menu() {
        add_options_page(
            'Whitelabel WP Logo Settings',
            'Whitelabel WP Logo',
            'manage_options',
            'whitelabel-wp-logo-settings',
            array(__CLASS__, 'settings_page')
        );
    }
    
    public static function settings_init() {
        register_setting('whitelabel_wp_logo_settings_group', 'whitelabel_wp_logo_settings');
        
        // Sección principal
        add_settings_section(
            'whitelabel_wp_logo_logos_section',
            __('Logos Personalizados', 'whitelabel-wp-logo'),
            array(__CLASS__, 'logos_section_callback'),
            'whitelabel-wp-logo-settings'
        );
        
        // Campo logo login
        add_settings_field(
            'login_logo',
            __('Logo de Login', 'whitelabel-wp-logo'),
            array(__CLASS__, 'login_logo_callback'),
            'whitelabel-wp-logo-settings',
            'whitelabel_wp_logo_logos_section'
        );
        
        // Campo logo admin
        add_settings_field(
            'admin_logo',
            __('Logo del Admin', 'whitelabel-wp-logo'),
            array(__CLASS__, 'admin_logo_callback'),
            'whitelabel-wp-logo-settings',
            'whitelabel_wp_logo_logos_section'
        );
        
        // Sección iconos del menú
        add_settings_section(
            'whitelabel_wp_logo_icons_section',
            __('Iconos del Menú', 'whitelabel-wp-logo'),
            array(__CLASS__, 'icons_section_callback'),
            'whitelabel-wp-logo-settings'
        );
        
        // Campo reemplazar iconos
        add_settings_field(
            'replace_menu_icons',
            __('Reemplazar Iconos', 'whitelabel-wp-logo'),
            array(__CLASS__, 'replace_icons_callback'),
            'whitelabel-wp-logo-settings',
            'whitelabel_wp_logo_icons_section'
        );
    }
    
    public static function logos_section_callback() {
        echo '<p>' . __('Personaliza los logos de WordPress', 'whitelabel-wp-logo') . '</p>';
    }
    
    public static function icons_section_callback() {
        echo '<p>' . __('Personaliza los iconos del menú administrativo', 'whitelabel-wp-logo') . '</p>';
    }
    
    public static function login_logo_callback() {
        $options = get_option('whitelabel_wp_logo_settings');
        $logo_url = isset($options['login_logo']) ? $options['login_logo'] : '';
        ?>
        <div class="whitelabel-wp-logo-upload-container">
            <input type="text" name="whitelabel_wp_logo_settings[login_logo]" id="login_logo" value="<?php echo esc_url($logo_url); ?>" class="regular-text" />
            <button type="button" class="button whitelabel-wp-logo-upload-button" data-target="login_logo">
                <?php _e('Seleccionar Imagen', 'whitelabel-wp-logo'); ?>
            </button>
            <?php if ($logo_url) : ?>
                <div class="whitelabel-wp-logo-preview">
                    <img src="<?php echo esc_url($logo_url); ?>" style="max-width: 200px; height: auto; margin-top: 10px;" />
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
    
    public static function admin_logo_callback() {
        $options = get_option('whitelabel_wp_logo_settings');
        $logo_url = isset($options['admin_logo']) ? $options['admin_logo'] : '';
        ?>
        <div class="whitelabel-wp-logo-upload-container">
            <input type="text" name="whitelabel_wp_logo_settings[admin_logo]" id="admin_logo" value="<?php echo esc_url($logo_url); ?>" class="regular-text" />
            <button type="button" class="button whitelabel-wp-logo-upload-button" data-target="admin_logo">
                <?php _e('Seleccionar Imagen', 'whitelabel-wp-logo'); ?>
            </button>
            <?php if ($logo_url) : ?>
                <div class="whitelabel-wp-logo-preview">
                    <img src="<?php echo esc_url($logo_url); ?>" style="max-width: 200px; height: auto; margin-top: 10px;" />
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
    
    public static function replace_icons_callback() {
        $options = get_option('whitelabel_wp_logo_settings');
        $replace_icons = isset($options['replace_menu_icons']) ? $options['replace_menu_icons'] : false;
        ?>
        <label>
            <input type="checkbox" name="whitelabel_wp_logo_settings[replace_menu_icons]" value="1" <?php checked($replace_icons, 1); ?> />
            <?php _e('Reemplazar iconos del menú de WordPress y WooCommerce', 'whitelabel-wp-logo'); ?>
        </label>
        <p class="description">
            <?php _e('Nota: Esta característica reemplazará los iconos SVG nativos con versiones personalizadas.', 'whitelabel-wp-logo'); ?>
        </p>
        <?php
    }
    
    public static function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Configuración Whitelabel WP Logo', 'whitelabel-wp-logo'); ?></h1>
            
            <form method="post" action="options.php">
                <?php
                settings_fields('whitelabel_wp_logo_settings_group');
                do_settings_sections('whitelabel-wp-logo-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
