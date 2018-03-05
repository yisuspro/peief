<div class="contentAjax">
    <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
    <div class="col-md-12">
        <div class="portlet light portlet-fit  calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-check-square font-yellow"></i>
                    <span class="caption-subject font-green sbold uppercase">PERMISOS ASIGNADOS</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-12">
                    <div class="actions">
                        <a id="atras" href="javascript:;" class="btn btn-simple btn-danger btn-icon create" title="Agregar un usuario"><i class="fa fa-reply"></i>atras</a>
                    </div>
                </div>
                <br><br><br>
                <table id="sample_1" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Versions</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Versions</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="portlet light portlet-fit  calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-remove font-red"></i>
                    <span class="caption-subject font-green sbold uppercase">PERMISOS PARA ASIGNAR</span>
                </div>
            </div>
            <div class="portlet-body">
                <table id="sample_2" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Versiones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Versiones</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
</div>
<script>
    $(document).ready(function() {
        var dt;
        dt = $('#sample_1');
        dt.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            "ajax": {
                url: '<?= base_url('Plans/listarVersionsPlans/'.$id); ?>',
                type: 'GET'
            },
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-print',
                    text: '<i class="fa fa-print"></i>'
                },
                {
                    extend: 'copy',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy',
                    text: '<i class="fa fa-files-o"></i>'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                },
                {
                    extend: 'csv',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                },

            ],
            pageLength: 10,
        });

        dt.on('click', '.remove', function(e) {
            var tr = this.id;
            eliminar = confirm("Seguro desea quitar este permiso?  " + tr);
            if (eliminar) {
                $.ajax({
                    url: 'Plans/eliminarVersionPlan/' + tr,
                    type: 'POST',
                    data: tr,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        alert('ocurrio algo inesperado por lo cual no se pudo eliminar el usuario')
                        $("#sample_1").DataTable().ajax.reload();
                    },

                });
            } else {
                alert('No se ha eliminado el usuario')
            }

        });
    });

</script>

<script>
    $(document).ready(function() {
        var dt;
        dt = $('#sample_2');
        dt.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            "ajax": {
                url: "<?= base_url('Plans/listarVersions'); ?>",
                type: 'GET'
            },
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-print',
                    text: '<i class="fa fa-print"></i>'
                },
                {
                    extend: 'copy',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy',
                    text: '<i class="fa fa-files-o"></i>'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                },
                {
                    extend: 'csv',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                },

            ],
            pageLength: 10,
        });

        dt.on('click', '.asignar', function(e) {
            var tr = this.id;
            eliminar = confirm("Seguro desea asignar este permiso al rol " + tr);
            if (eliminar) {
                $.ajax({
                    url: 'Plans/asignarVersion/' + <?php echo $id; ?> + '/' + tr,
                    type: 'POST',
                    data: tr,
                    success: function(data, xhr) {
                        $("#sample_1").DataTable().ajax.reload();
                        document.getElementById('alerta_principal').style.display = 'inherit';
                    },
                    error: function(xhr) {
                        if (xhr.status == 402) {
                            alert('el permiso ya se encuentra asignado')
                            $("#sample_1").DataTable().ajax.reload();
                        } else {
                            alert('error inesperado')
                            $("#sample_1").DataTable().ajax.reload();
                        }

                    },

                });
            } else {
                alert('No se ha agregado el rol')
            }

        });

        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'Plans';
            location.href = url;
        });
    });

</script>
