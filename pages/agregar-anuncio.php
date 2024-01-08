<?php
/*
Template Name: Agregar el anuncio
*/
get_header();

?>

<!-- Formulario de Anuncio -->
<form id="formulario-anuncio">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" required>

    <label for="contenido">Contenido:</label>
    <textarea name="contenido" id="contenido" required></textarea>

    <label for="localizacion">Localización:</label>
    <input type="text" name="localizacion"><br>

    <label for="edad">Edad:</label>
    <input type="text" name="edad"><br>

    <label for="nombre_apodo">Nombre o Apodo:</label>
    <input type="text" name="nombre_apodo"><br>

    <input type="submit" value="Publicar Anuncio">
</form>

<!-- Mensaje de respuesta del formulario -->
<div id="mensaje-respuesta"></div>

<?php get_footer(); ?>
