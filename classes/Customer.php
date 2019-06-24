<?php
	
	/**
	 * Class Customer
	 */
	class Customer
	{
		/**
		 * @var
		 *  int User id.
		 */
		public $user_id;
		
		/**
		 * @var
		 * string Full name.
		 */
		protected $name;
		
		/**
		 * @var
		 *  string Email address.
		 */
		protected $email;
		
		/**
		 * @var string Address.
		 */
		protected $address;
		
		/**
		 * @var string City or town.
		 */
		protected $place;
		
		/**
		 * @var string Postal code.
		 */
		protected $postal_code;
		
		/**
		 * @var string Phone number.
		 */
		protected $phone;
		
		/**
		 * @var string Memo about customer.
		 */
		protected $memo;
		
		/**
		 * Customer constructor.
		 * @param $name
		 * @param $email
		 * @param $address
		 * @param $place
		 * @param $postal_code
		 * @param $phone
		 * @param null $memo
		 */
		public function __construct($name, $email, $address, $place, $postal_code, $phone, $memo = null)
		{
		    if(is_null($this->user_id)) {
			    $this->user_id = Utility::getNewUserId("klanten", "id");
            }
			$this->name = $name;
			$this->email = $email;
			$this->address = $address;
			$this->place = $place;
			$this->postal_code = $postal_code;
			$this->phone = $phone;
			$this->memo = $memo;
		}
		
		/**
		 *  Registers new customer in database.
		 */
		public function registerCustomer()
		{
			if (!Utility::doesValueExistInColumn($this->email, "klanten", "email")) {
				$conn = Utility::pdoConnect();
				
				$register = $conn->prepare("INSERT INTO klanten (id, naam, email,
							adres, plaats, postcode, telefoon, memo)
							VALUES  (:id, :naam, :email, :adres, :plaats, :postcode, :telefoon, :memo)");
				$register->bindParam("id", $this->user_id);
				$register->bindParam("naam", $this->name);
				$register->bindParam("email", $this->email);
				$register->bindParam("adres", $this->address);
				$register->bindParam("plaats", $this->place);
				$register->bindParam("postcode", $this->postal_code);
				$register->bindParam("telefoon", $this->phone);
				$register->bindParam("memo", $this->memo);
				$register->execute();
				
				header("Location: klanten.php");
			} else {
				echo "<p>Email adres bestaat al.</p>";
			}
		}
		
		/**
		 * Updates customer record.
		 */
		public function updateCustomer()
		{
			if (!Utility::doesValueExistInColumn($this->email, "klanten", "email", 1)) {
				$conn = Utility::pdoConnect();
				
				$update = $conn->prepare("UPDATE klanten SET naam = :naam, email = :email, adres = :adres,
                            plaats = :plaats, postcode = :postcode, telefoon = :telefoon, memo = :memo WHERE id = :id");
				$update->bindParam("id", $this->user_id);
				$update->bindParam("naam", $this->name);
				$update->bindParam("email", $this->email);
				$update->bindParam("adres", $this->address);
				$update->bindParam("plaats", $this->place);
				$update->bindParam("postcode", $this->postal_code);
				$update->bindParam("telefoon", $this->phone);
				$update->bindParam("memo", $this->memo);
				$update->execute();
				
				header("Location: klanten.php");
			} else {
				echo "<p>Email adres bestaat al.</p>";
			}
		}
		
		/**\
		 * @param $user_data
		 *
		 *  Displays users.
		 */
		public static function displayCustomers($user_data)
		{
			?>
            <div class='col-md-12' style="margin-top:1em;">
                <table class='table'>
                    <thead class='thead-light'>
                    <tr>
                        <th scope='col'>naam</th>
                        <th scope='col'>email</th>
                        <th scope='col'>adres</th>
                        <th scope='col'>plaats</th>
                        <th scope='col'>postcode</th>
                        <th scope='col'>telefoon</th>
                        <th scope='col'>memo</th>
                        <th scope='col'>wijzig</th>
                        <th scope='col'>verwijder</th>
                    </tr>
                    <tbody>
					<?php foreach ($user_data as $row) : ?>
                        <tr>
                            <td><?= $row['naam'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['adres'] ?></td>
                            <td><?= $row['plaats'] ?></td>
                            <td><?= $row['postcode'] ?></td>
                            <td><?= $row['telefoon'] ?></td>
                            <td><?= $row['memo'] ?></td>
                            <td>
                                <form method="post" action="klant_wijzigen.php">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="name" value="<?= $row['naam'] ?>">
                                    <input type="hidden" name="email" value="<?= $row['email'] ?>">
                                    <input type="hidden" name="address" value="<?= $row['adres'] ?>">
                                    <input type="hidden" name="place" value="<?= $row['plaats'] ?>">
                                    <input type="hidden" name="postal_code" value="<?= $row['postcode'] ?>">
                                    <input type="hidden" name="phone" value="<?= $row['telefoon'] ?>">
                                    <input type="hidden" name="memo" value="<?= $row['memo'] ?>">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-arrow-circle-right fa-lg"></i> Wijzigen
                                    </button>
                                </form>
                            </td>
                            <td><a href= <?= "?del_id=" . $row['id'] ?>>
                                    Verwijderen
                                </a></td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
			<?php
		}
		
		public static function searchFetch($search)
		{
			$conn = Utility::pdoConnect();
			$user_data = $conn->query("SELECT * FROM klanten WHERE naam LIKE '%$search%'
                                                OR email LIKE '%$search%' OR adres LIKE '%$search%'
                                                OR plaats LIKE '%$search%' OR postcode LIKE '%$search%'
                                                OR telefoon LIKE '%$search%'
                                                OR memo LIKE '%$search%'")->fetchAll(PDO::FETCH_ASSOC);;
			return $user_data;
		}
	}