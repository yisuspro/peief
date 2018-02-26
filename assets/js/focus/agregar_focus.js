(function ($) {
    $("#frm_agregar_focus").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Focus/agregarFocus',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('FOCS_name_alerta').style.display = 'none';
                document.getElementById('FOCS_description_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_focus")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('FOCS_name_alerta').style.display = 'none';
                document.getElementById('FOCS_description_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    
                    if (json.FOCS_name.length != 0) {
                        $("#FOCS_name_alerta > div").html(json.FOCS_name);
                        document.getElementById('FOCS_name_alerta').style.display = 'inherit';
                    }
                    if (json.FOCS_description.length != 0) {
                        $("#FOCS_description_alerta > div").html(json.FOCS_description);
                        document.getElementById('FOCS_description_alerta').style.display = 'inherit';
                    }
                    
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
