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
            
            <img src="img/registro.png" border="0">
        </div>
        <form id="login_form" action="index.php?ctrl=usuario&act=registrar" method="POST" autocomplete="off">  
            <div class="panel-body">
                <?php if(count($error_val) > 0){
                    foreach ($error_val as $err){ ?>                
                        <div class="alert alert-danger"><?php echo $err; ?></div>
                    <?php } ?>    
                <?php } ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-address-book-o" aria-hidden="true"></i>
                        </span>
                        <input id="usr_nombre" runat="server" type="text" class="form-control" name="usr_nombre" placeholder="Nombre" required=""  value="<?php if(isset($valor_campo['usr_nombre'])){ echo $valor_campo['usr_nombre'];}?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-address-book-o" aria-hidden="true"></i>
                        </span>
                        <input id="usr_apellido" runat="server" type="text" class="form-control" name="usr_apellido" placeholder="Apellido" required="" value="<?php if(isset($valor_campo['usr_apellido'])){ echo $valor_campo['usr_apellido'];}?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </span>
                        <input id="usr_mail" runat="server" type="email" class="form-control" name="usr_mail" placeholder="Mail" required=""value="<?php if(isset($valor_campo['usr_mail'])){ echo $valor_campo['usr_mail'];}?>"/>
                    </div>
                </div>                
                <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user" style="width: auto"></i>
                        </span>
                        <input id="usr_usuario" runat="server" type="text" class="form-control" name="usr_usuario" placeholder="Nombre de Usuario" required="" value="<?php if(isset($valor_campo['usr_usuario'])){ echo $valor_campo['usr_usuario'];}?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        <input id="usr_pass" runat="server" type="password" class="form-control" name="usr_pass" placeholder="Contraseña" required="" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        <input id="usr_repass" runat="server" type="password" class="form-control" name="usr_repass" placeholder="Repetir Contraseña" required="" />
                    </div>
                </div>
                <button id="btnLogin" runat="server" class="btn btn-default" style="width: 100%">
                    CONFIRMAR <i class="fa fa-check-square-o" aria-hidden="true"></i>
                </button>
            </div>            
        </form>        
        <div class="text-center panel-body"><a href="index.php?ctrl=login">Volver al inicio</a></div>    
    </div>
</div>
</body>
</html>