jQuery(document).ready(function($) {
    // Manejar la subida de archivos
    $('.whitelabel-wp-logo-upload-button').on('click', function(e) {
        e.preventDefault();
        
        var target = $(this).data('target');
        var button = $(this);
        
        var custom_uploader = wp.media({
            title: 'Seleccionar Logo',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false
        });
        
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#' + target).val(attachment.url);
            
            // Mostrar preview
            var previewHtml = '<div class="whitelabel-wp-logo-preview"><img src="' + attachment.url + '" style="max-width: 200px; height: auto; margin-top: 10px;" /></div>';
            button.siblings('.whitelabel-wp-logo-preview').remove();
            button.after(previewHtml);
        });
        
        custom_uploader.open();
    });
});
