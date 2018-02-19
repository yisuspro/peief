(function ($) {
    $("#frm_agregar_permiso").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Permisos/agregarPermisos',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('PRMS_name_alerta').style.display = 'none';
                document.getElementById('PRMS_shortname_alerta').style.display = 'none';
                document.getElementById('PRMS_description_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_permiso")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('PRMS_name_alerta').style.display = 'none';
                document.getElementById('PRMS_shortname_alerta').style.display = 'none';
                document.getElementById('PRMS_description_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    
                    if (json.PRMS_name.length != 0) {
                        $("#PRMS_name_alerta > div").html(json.PRMS_name);
                        document.getElementById('PRMS_name_alerta').style.display = 'inherit';
                    }
                    if (json.PRMS_shortname.length != 0) {
                        $("#PRMS_shortname_alerta > div").html(json.PRMS_shortname);
                        document.getElementById('PRMS_shortname_alerta').style.display = 'inherit';
                    }
                    if (json.PRMS_description.length != 0) {
                        $("#PRMS_description_alerta > div").html(json.PRMS_description);
                        document.getElementById('PRMS_description_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
