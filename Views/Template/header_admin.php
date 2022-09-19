<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Tienda Virtual Kayfa Store">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="SCRUM DSI-4">
    <meta name="theme-color" content="#009688">
    <link rel="shorcut icon" href="<?=media();?>/images/favicon.ico">

    <title><?php echo $data['tag_page'];?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>/css/style.css">
  
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?=base_url();?>/dashboard">Kayfa Store</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?=base_url();?>/opciones"><i class="fa fa-cog fa-lg"></i> Opciones</a></li>
            <li><a class="dropdown-item" href="<?=base_url();?>/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?=base_url();?>/logout"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <?php require_once("nav_admin.php");?>