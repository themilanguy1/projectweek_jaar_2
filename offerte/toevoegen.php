<?php
	require_once('../classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-6">
            <h2>Offerte toevoegen</h2>
        </div>
        <div class="col-md-6 text-right">
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
            <a href="overzicht.php" class="btn btn-primary">Terug</a>
        </div>
        <div class="col-md-12">
            <form method="post">
                <div class="form-group">
                    <label>klant</label>
                    <select class="form-control" name="offer_cust_id" required>
						<?php
							Utility::getDropdownSelect("klanten", "id", "naam");
						?>
                    </select>
                </div>
                <div class="form-group">
                    <label>datum</label>
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="form-group">
                    <label>klus beschrijving</label>
                    <textarea rows="3" class="form-control" name="work_description" required"></textarea>
                </div>
                <div class="form-group">
                    <label>prijs</label>
                    <input type="number" step="any" min=0 class="form-control" name="price" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1">
                    <label class="form-check-label">
                        offerte status
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </form>
			
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$cust_id = $_POST['offer_cust_id'];
					$date = $_POST['date'];
					$work_description = $_POST['work_description'];
					$price = $_POST['price'];
					if (!isset($_POST['status'])) {
						$status = 0;
					} else {
						$status = 1;
					}
					
					$offer = new Offer($cust_id, $date, $work_description, $price, $status);
					$offer->addOffer();
					
					header("Location: overzicht.php");
				}
			?>
        </div>
    </div>
</div
</body>
</html>