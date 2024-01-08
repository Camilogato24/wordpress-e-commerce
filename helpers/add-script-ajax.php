<?php

function enqueue_custom_scripts() {
    // Enqueue your main script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/custom-script.js', array('jquery'), null, true);

    // Define data to be passed to the script
    $script_data = array(
        'ajax_url' => admin_url('admin-ajax.php'), // URL del endpoint AJAX
        'nonce' => wp_create_nonce('my_custom_nonce'), // Puedes agregar nonces para seguridad
    );

    // Localize the script with the data
    wp_localize_script('custom-script', 'my_script_data', $script_data);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

?>