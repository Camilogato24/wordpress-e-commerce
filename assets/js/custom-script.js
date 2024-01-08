jQuery(document).ready(function($) {
    $('#formulario-anuncio').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var ajaxUrl = my_script_data.ajax_url;
        var nonce = my_script_data.nonce;

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: {
                action: 'crear_anuncio',
                nonce: nonce,
                form_data: formData
            },
            success: function(response) {
                if (response.success) {
                    alert('Anuncio creado con éxito.');
                } else {
                    alert('Error al crear el Anuncio: ' + response.message);
                }
            },
            error: function(error) {
                console.log(error);
                alert('ERROR AL CREAR ANUNCIO', error);
            }
        });
    });
});
