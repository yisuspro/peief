<!--titulo de la pagina-->
<?php require_once 'heads/head_1.php'; ?> Lista usuarios
<?php require_once 'heads/head_2.php'; ?>
<!--titulo de la pagina fin-->
<!--librerias extras-->
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

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
                        <table id="sample_1" class="display" cellspacing="0" width="100%">
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
<script>
jQuery(document).ready(function (){
    var table, url;
    table = $('#sample_1');
    url = "{{ route('Listar_Convenios.Listar_Convenios') }}";
    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       searching: true,
       language: {
           "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
           "sLengthMenu": "Mostrar _MENU_ registros",
           "sZeroRecords": "No se encontraron resultados",
           "sEmptyTable": "Ningún dato disponible en esta tabla",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix": "",
           "sSearch": "Buscar:",
           "sUrl": "",
           "sInfoThousands": ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
       },
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'PK_Convenios', "visible": true, name:"documento" },
           {data: 'Nombre', searchable: true},
           {data: 'Fecha_Inicio', searchable: true},
           {data: 'Fecha_Fin',searchable: true},
           {data: 'convenios__estados.Estado', searchable: true},
           {data: 'convenios__sedes.Sede',searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" id="editar" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="#" id="ver" title="Documentos e informacion del Convenio" class="btn btn-simple btn-success btn-icon editar2"><i class="icon-notebook"></i></a>'

            
        }
           
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }
       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
} );</script>
<!--fin scrips-->

<!--scrips pie de pagina-->
<?php require_once 'footers/foot_2.php';?>
<!--fin scrips pie de pagina-->
