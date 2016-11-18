<div class="row">
    <div class="page-header col-xs-12">
        <h4><?php echo empty($producto->prodid) ? 'Nuevo Producto' : 'Editar Producto'; ?></h4>
    </div>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('', 'role="form" id="formEnvases"'); ?>

    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Código</label>
            <p class="form-control-static"><?php echo $producto->prodid; ?></p>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <?php echo form_input('prodnombre', $producto->prodnombre, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Descripcion</label>
            <?php echo form_input('proddes', $producto->proddes, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Familia</label>
            <?php echo form_dropdown('catid', $categorias, $producto->catid, 'class="form-control"'); ?>
        </div>

        <label>Imagen</label>
        <input id="file" type="file" name="file" class="file" data-preview-file-type="any" data-upload-url="#">
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <label>Presentación</label>
            <?php echo form_input('prodpresentacion', $producto->prodpresentacion, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Unidad</label>
            <?php echo form_dropdown('produnidad', $unidades, $producto->produnidad, 'class="form-control"'); ?>
        </div>
        <div class="form-group">
            <label>Precio</label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <?php echo form_input('prodprecio', $producto->prodprecio, 'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-6">
            <label>¿Granel?</label>
            <?php echo form_checkbox('prodgranel', '1', ($producto->prodgranel == '1')); ?>
        </div>
        <div class="form-group col-xs-12 col-sm-6">
            <label>¿Destacado?</label>
            <?php echo form_checkbox('prodinicio', '1', ($producto->prodinicio == '1')); ?>
        </div>
        <div class="form-group">
            <div id="envases" data-id="<?php echo $producto->prodid ?>"class="input-group">
              <?php echo form_dropdown('combo_envases', $combo_envases, 0,'class="form-control"'); ?>
              <span class="input-group-btn">
                <a class="btn btn-primary add">+</a>
              </span>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Envase</th>
                </tr>
            </thead>
            <tbody id="listaEnvases">
                <?php if (count($envases)): foreach ($envases as $envase): ?>
                        <tr data-id="<?php echo $envase->envaseid ?>">
                            <td><?php echo $envase->envasenombre; ?></td>
                            <td><a href="#" class="glyphicon glyphicon-trash"></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-xs-12">
        <div class="form-group pull-right">
          <!-- <button type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
          </button> -->
          <?php echo form_submit('submit', 'Confirmar', 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <div id="hiddens">
    </div>
    <?php echo form_close(); ?>
</div>
