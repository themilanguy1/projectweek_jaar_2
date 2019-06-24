<?php
	require_once('classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-6">
            <h2>Admin dashboard</h2>
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
            <a href="klanten.php" class="btn btn-primary">Terug</a>
        </div>
        <div class="col-md-12">
            <form method="post">
                <div class="form-group">
                    <label>naam</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>adres</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                <div class="form-group">
                    <label>plaats</label>
                    <input type="text" class="form-control" name="place" required>
                </div>
                <div class="form-group">
                    <label>postcode</label>
                    <input type="text" class="form-control" name="postal_code"  accept-charset="utf-8" size="7"
                           maxlength="7" placeholder="3012XH of 3012 XH" required>
                </div>
                <div class="form-group">
                    <label>telefoon nr.</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label>memo</label>
                    <textarea rows="3" class="form-control" name="memo">
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </form>
			
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$name = $_POST['name'];
					$email = $_POST['email'];
					$address = $_POST['address'];
					$place = $_POST['place'];
					$postal_code = $_POST['postal_code'];
					$phone = $_POST['phone'];
					$memo = $_POST['memo'];
					
					if(Utility::check_postcode($postal_code)) {
						$customer = new Customer($name, $email, $address, $place, $postal_code, $phone, $memo);
						$customer->registerCustomer();
                    } else {
					    echo "<h1>postcode is verkeerd.</h1>";
                    }
				}
			?>
        </div>
    </div>
</div
</body>
</html>