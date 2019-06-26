<?php
	
	/**
	 * Class Invoice
	 */
	class Invoice
	{
		protected $id;
		
		protected $date;
		
		protected $price;
		
		protected $payment_status;
		
		/**
		 * Invoice constructor.
		 * @param $date
		 * @param $price
		 * @param $payment_status
		 */
		public function __construct($date, $price, $payment_status)
		{
			if(is_null($this->id)) {
				$this->id = Utility::getNewId("factuur", "id");
			}
			$this->date = $date;
			$this->price = $price;
			$this->payment_status = $payment_status;
		}
		
		/**
		 *  Adds invoice to sql.
		 */
		public function addInvoice()
		{
			$conn = Utility::pdoConnect();
			
			$insert = $conn->prepare("INSERT into factuur (id, datum, prijs, status_betaald)
                                                VALUES (:id, :date, :price, :payment_status)");
			$insert->bindParam("id", $this->id);
			$insert->bindParam("date", $this->date);
			$insert->bindParam("price", $this->price);
			$insert->bindParam("payment_status", $this->payment_status);
			$insert->execute();
		}
		
		/**
		 * @param $data
		 *  mixed Sql data.
		 *
		 *  Display table of invoices.
		 */
		public static function displayInvoices($data)
		{
			?>
			<div class='col-md-12' style="margin-top:1em;">
				<table class='table'>
					<thead class='thead-light'>
					<tr>
						<th scope='col'>datum</th>
						<th scope='col'>prijs</th>
						<th scope='col'>betalingsstatus</th>
						<th scope='col'>verwijder</th>
					</tr>
					<tbody>
					<?php foreach ($data as $row) : ?>
						<tr>
							<td><?= $row['datum'] ?></td>
							<td>€<?= $row['prijs'] ?></td>
							<td><?= $row['status_betaald'] ?></td>
							<td>
								<?= "<a href=?invoice_del_id=" . $row['id'].">Verwijderen</a>"; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php
		}
	}