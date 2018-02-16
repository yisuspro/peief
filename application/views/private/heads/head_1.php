<!DOCTYPE html>
<?php if(!$this->session->userdata('logueado')){ ?>
<script> window.location.replace('http://localhost/peief/index.php/login');</script>
<?php } ?>
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>