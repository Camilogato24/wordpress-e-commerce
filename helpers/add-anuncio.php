<?php
// Hook para la acción AJAX
add_action('wp_ajax_crear_anuncio', 'crear_anuncio');
add_action('wp_ajax_nopriv_crear_anuncio', 'crear_anuncio');

function crear_anuncio() {
    // Verificar la seguridad con el nonce
    check_ajax_referer('mi_nonce_personalizado', 'nonce');
    parse_str($_POST['form_data'], $formulario_datos);
    echo '<pre>';
    print_r($formulario_datos);

    // Verificar si el usuario actual tiene los permisos necesarios

    if (!current_user_can('manage_options')) {
        wp_die('No tienes los permisos necesarios.');
    }

    // Obtener datos del formulario
    // parse_str($_POST['form_data'], $formulario_datos);
    // echo '<pre>';
    // print_r($formulario_datos);
    // Crear un nuevo Anuncio
    $nuevo_anuncio = array(
        'post_title'   => sanitize_text_field($formulario_datos['titulo']),
        'post_content' => wp_kses_post($formulario_datos['contenido']),
        'post_status'  => 'publish',
        'post_type'    => 'anuncio'
    );

    $id_anuncio = wp_insert_post($nuevo_anuncio);

    if ($id_anuncio) {
        // Agregar metadatos personalizados
        update_post_meta($id_anuncio, 'localizacion', sanitize_text_field($formulario_datos['localizacion']), true);
        update_post_meta($id_anuncio, 'edad', sanitize_text_field($formulario_datos['edad']), true);
        update_post_meta($id_anuncio, 'nombre_apodo', sanitize_text_field($formulario_datos['nombre_apodo']), true);

        $response = array(
            'success' => true,
            'message' => 'Anuncio creado con éxito.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error al crear el Anuncio.'
        );
    }

    // Devolver respuesta como JSON
    wp_send_json($response);
    wp_die();
}

?>
