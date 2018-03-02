<!DOCTYPE html>
<?php if(!$this->session->userdata('logueado')){ ?>
<script> window.location.replace('http://localhost/peief/index.php/login');</script>
<?php } ?>
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php
        $ci = &get_instance();
        $ci->load->model("Logueo");
        $id=$this->session->userdata('id');
        $ca = &get_instance();
        $ca->load->model("Permits");
        $ca = &get_instance();
        $ca->load->model("Role");
        ?>
        <meta charset="utf-8" />
        <title>