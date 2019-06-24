<?php
	
	/**
	 * Class Order
	 */
	class Order
	{
		/**
		 * @param $data
		 * @return bool
		 *
		 *  Displays invoice.
		 */
		public static function displayInvoice($data)
		{
			if (!is_null($data)) {
				?>
                <table class='table'>
                    <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>Product</th>
                        <th scope='col'>Prijs</th>
                        <th scope='col'>Aantal</th>
                        <th scope='col'>Totaal</th>
                    </tr>
                    <tbody>
					<?php
						$sub_total = 0;
						foreach ($_SESSION['shopping_cart_inventory'] as $item) {
							$sub_total = number_format(($sub_total + ($item['product_price'] * $item['product_quantity'])), 2);
							$price_per_product = number_format($val = ($item['product_price'] * $item['product_quantity']), 2);
							echo "<tr>";
							if (is_array($item) || is_object($item)) {
								echo "<td>" . $item['product_name'] . "</td>";
								echo "<td>" . $item['product_price'] . "</td>";
								echo "<td>" . $item['product_quantity'] . "</td>";
								echo "<td> € " . $price_per_product . "</td>";
								
								?>
								<?php
							}
							echo "</tr>";
						}
						
						if (isset($_GET['coupon_code']) && $_GET['coupon_code'] == "korting") {
						    $delivery_costs = number_format(0, 2);
						    $discount = true;
						} else {
							$delivery_costs = number_format(2.75, 2);
							$discount = false;
						}
						$btw = number_format((($sub_total + $delivery_costs) * 0.21), 2);
						$total = number_format(($btw + $sub_total), 2);
					?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>Subtotaal: </b></td>
                        <td><b>€ <?= $sub_total ?> </b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>Verzendkosten: </b></td>
                        <?php
                            if ($discount) {
                                echo "<td><b>€ <strike>" . $delivery_costs . "</b></strike></td>";
                            } else {
	                            echo "<td><b>€ " . $delivery_costs . "</b></td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td><b></b></td>
                        <td></td>
                        <td><b>21% BTW</b></td>
                        <td><b>€ <?= $btw ?> </b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>Totaal incl. BTW</b></td>
                        <td><b>€ <?= $total ?> </b></td>
                    </tr>
                    </tbody>
                </table>
				<?php
				return true;
			} else {
				echo "Winkelmand leeg.";
				return false;
			}
		}
	}