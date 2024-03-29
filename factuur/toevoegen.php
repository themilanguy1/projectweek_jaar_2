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
            <h2>Factuur toevoegen</h2>
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
                    <label>offerte</label>
                    <select class="form-control" name="invoice_offer_id" required>
			            <?php
				            $conn = Utility::pdoConnect();
				            $sql = $conn->query("SELECT DISTINCT * FROM klanten, offertes WHERE offertes.offerte_klant_id = klanten.klant_id")->fetchAll();
				            $data = $sql;
				            
				            foreach ($data as $row) {
				                echo "<option value =".$row['offerte_id'].">".$row['naam']."</option>";
                            }
			            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>datum</label>
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="form-group">
                    <label>prijs</label>
                    <input type="number" step="any" min=0 class="form-control" name="price" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1">
                    <label class="form-check-label">betaald</label>
                </div>
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </form>
			
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				    $invoice_offer_id = $_POST['invoice_offer_id'];
					$date = $_POST['date'];
					$price = $_POST['price'];
					if (!isset($_POST['status'])) {
						$status = 0;
					} else {
						$status = 1;
					}
					
					$invoice = new Invoice($invoice_offer_id, $date, $price, $status);
					$invoice->addInvoice();
					
					var_dump($_POST);
//					header("Location: overzicht.php");
				}
			?>
        </div>
    </div>
</div
</body>
</html>