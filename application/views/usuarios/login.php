<br>
<br>
<?php echo form_open('usuarios/login'); ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h1 class="text-center"><?php echo $title; ?></h1>
      <div class="form-group">
       <input type="text" name="usuario" class="form-control" placeholder="Ingrese usuario" required autofocus>
      </div>
      <div class="form-group">
       <input type="password" name="password" class="form-control" placeholder="Ingrese password" required autofocus>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
   </div>
<?php echo form_close(); ?>