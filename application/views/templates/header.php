<html>
    <head>
        <meta charset="utf-8">
        <title>Colonos de Monteverde</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-3.2.1.min.js"
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/login.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/designs.css">
        </head>
        <body>
            <nav class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">Colonos de Monteverde</a>
                    </div>
                    <div id="navbar">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url(); ?>">Inicio</a></li>
                            <li><a href="<?php echo base_url(); ?>news">Noticias</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('es_admin') == 1) : ?>
                                <li><a href="">Personas fisicas</a></li>
                                <li><a href="">Personas morales</a></li>
                                <li><a href="">Propiedades</a></li>
                                <li><a href="">Chat</a></li>
                                <li><a href="<?php echo base_url(); ?>registro">Usuarios</a></li>
                                <li><a href="<?php echo base_url(); ?>usuarios/logout">Salir</a></li>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('es_admin') == 0) : ?>
                                <li><a href="">Chat</a></li>
                                <li><a href="<?php echo base_url(); ?>usuarios/logout">Salir</a></li>
                            <?php endif; ?>
                            <?php if (!$this->session->userdata('logged_in')) : ?>
                                <li><a href="<?php echo base_url(); ?>usuarios/login">Iniciar sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">

                <?php if ($this->session->flashdata('user_registered')) : ?>
                    <?php
                    echo '<p class="alert alert-success text-center">' . $this->session->flashdata('user_registered') . '</p>';
                    $self = $_SERVER['PHP_SELF'];
                    header("refresh:2; url=$self");
                    ?>
                <?php endif; ?>

                <?php if ($this->session->flashdata('login_failed')) : ?>
                    <?php
                    echo '<p class="alert alert-danger text-center">' . $this->session->flashdata('login_failed') . '</p>';
                    $self = $_SERVER['PHP_SELF'];
                    header("refresh:2; url=$self");
                    ?>
                <?php endif; ?>

                <?php if ($this->session->flashdata('user_loggedin')) : ?>
                    <?php
                    echo '<p class="alert alert-success text-center">' . $this->session->flashdata('user_loggedin') . '</p>';
                    $self = $_SERVER['PHP_SELF'];
                    header("refresh:2; url=$self");
                    ?>
                <?php endif; ?>

                <?php if ($this->session->flashdata('user_loggedout')) : ?>
                    <?php
                    echo '<p class="alert alert-success text-center">' . $this->session->flashdata('user_loggedout') . '</p>';
                    $self = $_SERVER['PHP_SELF'];
                    header("refresh:2; url=$self");
                    ?>
               <?php endif; ?>

              <?php if ($this->session->flashdata('user_exists')) : ?>
                    <?php
                    echo '<p class="alert alert-danger text-center">' . $this->session->flashdata('user_exists') . '</p>';
                    $self = $_SERVER['PHP_SELF'];
                    header("refresh:1; url=$self");
                    ?>
               <?php endif; ?>

