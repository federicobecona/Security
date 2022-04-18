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
    <!------ Include the above in your HEAD tag ---------->
    <!-- Custom CSS -->    
    <link href="css/style.css" rel="stylesheet" id="style-css">    
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4">
    <br />
    <div class="panel panel-default">
        <div class="panel-heading " style="text-align: center;">
            
            <img src="logo.png" border="0">
        </div>
        <form id="login_form" action="index.php?ctrl=login" method="POST">  
            <div class="panel-body">
                <?php if(isset($error_val['login_incorrecto'])){ ?>
                    <div class="alert alert-danger"><?php echo $error_val['login_incorrecto']; ?></div>
                <?php } ?>
                <?php if(isset($error_val['usr_inactivo'])){ ?>
                    <div class="alert alert-danger"><?php echo $error_val['usr_inactivo']; ?></div>
                <?php } ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user" style="width: auto"></i>
                        </span>
                        <input id="usr" runat="server" type="text" class="form-control" name="usr" placeholder="Usuario" required="" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-lock" style="width: auto"></i>
                        </span>
                        <input id="pass" runat="server" type="password" class="form-control" name="pass" placeholder="Contraseña" required="" />
                    </div>
                </div>
                <button id="btnLogin" runat="server" class="btn btn-default" style="width: 100%">
                    INGRESAR<i class="glyphicon glyphicon-log-in"></i>
                </button>
            </div>            
        </form>
        <div class="text-center panel-body"><a href="index.php?ctrl=usuario&act=registrar">Registrarse</a></div>    
    </div>
</div>
</body>
</html>