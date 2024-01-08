<?php

function registrar_custom_post_type_anuncio() {
    $labels = array(
        'name'               => 'Anuncios',
        'singular_name'      => 'Anuncio',
        'menu_name'          => 'Anuncios',
        'add_new'            => 'Agregar Nuevo',
        'add_new_item'       => 'Agregar Nuevo Anuncio',
        'edit_item'          => 'Editar Anuncio',
        'new_item'           => 'Nuevo Anuncio',
        'view_item'          => 'Ver Anuncio',
        'search_items'       => 'Buscar Anuncios',
        'not_found'          => 'No se encontraron Anuncios',
        'not_found_in_trash' => 'No se encontraron Anuncios en la papelera',
        'all_items'          => 'Todos los Anuncios',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'anuncio'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
    );

    register_post_type('anuncio', $args);
}

add_action('init', 'registrar_custom_post_type_anuncio');

function agregar_campos_personalizados_anuncio() {
    add_meta_box(
        'campos_personalizados',
        'Campos Personalizados',
        'mostrar_formulario_campos_personalizados',
        'anuncio',
        'normal',
        'high'
    );
}

function mostrar_formulario_campos_personalizados($post) {
    // Recuperar los valores actuales de los campos personalizados
    $localizacion = get_post_meta($post->ID, 'localizacion', true);
    $edad = get_post_meta($post->ID, 'edad', true);
    $nombre_apodo = get_post_meta($post->ID, 'nombre_apodo', true);
    $top = get_post_meta($post->ID, 'top', true);
    $premium = get_post_meta($post->ID, 'premium', true);
    $precio = get_post_meta($post->ID, 'precio', true);
    $nacionalidad = get_post_meta($post->ID, 'nacionalidad', true);

    // Aquí puedes crear el formulario con los campos personalizados
    echo '<style>
            .form-cpt-anuncio {
                max-width: 350px;
                display: flex;
                flex-direction: column;
            }
            .form-cpt-anuncio label {
                margin-bottom: 5px;
            }
            .form-cpt-anuncio input {
                width: 100%;
                margin-bottom: 10px;
            }
          </style>';
    ?>
    <div class="form-cpt-anuncio">
        <label for="localizacion">Localización:</label>
        <input type="text" name="localizacion" value="<?php echo esc_attr($localizacion); ?>"><br>

        <label for="edad">Edad:</label>
        <input type="text" name="edad" value="<?php echo esc_attr($edad); ?>"><br>

        <label for="nombre_apodo">Nombre o Apodo:</label>
        <input type="text" name="nombre_apodo" value="<?php echo esc_attr($nombre_apodo); ?>"><br>

        <label for="nombre_apodo">Top:</label>
        <input type="text" name="top" value="<?php echo esc_attr($top); ?>"><br>

        <label for="nombre_apodo">Premium:</label>
        <input type="text" name="premium" value="<?php echo esc_attr($premium); ?>"><br>

        <label for="nombre_apodo">Precio:</label>
        <input type="text" name="precio" value="<?php echo esc_attr($precio); ?>"><br>

        <label for="nombre_apodo">Nacionalidad:</label>
        <input type="text" name="nacionalidad" value="<?php echo esc_attr($nacionalidad); ?>"><br>
    </div>
    <?php
}

function guardar_campos_personalizados_anuncio($post_id) {
    // Guardar los valores de los campos personalizados cuando se guarda la publicación
    if (isset($_POST['localizacion'])) {
        update_post_meta($post_id, 'localizacion', sanitize_text_field($_POST['localizacion']));
    }
    if (isset($_POST['edad'])) {
        update_post_meta($post_id, 'edad', sanitize_text_field($_POST['edad']));
    }
    if (isset($_POST['nombre_apodo'])) {
        update_post_meta($post_id, 'nombre_apodo', sanitize_text_field($_POST['nombre_apodo']));
    }
    if (isset($_POST['premium'])) {
        update_post_meta($post_id, 'premium', sanitize_text_field($_POST['premium']));
    }
    if (isset($_POST['top'])) {
        update_post_meta($post_id, 'top', sanitize_text_field($_POST['top']));
    }
    if (isset($_POST['precio'])) {
        update_post_meta($post_id, 'precio', sanitize_text_field($_POST['precio']));
    }
    if (isset($_POST['nacionalidad'])) {
        update_post_meta($post_id, 'nacionalidad', sanitize_text_field($_POST['nacionalidad']));
    }
}

add_action('add_meta_boxes', 'agregar_campos_personalizados_anuncio');
add_action('save_post', 'guardar_campos_personalizados_anuncio');

?>
