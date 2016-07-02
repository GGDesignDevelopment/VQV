<div style="display: none">
	<div id="contacto">
		<?php echo validation_errors();?>
		<form action="<?php echo site_url('contacto')?>" method="POST">
			<h1>Dejame un mensaje!</h1>
			<fieldset>
			<div>
				<label for="nombre">Nombre</label>
				<input type="text" id="nombre" name="nombre"></input>
			</div>
			<div>
				<label for="email">Mail</label>
				<input type="email" id="email" name="email"></input>
			</div>
			<div>
				<label for="celular">Celular</label>
				<input type="text" id="celular" name="celular"></input>
			</div>
			<div>
				<label for="texto">Mensaje</label>
				<textarea id="texto" name="texto"></textarea> 
			</div>
			<div>
				<button type="submit">enviar</button>
			</div>
			</fieldset>
		</form>
	</div>
</div>