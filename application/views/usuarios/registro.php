<?php echo validation_errors(); ?>

<?php echo form_open('usuarios/registro'); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="text-center"><?= $title; ?></h1>
        <div class="form-group">
            <label>Nombre</label>
            <select name="id_persona_fisica" class="form-control" required autofocus>
                 <option selected disabled hidden style='display: none' value='' ></option>
                <?php foreach ($personas_fisicas as $personas): ?>
                    <option value="<?php echo $personas['id_persona_fisica'] ?>"><?php echo $personas['nombre'].' '.$personas['apellido_paterno'].' '.$personas['apellido_materno']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required autofocus>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
        </div>
        <div class="form-group">
            <?php echo form_error('password'); ?>
            <label>Confirmar password:</label>
            <input type="password" class="form-control" name="password2" placeholder="Confirmar password" required autofocus>
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" unchecked name="es_admin" value="1" class="form-check-input">
                    Es Administrador?
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-info btn-block">Enviar</button>
    </div>
</div>
<?php echo form_close(); ?> 
