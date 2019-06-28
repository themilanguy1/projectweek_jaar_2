<?php
	
	/**
	 * Class Offer
	 */
	class Offer
	{
		protected $id;
		
		protected $customer_id;
		
		protected $date;
		
		protected $work_description;
		
		protected $price;
		
		protected $status;
		
		/**
		 * Offer constructor.
		 * @param $customer_id
		 * @param $date
		 * @param $work_description
		 * @param $price
		 * @param $status
		 */
		public function __construct($customer_id, $date, $work_description, $price, $status)
		{
		    if(is_null($this->id)) {
			    $this->id = Utility::getNewId("offertes", "offerte_id");
            }
			$this->customer_id = $customer_id;
			$this->date = $date;
			$this->work_description = $work_description;
			$this->price = $price;
			$this->status = $status;
		}
		
		/**
		 *  Adds offer to sql.
		 */
		public function addOffer()
        {
            $conn = Utility::pdoConnect();
            
            $insert = $conn->prepare("INSERT into offertes (offerte_id, offerte_klant_id, datum, klus_beschrijving, prijs, status)
                                                VALUES (:id, :customer_id, :date, :work_description, :price, :status)");
            $insert->bindParam("id", $this->id);
            $insert->bindParam("customer_id", $this->customer_id);
            $insert->bindParam("date", $this->date);
            $insert->bindParam("work_description", $this->work_description);
            $insert->bindParam("price", $this->price);
            $insert->bindParam("status", $this->status);
            $insert->execute();
        }
		
		/**
		 * @param $data
         *  mixed Sql data.
         *
         *  Display table of offers.
		 */
		public static function displayOffers($data)
		{
			?>
            <div class='col-md-12' style="margin-top:1em;">
                <table class='table'>
                    <thead class='thead-light'>
                    <tr>
                        <th scope='col'>klant_id</th>
                        <th scope='col'>datum</th>
                        <th scope='col' style="width: 50%;">klus beschrijving</th>
                        <th scope='col'>prijs</th>
                        <th scope='col'>status</th>
                        <th scope='col'>verwijder</th>
                    </tr>
                    <tbody>
					<?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?= $row['klant_id'] ?></td>
                            <td><?= $row['datum'] ?></td>
                            <td><?= $row['klus_beschrijving'] ?></td>
                            <td>€<?= $row['prijs'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <?php
                                    if($row['status'] == 0) {
	                                    echo "<a href=?offer_del_id=" . $row['id'].">Verwijderen</a>";
                                    } else {
	                                    echo "status akkoord, niet verwijderen";
                                    }
                                ?>
                            </td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
			<?php
		}
	}