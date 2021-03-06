(function ($) {
    $("#frm_agregar_cicle").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'Cicles/agregarCicles',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                document.getElementById('CCLS_name_alerta').style.display = 'none';
                $("#sample_1").DataTable().ajax.reload();
                $('#agregar').removeClass('fade-in');
                $('#agregar').addClass('fade');
                document.getElementById('agregar').style.display = 'none';
                document.getElementById('alerta_principal').style.display = 'inherit';
                $("#frm_agregar_cicle")[0].reset();
            },
            error: function (xhr) {
                document.getElementById('CCLS_name_alerta').style.display = 'none';
                if (xhr.status == 402) {
                    var json = JSON.parse(xhr.responseText);
                    if (json.CCLS_name.length != 0) {
                        $("#CCLS_name_alerta > div").html(json.CCLS_name);
                        document.getElementById('CCLS_name_alerta').style.display = 'inherit';
                    }
                } else if (xhr.status == 401) {
                    document.getElementById('alerta').style.display = 'inherit';
                }
            },

        });
    });
})(jQuery)
