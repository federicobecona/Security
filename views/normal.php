<!DOCTYPE html>
<html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $descripcion_pagina; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="">
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- Bootstrap Core CSS -->
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!-- Custom CSS -->    
    <link href="css/style.css" rel="stylesheet" id="style-css">    
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">        
</head>
<body>
    

    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand"> App Seguridad</a>
        </div>
        <ul class="nav navbar-nav">
        <li <?php if( !isset($_GET['act']) || $_GET['act']=="index"){ ?> class="active" <?php } ?> ><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Inicio</a></li>
        
        <?php if(empty($row_adm)){ ?>
        <li><a href="index.php?ctrl=usuario&act=funcionalidad"><i class="fa fa-window-maximize" aria-hidden="true"></i> Funcionalidad</a></li>
        <?php } ?>   
                        
        <?php if(!empty($row_adm)){ ?>
        <li><a href="index.php?ctrl=usuario&act=listar"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</a></li>
        <?php } ?>   
                
        <li><a href="index.php?ctrl=login&act=logout"><i class="fa fa-sign-out" aria-hidden="true"></i></i> Salir</a></li>
        </ul>
    </div>
    </nav>

    <?php if(!empty($seccion)) include_once($seccion); ?>	
    
    
    <!--  -->
    <?php if(!empty($js)){ ?>
        <?php foreach ($js as $vjs){ ?>
            <script src="<?php echo "views/js/".$vjs; ?>" type="text/javascript" charset="utf-8"></script>
        <?php } ?>
    <?php } ?>


</body>

</html>
