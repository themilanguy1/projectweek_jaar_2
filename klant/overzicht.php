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
        <div class="col-md-4">
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
                           placeholder="Zoek klantgegevens" aria-label="Search"
                           <?php
                               if(isset($_GET['search'])) {
                                   echo "value=".$_GET['search'];
                               }
                           ?>
                           required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a href="toevoegen.php" class="btn btn-primary">Klant toevoegen</a>
            <a href="../home.php" class="btn btn-primary">Home</a>
        </div>
        <div class="col-md-12">
            <h4>Klanten:</h4>
        </div>
			<?php
				if (isset($_GET['cust_del_id'])) {
					$cust_del_id = $_GET['cust_del_id'];
					Utility::deleteRow($cust_del_id, "klanten", "klant_id");
				}
				
				if(isset($_GET['search'])) {
				    $search = $_GET['search'];
				    Customer::displayCustomers(Customer::searchFetch($search));
                } else {
					Customer::displayCustomers(Utility::fetchSQL("klanten"));
                }

			?>
    </div>
</div
</body>
</html>