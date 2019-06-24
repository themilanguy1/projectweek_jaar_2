<?php
	require_once('classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container-flex">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-10">
            <h2>Admin dashboard</h2>
        </div>
        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrator
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="home.php" class="dropdown-item">Home</a>
                    <a href="logout.php" class="dropdown-item">Log uit</a>
                </div>
            </div>
            <!--			--><?php
				//				if (Session::loginStatus()) {
				//					if (Session::adminStatus()) {
				//						?><!-- <a href="home.php" class="btn btn-primary">Home</a> --><?php
				//					} else {
				//						header('Location: Home.php');
				//						die;
				//					}
				//					?><!-- <a href="logout.php" class="btn btn-primary">Log uit</a> --><?php
				//				} else {
				//					header('Location: Home.php');
				//					die;
				//				}
				//			?>
        </div>
        <div class="col-md-2">
            <div class="col-md-12">
                <a href="klanten.php"><h4>Klanten</h4></a>
            </div>
            <div class="col-md-12">
                <a href="#"><h4>Offertes</h4></a>
            </div>
            <div class="col-md-12">
                <a href="#"><h4>Facturen</h4></a>
            </div>
        </div>
    </div>
</div
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</html>