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

        <form id="login_form" action="index.php?ctrl=usuario&act=activarUsr" method="POST" autocomplete="off">  
            <div class="panel-body">
                <div class="form-group">

                    <input id="tkn_token" runat="server" type="hidden" class="form-control" name="tkn_token" value = "<?php echo $tkn_token;?>"/>

                    <button id="btnLogin" runat="server" class="btn btn-default" style="width: 100%">
                        ACTIVAR <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </button>

                </div>
            </div>            
        </form>

        <div class="panel-heading " style="text-align: center;">
            <h4> <?php if(isset($msg)) echo $msg; ?> </h4>
            <a href="index.php">Inicio</a>
        </div>        



    </div>


</div>
</body>
</html>