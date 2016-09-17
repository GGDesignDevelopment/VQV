<div class="page-header">
    <h2>Usuarios</h2>
    <?php echo anchor('admin/user/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Usuario'); ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
<!--            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th></th>
                <th></th>
            </tr>-->
            <tr>
                <th><input id="name" class="form-control" type="text" onkeyup="showResults()" placeholder="Nombre"></th>
                <th><input id="email" class="form-control" type="text" onkeyup="showResults()" placeholder="Email"></th>
                <th>
                    <select id="type" class="form-control" type="text" onchange="showResults()">                        
                        <option value="A">Admin</option>
                        <option value="C">Comun</option>
                    </select></th>
                <th><input id="phone" class="form-control" type="text" onkeyup="showResults()" placeholder="Telefono"></th>   
                <th>Dirección</th>
                <th></th>
                <th></th>
            </tr>
        </thead>    
        <tbody id="results">
            <?php if (count($users)): foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo anchor('admin/user/edit/' . $user->email, $user->email); ?></td>	                       
                        <td><?php echo ($user->type == 'A') ? 'Admin' : 'Comun'; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo $user->address; ?></td>
                        <td><?php echo btn_edit('admin/user/edit/' . $user->email); ?></td>
                        <td><?php echo btn_delete('admin/user/delete/' . $user->email); ?></td>				
                    </tr>			
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=7>No se encontraron usuarios</td>
                </tr>			
            <?php endif; ?>					
        </tbody>
    </table>
</div>
