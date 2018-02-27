(function ($) {
    $("#frm_agregar_unidad").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Learning_units/agregarUnidad',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('LNUT_name_alerta').style.display = 'none';
                document.getElementById('LNUT_description_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_unidad")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('LNUT_name_alerta').style.display = 'none';
                document.getElementById('LNUT_shortname_alerta').style.display = 'none';
                document.getElementById('LNUT_description_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    
                    if (json.LNUT_name.length != 0) {
                        $("#LNUT_name_alerta > div").html(json.LNUT_name);
                        document.getElementById('LNUT_name_alerta').style.display = 'inherit';
                    }
                    if (json.LNUT_description.length != 0) {
                        $("#LNUT_description_alerta > div").html(json.LNUT_description);
                        document.getElementById('LNUT_description_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
