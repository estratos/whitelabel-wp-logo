<?php
/**
 * Plugin Name: Whitelabel WP Logo
 * Plugin URI: https://tusitio.com
 * Description: Convierte tu instalación de WordPress en whitelabel cambiando logos e iconos
 * Version: 1.0.0
 * Author: Tu Nombre
 * License: GPL v2 or later
 * Text Domain: whitelabel-wp-logo
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes
define('WHITELABEL_WP_LOGO_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WHITELABEL_WP_LOGO_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Incluir archivos necesarios
require_once WHITELABEL_WP_LOGO_PLUGIN_PATH . 'includes/admin-settings.php';
require_once WHITELABEL_WP_LOGO_PLUGIN_PATH . 'includes/login-customizations.php';
require_once WHITELABEL_WP_LOGO_PLUGIN_PATH . 'includes/admin-customizations.php';

// Inicializar el plugin
function whitelabel_wp_logo_init() {
    // Cargar traducciones
    load_plugin_textdomain('whitelabel-wp-logo', false, dirname(plugin_basename(__FILE__)) . '/languages');
    
    // Inicializar componentes
    Whitelabel_WP_Logo_Admin_Settings::init();
    Whitelabel_WP_Logo_Login_Customizations::init();
    Whitelabel_WP_Logo_Admin_Customizations::init();
}
add_action('plugins_loaded', 'whitelabel_wp_logo_init');

// Función de activación
function whitelabel_wp_logo_activate() {
    // Configuración por defecto
    $default_options = array(
        'login_logo' => '',
        'admin_logo' => '',
        'replace_menu_icons' => false,
        'remove_wp_menu' => true, // Nueva opción por defecto
        'custom_menu_icons' => array()
    );
    
    add_option('whitelabel_wp_logo_settings', $default_options);
}
register_activation_hook(__FILE__, 'whitelabel_wp_logo_activate');

// Función de desactivación
function whitelabel_wp_logo_deactivate() {
    // Limpiar opciones si es necesario
    // delete_option('whitelabel_wp_logo_settings');
}
register_deactivation_hook(__FILE__, 'whitelabel_wp_logo_deactivate');