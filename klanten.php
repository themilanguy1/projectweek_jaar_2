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
        <div class="col-md-4 text-right">
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
            <form method="GET">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input name="search" class="form-control my-0 py-1 amber-border" type="text"
                           placeholder="Zoek klantgegevens" aria-label="Search" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2 text-right">
            <a href="klant_toevoegen.php" class="btn btn-primary">Klant toevoegen</a>
        </div>
        <div class="col-md-12">
            <h4>Klanten:</h4>
			<?php
				if (isset($_GET['del_id'])) {
					$del_id = $_GET['del_id'];
					Utility::deleteRow($del_id, "klanten", "id");
				}
				
				if(isset($_GET['search'])) {
				    $search = $_GET['search'];
				    Customer::displayCustomers(Customer::searchFetch($search));
                } else {
					Customer::displayCustomers(Utility::fetch("klanten"));
                }

			?>
        </div>
    </div>
</div
</body>
</html>