<div class="page-header">
    <h2>Envase</h2>
    <?php echo anchor('admin/envase/edit', '<i class="glyphicon glyphicon-plus"></i> Agregar Envase'); ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Presentación</th>
                <th>Costo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="results">
            <?php if (count($envases)): foreach ($envases as $envase): ?>
                    <tr>
                        <td><?php echo $envase->envaseid; ?></td>
                        <td><?php echo anchor('admin/envase/edit/' . $envase->envaseid, $envase->envasenombre); ?></td>
                        <td><?php echo $envase->presentacion; ?></td>
                        <td><?php echo '$' . $envase->envasecosto; ?></td>
                        <td><?php echo btn_edit('admin/envase/edit/' . $envase->envaseid); ?></td>
                        <td><?php echo btn_delete('admin/envase/delete/' . $envase->envaseid); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=5>No se encontraron envases</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
