<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Team Sachica</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Views/css/styles.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<img>
	<?php
	    include "modules/navegacion.php";
        include "Views/modules/login.php";
	?>
	

	<section>
        <?php
            $mvc = new MvcController();
            $mvc -> enlacesPaginasController();
        ?>
	</section>

</body>
</html>