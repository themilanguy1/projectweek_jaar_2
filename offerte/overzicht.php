<?php
	require_once('../classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container-flex">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-6">
            <h2>Admin dashboard</h2>
        </div>
        <div class="col-md-3 text-right">
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
        <div class="col-md-3 text-right">
            <a href="toevoegen.php" class="btn btn-primary">Offerte toevoegen</a>
            <a href="../home.php" class="btn btn-primary">Home</a>
        </div>
        <div class="col-md-12">
            <h4>Offertes:</h4>
        </div>
		<?php
			if (isset($_GET['offer_del_id'])) {
				$offer_del_id = $_GET['offer_del_id'];
				Utility::deleteRow($offer_del_id, "offertes", "id");
			}

				Offer::displayOffers(Utility::fetchSQL("offertes"));
		?>
    </div>
</div
</body>
</html>