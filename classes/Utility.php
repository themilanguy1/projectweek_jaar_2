<?php
	
	class Utility
	{
		/**
		 * @param string $servername
		 * @param string $username
		 * @param null $password
		 * @return PDO
		 *
		 *  Connects Server to database using PDO.
		 */
		public static function pdoConnect($servername = "localhost", $username = "root", $password = NULL)
		{
			try {
				$conn = new PDO("mysql:host=$servername;dbname=aldidlheijn", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
				$conn = null;
			}
			return $conn;
		}
		
		/**
		 * Creates clickable buttons to filter items per category in DB.
		 */
		public static function showCategoryButtons()
		{
			$conn = self::pdoConnect();
			$categories = $conn->query("SELECT categorie_naam, COUNT(product_naam) as aantal_producten FROM categorie, producten WHERE categorie.categorie_id = producten.categorie_id GROUP BY categorie_naam")->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($categories as $row) {
				echo "<a href='?category=" . $row['categorie_naam'] . "'><button class='btn btn-success'>" . $row['categorie_naam'] . " <span class='badge badge-light'>" . $row['aantal_producten'] . "</span></button></a> ";
			}
			$product_total = Utility::getProductTotal();
			echo "<a href='?category='><button class='btn btn-success'>Alles <span class='badge badge-light'>" . $product_total . "</span></button></a> ";
		}
		
		public static function getProductTotal()
		{
			$conn = self::pdoConnect();
			$product_total = $conn->query("SELECT COUNT(product_naam) FROM producten")->fetchColumn();
			return $product_total;
		}
		
		/**
		 * @return mixed
		 *
		 *  Gets new user ID from database table gebruikers.
		 */
		public static function getNewUserId()
		{
			$conn = self::pdoConnect();
			$users = $conn->query("SELECT COUNT(gebruiker_id) FROM gebruikers")->fetchColumn();
			
			if ($users >= 1) {
				$new_id = $conn->query("SELECT MAX(gebruiker_id) + 1 FROM gebruikers")->fetchColumn();
			} else {
				// No users in table yet.
				$new_id = 1;
			}
			return $new_id;
		}
		
		/**
		 * @param $pass
		 * @return mixed
		 *
		 * Encrypts passwords.
		 */
		public static function encryptPassword($pass)
		{
			$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
			return $hashed_pass;
		}
		
		/**
		 * @param $pass
		 * @param $hashed_pass
		 * @return bool
		 *
		 * Verifies encrypted passwords.
		 */
		public static function verifyEncryptedPassword($pass, $hashed_pass)
		{
			if (password_verify($pass, $hashed_pass)) {
				return true;
			} else {
				return false;
			}
		}
	}