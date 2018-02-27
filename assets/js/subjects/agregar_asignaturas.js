(function ($) {
    $("#frm_agregar_asignatura").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Subjects/agregarAsignatura',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('SBJC_name_alerta').style.display = 'none';
                document.getElementById('SBJC_description_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_asignatura")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('SBJC_name_alerta').style.display = 'none';
                document.getElementById('SBJC_description_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    
                    if (json.SBJC_name.length != 0) {
                        $("#SBJC_name_alerta > div").html(json.SBJC_name);
                        document.getElementById('SBJC_name_alerta').style.display = 'inherit';
                    }
                    if (json.SBJC_description.length != 0) {
                        $("#SBJC_description_alerta > div").html(json.SBJC_description);
                        document.getElementById('SBJC_description_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
