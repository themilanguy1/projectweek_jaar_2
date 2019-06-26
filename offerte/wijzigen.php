<?php
//	require_once('../classes/Autoloader.php');
//	Session::start();
//?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--	<meta charset="UTF-8">-->
<!--	<link rel="stylesheet" href="../style/main.css">-->
<!--	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
<!--	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">-->
<!--</head>-->
<!--<body>-->
<!--<div class="container">-->
<!--	<div class="row" style="margin-top:0.5em;">-->
<!--		<div class="col-md-6">-->
<!--			<h2>Admin dashboard</h2>-->
<!--		</div>-->
<!--		<div class="col-md-6 text-right">-->
<!--			<!--			-->--><?php
//				//				if (Session::loginStatus()) {
//				//					if (Session::adminStatus()) {
//				//						?><!--<!-- <a href="home.php" class="btn btn-primary">Home</a> -->--><?php
//				//					} else {
//				//						header('Location: Home.php');
//				//						die;
//				//					}
//				//					?><!--<!-- <a href="logout.php" class="btn btn-primary">Log uit</a> -->--><?php
//				//				} else {
//				//					header('Location: Home.php');
//				//					die;
//				//				}
//				//			?>
<!--			<a href="overzicht.php" class="btn btn-primary">Terug</a>-->
<!--		</div>-->
<!--		<div class="col-md-12">-->
<!--			--><?php
//				if(isset($_POST['name'])) {
//					?>
<!--					<form method="post">-->
<!--                        <input name="edit_id" type="hidden" value="--><?//= $_POST['id'] ?><!--">-->
<!--						<div class="form-group">-->
<!--							<label>naam</label>-->
<!--							<input type="text" class="form-control" name="edit_name" value="--><?//= $_POST['name'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>email</label>-->
<!--							<input type="email" class="form-control" name="edit_email" value="--><?//= $_POST['email'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>adres</label>-->
<!--							<input type="text" class="form-control" name="edit_address" value="--><?//= $_POST['address'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>plaats</label>-->
<!--							<input type="text" class="form-control" name="edit_place" value="--><?//= $_POST['place'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>postcode</label>-->
<!--							<input type="text" class="form-control" name="edit_postal_code" size="7"-->
<!--							       maxlength="7" placeholder="3012XH of 3012 XH" value="--><?//= $_POST['postal_code'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>telefoon nr.</label>-->
<!--							<input type="tel" class="form-control" name="edit_phone" value="--><?//= $_POST['phone'] ?><!--" required>-->
<!--						</div>-->
<!--						<div class="form-group">-->
<!--							<label>memo</label>-->
<!--							<textarea rows="3" class="form-control" name="edit_memo" value="--><?//= $_POST['memo'] ?><!--" >-->
<!--                    </textarea>-->
<!--						</div>-->
<!--						<button type="submit" class="btn btn-primary">Wijzigen</button>-->
<!--					</form>-->
<!--					--><?php
//				}
//				if (isset($_POST['edit_name'])) {
//				    $id = $_POST['edit_id'];
//					$name = $_POST['edit_name'];
//					$email = $_POST['edit_email'];
//					$address = $_POST['edit_address'];
//					$place = $_POST['edit_place'];
//					$postal_code = $_POST['edit_postal_code'];
//					$phone = $_POST['edit_phone'];
//					$memo = $_POST['edit_memo'];
//
//					if(Utility::check_postcode($postal_code)) {
//						$customer = new Customer($name, $email, $address, $place, $postal_code, $phone, $memo);
//						$customer->user_id = $id;
//						$customer->updateCustomer();
//					} else {
//						echo "<h1>postcode is verkeerd.</h1>";
//					}
//				}
//			?>
<!--		</div>-->
<!--	</div>-->
<!--</div-->
<!--</body>-->
<!--</html>-->