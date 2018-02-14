(function ($) {
    $("#frm_agregar_usuario").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'registrar',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) { 
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display ='inherit';
                $("#frm_agregar_usuario")[0].reset();
            },
            error: function (xhr) {
                if (xhr.status == 402) {
                    $("#USER_PK > input").removeClass('is-invalid');
                    $("#USER_names > input").removeClass('is-invalid');
                    $("#USER_lastnames > input").removeClass('is-invalid');
                    $("#USER_email > input").removeClass('is-invalid');
                    $("#USER_address > input").removeClass('is-invalid');
                    $("#USER_telephone > input").removeClass('is-invalid');
                    $("#USER_password > input").removeClass('is-invalid');
                    var json = JSON.parse(xhr.responseText);
                    if (json.USER_PK.length != 0) {
                        $("#USER_PK > div").html(json.USER_PK);
                        $("#USER_PK > input").addClass('is-invalid');
                    }
                    if (json.USER_names.length != 0) {
                        $("#USER_names > div").html(json.USER_names);
                        $("#USER_names > input").addClass('is-invalid');
                    }
                    if (json.USER_lastnames.length != 0) {
                        $("#USER_lastnames > div").html(json.USER_lastnames);
                        $("#USER_lastnames > input").addClass('is-invalid');
                    }
                    if (json.USER_email.length != 0) {
                        $("#USER_email > div").html(json.USER_email);
                        $("#USER_email > input").addClass('is-invalid');
                    }
                    if (json.USER_address.length != 0) {
                        $("#USER_address > div").html(json.USER_address);
                        $("#USER_address > input").addClass('is-invalid');
                    }
                    if (json.USER_telephone.length != 0) {
                        $("#USER_telephone > div").html(json.USER_telephone);
                        $("#USER_telephone > input").addClass('is-invalid');
                    }
                    if (json.USER_password.length != 0) {
                        $("#USER_password > div").html(json.USER_password);
                        $("#USER_password > input").addClass('is-invalid');
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
