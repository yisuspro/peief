(function ($) {
    $("#frm_agregar_usuario").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'registrar',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('USER_identification_alerta').style.display = 'none';
                document.getElementById('USER_names_alerta').style.display = 'none';
                document.getElementById('USER_lastnames_alerta').style.display = 'none';
                document.getElementById('USER_email_alerta').style.display = 'none';
                document.getElementById('USER_address_alerta').style.display = 'none';
                document.getElementById('USER_telephone_alerta').style.display = 'none';
                document.getElementById('USER_password_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_usuario")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('USER_identification_alerta').style.display = 'none';
                document.getElementById('USER_names_alerta').style.display = 'none';
                document.getElementById('USER_lastnames_alerta').style.display = 'none';
                document.getElementById('USER_email_alerta').style.display = 'none';
                document.getElementById('USER_address_alerta').style.display = 'none';
                document.getElementById('USER_telephone_alerta').style.display = 'none';
                document.getElementById('USER_password_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    if (json.USER_identification.length != 0) {
                        $("#USER_identification_alerta > div").html(json.USER_identification);
                        document.getElementById('USER_identification_alerta').style.display = 'inherit';
                    }
                    if (json.USER_names.length != 0) {
                        $("#USER_names_alerta > div").html(json.USER_names);
                        document.getElementById('USER_names_alerta').style.display = 'inherit';
                    }
                    if (json.USER_lastnames.length != 0) {
                        $("#USER_lastnames_alerta > div").html(json.USER_lastnames);
                        document.getElementById('USER_lastnames_alerta').style.display = 'inherit';
                    }
                    if (json.USER_email.length != 0) {
                        $("#USER_email_alerta > div").html(json.USER_email);
                        document.getElementById('USER_email_alerta').style.display = 'inherit';
                    }
                    if (json.USER_address.length != 0) {
                        $("#USER_address_alerta > div").html(json.USER_address);
                        document.getElementById('USER_address_alerta').style.display = 'inherit';
                    }
                    if (json.USER_telephone.length != 0) {
                        $("#USER_telephone_alerta > div").html(json.USER_telephone);
                        document.getElementById('USER_telephone_alerta').style.display = 'inherit';
                    }
                    if (json.USER_password.length != 0) {
                        $("#USER_password_alerta > div").html(json.USER_password);
                        document.getElementById('USER_password_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
