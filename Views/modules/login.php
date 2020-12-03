<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Team Sachica</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Views/css/styles.css">
</head>
<body>
    <h3>Inicio de Sesión</h3>
    <form id="login" method="post">
        <div class="form-group">
    <label>Usuario</label>
    <input type="text" class="form-control" name="usuarioValidacion" required>
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input type="password" class="form-control" name="passwordValidacion" required>
    </div>
	<button type="submit" class="btn btn-success">Iniciar Sesión</button>
  </form>
	
	

	<section>
		<?php 
		
			$validLogin = new MvcController();
			$validLogin -> validarLoginController();
		?>
		
	</section>

</body>
</html>
