<!--titulo de la pagina-->
<?php require_once 'heads/head_1.php'; ?> Perfil
<?php require_once 'heads/head_2.php'; ?>
<!--titulo de la pagina fin-->
<!--librerias extras-->
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css" />
<link href="<?= base_url('assets/global/plugins/datatables/datatables.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet" type="text/css" />

<!--librerias extras fin-->
<!--cabeza de pagina-->
<?php require_once 'heads/head_3.php'; ?>
<!--fin de cabeza-->

<!--menu lateral-->
<?php require_once 'heads/menus.php'; ?>
<!--menu lateral fin-->

<!--contenido pagina-->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <h1 class="page-title"> USUARIOS
            <small>Lista de usuarios</small>
        </h1>
        <?php require_once 'heads/barra_url.php'; ?>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit  calendar">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-users font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">USUARIOS</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>



<!--fin del contenido de lapagina-->
<!--contenido pies de pagina-->
<?php require_once 'footers/foot_1.php';?>
<!-- fin contenido pies de pagina-->

<!--aqui se pueden agregar ls scrips necesarios  que nesesite la pagina-->



<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/scripts/datatable.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/datatables/datatables.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/pages/scripts/table-datatables-buttons.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable({
            buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }
       ],
        });
    });

</script>
<!--fin scrips-->

<!--scrips pie de pagina-->
<?php require_once 'footers/foot_2.php';?>
<!--fin scrips pie de pagina-->
