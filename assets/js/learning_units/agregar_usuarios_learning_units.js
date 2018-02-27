(function ($) {
    $("#frm_agregar_usuario").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Learning_units/agregarUsuario/',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('USLE_FK_users_alerta').style.display = 'none';
                document.getElementById('alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_usuario")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('alerta').style.display = 'none';
                document.getElementById('USLE_FK_users_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    if (json.USLE_FK_users.length != 0) {
                        $("#USLE_FK_users_alerta > div").html(json.USLE_FK_users);
                        document.getElementById('USLE_FK_users_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                } else if (xhr.status == 403) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
                document.getElementById('alerta').style.display = 'inherit';
            },

        });
    });
})(jQuery)
