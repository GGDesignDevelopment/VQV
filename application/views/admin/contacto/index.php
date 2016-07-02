<h2>Contactos</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Estado</th>				
			<th>Nombre</th>
			<th>Email</th>
			<th>Telefono</th>	
			<th>Edit</th>			
		</tr>
	</thead>
	<tbody>
	<?php if (count($contactos)): foreach ($contactos as $contacto): ?>
		<tr>
			<td><?php if ($contacto->estado == 0) {
				echo 'pendiente' ;
			} else { 
				echo 'Respondido';
			}
			
			?></td>
			<td><?php echo anchor('admin/contacto/edit/' . $contacto->id, $contacto->creado);?></td>						
			<td><?php echo $contacto->nombre;?></td>
			<td><?php echo $contacto->email;?></td>			
			<td><?php echo $contacto->celular;?></td>			
			<td><?php echo btn_edit('admin/contacto/edit/' . $contacto->id);?></td>						
		
		</tr>			
	<?php endforeach;?>
	<?php else: ?>
		<tr>
			<td colspan=6>No se encontraron usuarios</td>
		</tr>			
	<?php endif;?>					
	</tbody>
</table>