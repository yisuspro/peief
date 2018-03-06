
<div class="contentAjax">
    <!-- espacio de trabajo _______________________________________________________________________________________________________________________________________________________ -->
<style>.checkbox{display:none}
.switch
{
width: 62px;
height: 32px;
background: #E5E5E5;
z-index: 0;
margin: 0;
padding: 0;
appearance: none;
border: none;
cursor: pointer;
position: relative;
border-radius:16px; //IE 11
-moz-border-radius:16px; //Mozilla
-webkit-border-radius:16px; //Chrome and Safari
}
.switch:before
{
content: ' ';
position: absolute;
left: 1px;
top: 1px;
width: 60px;
height: 30px;
background: #FFFFFF;
z-index: 1;
border-radius:16px; //IE 11
-moz-border-radius:16px; //Mozilla
-webkit-border-radius:16px; //Chrome and Safari
}
.switch:after 
{
content: ' ';
height: 29px;
width: 29px;
border-radius: 28px;
background: #FFFFFF;
position: absolute;
z-index: 2;
top: 1px;
left: 1px;
-webkit-transition-duration: 300ms;
transition-duration: 300ms;
-webkit-box-shadow: 0 2px 5px #999999;
box-shadow: 0 2px 5px #999999;
}
.switchOn , .switchOn:before
{
background: #4cd964 !important;
}
.switchOn:after
{
left: 21px !important;
}</style>    
   
    <div class="col-md-12">
        <div class="portlet light portlet-fit  calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-remove font-red"></i>
                    <span class="caption-subject font-green sbold uppercase">PERMISOS PARA ASIGNAR</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-12">
                    <div class="actions">
                        <a id="atras" href="javascript:;" class="btn btn-simple btn-danger btn-icon create" title="Agregar un usuario"><i class="fa fa-reply"></i>atras</a>
                    </div>
                </div>
                <br><br><br>
                <table id="sample_2" class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Permiso</th>
                            <th>Nombre corto</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Permiso</th>
                            <th>Nombre corto</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach($tabla->result_array() as $r) {
                            echo '<tr>';
                            echo '<th>'.$r['PRMS_name'].'</th>';
                            echo '<th>'.$r['PRMS_shortname'].'</th>';
                            echo '<th>'.$r['PRMS_description'].'</th>';
                            if($this->Permits->consultarPermisoRol($id,$r['PRMS_PK'])){
                                echo '<th>'.'<label><input type="checkbox" value="'.$r['PRMS_PK'].'" name="checkboxName"  class="checkbox"/><div class="switch switchOn" id="'.$r['PRMS_PK'].'"></div></label>'.'</th>';
                            echo '</tr>';
                            }else{
                                echo '<th>'.'<label><input type="checkbox" value="'.$r['PRMS_PK'].'" name="checkboxName"  class="checkbox"/><div class="switch" id="'.$r['PRMS_PK'].'"></div></label>'.'</th>';
                                echo '</tr>';
                            }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- fin espacio de trabajo_______________________________________________________________________________________________________________________ -->
</div>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        var dt;
        dt = $('#sample_2');
        dt.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
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
        $("#atras").on('click', function(e) {
            e.preventDefault();
            var url = 'Roles';
            location.href = url;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.switch').click(function() {
            if (!$(this).hasClass('switchOn')) {
                $(this).toggleClass("switchOn");
                var tr = this.id;
                $.ajax({
                    url: 'Roles/asignarPermisoRol/' + <?php echo $id;?> + '/' + tr,
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
                var tr = this.id;
                $(this).toggleClass("switchOn");
                
                $.ajax({
                    url: 'Permisos/eliminarPermisosRol/'+<?php echo $id;?>+'/'+tr,
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
            }
        });

    });
</script>