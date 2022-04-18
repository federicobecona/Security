<div class="container votar-panel">
   <div class="row">
    <div class="col-md-12">
        <div class="panel-body">            
            <table class="table">
			  <tr>
			    <th>Nombre</th>
			    <th>Apellido</th>
			    <th>Mail</th>
			    <th>Usuario</th>
			    <th>Estado</th>
			    <th>Acción</th>
			  </tr>
			  <?php if(count($usuarios)>0){ ?>
			  	<?php foreach ($usuarios as $usr) { ?>
				  <tr>
				    <td><?php echo $usr['usr_nombre']; ?></td>
				    <td><?php echo $usr['usr_apellido']; ?></td>
				    <td><?php echo $usr['usr_mail']; ?></td>
				    <td><?php echo $usr['usr_usuario']; ?></td>
				    <td><?php echo $usr['usr_estado']; ?></td>
				    <td><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> <a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</a></td>
				  </tr>
				<?php } ?>	
			<?php } ?>		  
			</table>            
       </div>
   </div>
</div>