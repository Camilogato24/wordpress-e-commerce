<?php

function mostrar_anuncios_shortcode($atts) {
    // Configura el loop para recuperar los anuncios
    $anuncios_query = new WP_Query(array(
        'post_type' => 'anuncio',
        'posts_per_page' => 3,
    ));

    // Inicia la salida
    $output = '<div class="anuncios-lista" id="list-anuncios">';

    // Comprueba si hay anuncios
    if ($anuncios_query->have_posts()) {
        while ($anuncios_query->have_posts()) {
            $anuncios_query->the_post();

            // Agrega el contenido de cada anuncio
            $output .= '<div class="anuncio">';
            // Muestra la imagen destacada
            if (has_post_thumbnail()) {
                $output .= '<div class="anuncio-imagen">' . get_the_post_thumbnail() . '</div>';
            }

            // Muestra el contenido
            $output .= '<div class="anuncio-contenido">';
            $output .= '<h2>' . get_the_title() . '</h2>';
            $output .= '<p class="description">' . get_the_content(); '</div>';
            $output .= '<p>Localización: ' . get_post_meta(get_the_ID(), 'localizacion', true) . '</p>';
            $output .= '<p>Edad: ' . get_post_meta(get_the_ID(), 'edad', true) . '</p>';
            $output .= '<p>Nombre o apodo: ' . get_post_meta(get_the_ID(), 'nombre_apodo', true) . '</p>';
            $output .= '</div>';
            $output .= '</div>';
        }
    }   else {
        $output .= '<p>No hay anuncios disponibles.</p>';
    }

    $output .= '</div>';

    return $output;
}

function mostrar_anuncios_lista_completa_shortcode($atts) {
    // Configura el loop para recuperar los anuncios
    $anuncios_query = new WP_Query(array(
        'post_type' => 'anuncio',
        'posts_per_page' => -1,
    ));

    // Inicia la salida
    $output = '<div class="anuncios-lista" id="row-anuncios">';

    // Comprueba si hay anuncios
    if ($anuncios_query->have_posts()) {
        while ($anuncios_query->have_posts()) {
            $anuncios_query->the_post();

            // Agrega el contenido de cada anuncio
            $output .= '<div class="anuncio">';
            // Muestra la imagen destacada
            if (has_post_thumbnail()) {
                $output .= '<div class="anuncio-imagen">' . get_the_post_thumbnail() . '</div>';
            }

            // Muestra el contenido
            $output .= "
                <div class=\"anuncio-contenido\">
                    <div class=\"top-contenido\">
                        <p>" . get_post_meta(get_the_ID(), 'top', true) . "</p>
                        <p>" . get_post_meta(get_the_ID(), 'premium', true) . "</p>
                    </div>
                    <h2>" . get_the_title() . "</h2>
                    <p>" . get_the_content() . "</p>
                    <div class=\"social-media\">
                        <img class=\"wp\" src=\"" . get_template_directory_uri() . "/assets/images/whatsapp.png\">
                        <p>" . get_post_meta(get_the_ID(), 'edad', true) . " Años</p>
                        <p>" . get_post_meta(get_the_ID(), 'nacionalidad', true) . "</p>
                        <p class=\"price\">" . get_post_meta(get_the_ID(), 'precio', true) . " €</p>
                        <p>" . get_post_meta(get_the_ID(), 'localizacion', true) . "</p>
                        <p>" . get_post_meta(get_the_ID(), 'nombre_apodo', true) . "</p>
                        <div class=\"heart\"> </div>
                    </div>
                </div>
            </div>
            ";
        }
    }   else {
        $output .= '<p>No hay anuncios disponibles.</p>';
    }

    $output .= '</div>';

    return $output;
}


// Registra el shortcode
add_shortcode('anuncios_shortcode', 'mostrar_anuncios_shortcode');
add_shortcode('anuncios_shortcode_total', 'mostrar_anuncios_lista_completa_shortcode');

?>