(function ($) {
    $("#frm_agregar_version").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Versions/agregarVersions',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('VRSN_name_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_version")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('VRSN_name_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);

                    if (json.VRSN_name.length != 0) {
                        $("#VRSN_name_alerta > div").html(json.VRSN_name);
                        document.getElementById('VRSN_name_alerta').style.display = 'inherit';
                    }
                    
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
