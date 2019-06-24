<?php
	
	/**
	 * Class User
	 */
	class User
	{
		/**
		 * @var
		 * string Username.
		 */
		protected $user_name;
		
		/**
		 * @var
		 *  string Password.
		 */
		protected $pass;
		
		/**
		 * @var
		 *  string Email address.
		 */
		protected $email;
		
		/**
		 * User constructor.
		 * @param $user_name
		 * @param $pass
		 * @param $email
		 */
		public function __construct($user_name, $pass, $email = null)
		{
			$this->user_name = $user_name;
			$this->pass = $pass;
			$this->email = $email;
		}
		
		/**
		 * @return bool
		 *
		 *  Checks input data at login screen against user table,
		 *  sets session username variable and/or admin status variable.
		 */
		public function login()
		{
			
			if (!empty($this->user_name) && !empty($this->pass)) {
				$conn = Utility::pdoConnect();
				
				$login = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=:user_name");
				$login->bindParam(':user_name', $this->user_name);
				$login->execute();
				
				if ($login->rowCount() == 1) {
					$user_data = $login->fetch(PDO::FETCH_ASSOC);
					$hashed_pass = $user_data['gebruiker_wachtwoord'];
					$admin_status = $user_data['gebruiker_admin_status'];
					
					if (Utility::verifyEncryptedPassword($this->pass, $hashed_pass)) {
						// Password verified, user has been logged in.
						$_SESSION['login_status'] = true;
						$_SESSION['login_user'] = $user_data['gebuiker_gebruikersnaam'];
						
						if ($admin_status == 1) {
							// Admin status verified, user has been logged in as admin.
							$_SESSION['login_admin_status'] = true;
							
						} else {
							$_SESSION['login_admin_status'] = false;
						}
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}
		
		/**
		 *  Registers new user in database.
		 */
		public function register()
		{
			if (!User::doesEmailExist($this->email)) {
				if (!User::doesUserNameExist($this->user_name)) {
					$conn = Utility::pdoConnect();
					$new_id = Utility::getNewUserId();
					$hashed_pass = Utility::encryptPassword($this->pass);
					$register_admin_status = 0;
					
					$register = $conn->prepare("INSERT INTO gebruikers (gebruiker_id, gebruiker_email,
							gebruiker_gebruikersnaam, gebruiker_wachtwoord, gebruiker_admin_status)
							VALUES  (?, ?, ?, ?, ?)");
					$register->bindParam(1, $new_id);
					$register->bindParam(2, $this->email);
					$register->bindParam(3, $this->user_name);
					$register->bindParam(4, $hashed_pass);
					$register->bindParam(5, $register_admin_status);
					$register->execute();
					
					header("Location: home.php");
				} else {
					echo "<p>Gebruikersnaam bestaat al.</p>";
				}
			} else {
				echo "<p>Email adres bestaat al.</p>";
			}
		}
		
		/**
		 * @param $user_name
		 *  string User name.
		 * @return bool
		 *
		 *  Returns true if user name & email address exist, false if not.
		 */
		public static function doesUserNameExist($user_name)
		{
			$conn = Utility::pdoConnect();
			
			$check_user_name_query = $conn->prepare("SELECT gebruiker_gebruikersnaam FROM gebruikers
																   WHERE gebruiker_gebruikersnaam = :user_name");
			$check_user_name_query->bindParam("user_name", $user_name);
			$check_user_name_query->execute();
			
			if ($check_user_name_query->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * @param $email
		 *  string Email.
		 * @return bool
		 *
		 *  Returns true if email exists, false if not.
		 */
		public static function doesEmailExist($email)
		{
			$conn = Utility::pdoConnect();
			
			$check_user_name_query = $conn->prepare("SELECT gebruiker_gebruikersnaam FROM gebruikers
																   WHERE gebruiker_email = :email");
			$check_user_name_query->bindParam("email", $email);
			$check_user_name_query->execute();
			
			if ($check_user_name_query->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * @return array
		 *
		 *  Fetches user data.
		 */
		public static function fetchUsers()
		{
			$conn = Utility::pdoConnect();
			$user_data = $conn->query("SELECT * FROM gebruikers ")->fetchAll(PDO::FETCH_ASSOC);;
			return $user_data;
		}
		
		/**\
		 * @param $user_data
		 *
		 *  Displays users.
		 */
		public static function displayUsers($user_data)
		{
			?>
            <div class="container">
                <div class='col-md-12'>
                    <table class='table'>
                        <thead class='thead-light'>
                        <tr>
                            <th scope='col'>Gebruikers id</th>
                            <th scope='col'>Gebruikers naam</th>
                            <th scope='col'>Gebruikers email</th>
                            <th scope='col'>Gebruikers wachtwoord</th>
                            <th scope='col'>Gebruikers admin_status</th>
                            <th scope='col'>wijzig</th>
                            <th scope='col'>verwijder</th>
                        </tr>
                        <tbody>
						<?php foreach ($user_data as $row) : ?>
                            <tr>
                                <th scope='row'><?= $row['gebruiker_id'] ?></th>
                                <td><?= $row['gebruiker_gebruikersnaam'] ?></td>
                                <td><?= $row['gebruiker_email'] ?></td>
                                <td><?= $row['gebruiker_wachtwoord'] ?></td>
                                <td><?= $row['gebruiker_admin_status'] ?></td>
                                <td><a href="<?= $row['gebruiker_id'] ?>">
                                        Wijzig
                                    </a></td>
                                <td><a href="<?= $row['gebruiker_id'] ?>">
                                        Verwijderen
                                    </a></td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
			<?php
		}
	}