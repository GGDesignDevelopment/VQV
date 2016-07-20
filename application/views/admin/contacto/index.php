<h2>Contactos</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>            				
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Periodicidad</th>	
            <th>Estado</th>			
        </tr>
    </thead>
    <tbody>
        <?php if (count($contactos)): foreach ($contactos as $contacto): ?>
                <tr>           
                    <td><?php echo $contacto->email; ?></td>
                    <td><?php echo $contacto->nombre; ?></td>
                    <td><?php echo $contacto->apellido; ?></td>
                    <td><?php echo ($contacto->periodicidad == 'M') ? 'Mensual' : 'Semanal'; ?></td>
                    <td><?php echo ($contacto->activo == 0) ? 'Activo' : 'Inactivo'; ?></td>			                    
                </tr>			
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan=5>No se encontraron usuarios</td>
            </tr>			
        <?php endif; ?>					
    </tbody>
</table>