<div class="container">
    <div class="col-xs-12">
	</div>
    <div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $accion; ?> Mensaje <a href="<?php echo site_url('mensajes/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
				<div class="panel-body">
					<form method="post" action="" class="form">
						<div class="form-group">
							<label for="titulo">Titulo</label>
							<input type="text" class="form-control" name="titulo" placeholder="Ingrese titulo" value="<?php echo !empty($mensaje['titulo'])?$mensaje['titulo']:''; ?>" required="">
							<?php echo form_error('titulo','<p class="help-block text-danger">','</p>'); ?>
						</div>
						<div class="form-group">
							<label for="contenido">Contenido</label>
							<textarea name="contenido" class="form-control" placeholder="Ingrese contenido"><?php echo !empty($mensaje['contenido'])?$mensaje['contenido']:''; ?></textarea>
							<?php echo form_error('contenido','<p class="text-danger">','</p>'); ?>
						</div>
						<input type="submit" name="mensajeSubmit" class="btn btn-primary" value="Submit"/>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>