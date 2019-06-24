<?php
	
	/**
	 * Class Products
	 */
	class Products
	{
		/**
		 * @param null $category
		 *  string Category for filter.
		 * @param null $search
		 *  string Search parameter.
		 * @return array
		 *
		 * Fetches products from database according to category/search filter, displays products.
		 */
		public static function fetchProducts($category = null, $search = null)
		{
			$conn = Utility::pdoConnect();
			$category_filter = Products::getCategoryFilter($category);
			$search_filter = Products::getSearchFilter($search);
			$data = $conn->query("SELECT * FROM producten, categorie WHERE producten.categorie_id = categorie.categorie_id $category_filter $search_filter")->fetchAll(PDO::FETCH_ASSOC);;
			return $data;
		}
		
		public static function displayProducts($data)
		{
			foreach ($data as $row) {
				?>
                <div class='col-md-4' xmlns="http://www.w3.org/1999/html">
                    <div class="card mx-auto"
                         style="min-height: 15em; max-height: 22em; min-width: 14em; margin-top: 0.5em;">
                        <img class="card-img-top align-self-center" alt="<?php $row['product_naam'] ?>"
                             src=" <?php echo $row['product_afbeelding'] ?> "
                             style="width:60px;height:60px; margin: 1em;">
                        <div class="card-body">
                            <h5 class="card-title" style="max-height: 2em;"> <?php echo $row['product_naam'] ?> </h5>
                            <div style="min-height: 3em;">
								<?php echo "<p>Categorie: <a href='?category=" . $row['categorie_naam'] . "'>" . $row['categorie_naam'] . "</a></p>" ?>
                            </div>
                            <p class="card-text">€ <?php echo $row['product_prijs'] ?> </p>
                            <form method="GET">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="hidden" name="add_product_id"
                                               value=<?php echo $row['product_id'] ?>>
                                        <input type="hidden" name="add_product_name"
                                               value="<?php echo $row['product_naam'] ?>">
                                        <input type="hidden" name="add_product_price"
                                               value="<?php echo $row['product_prijs'] ?>">
                                        <input class="form-control" type="number" min="1"
                                               name="add_product_quantity" value="1" required>
                                    </div>
                                    <div class="form-group col-md-8 text-right">
                                        <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		
		/**
		 * @param $category
		 *  string Category by which to create filter.
		 * @return string
		 *
		 *  Returns SQL code to filter by category.
		 */
		public static function getCategoryFilter($category)
		{
			if (!empty($category)) {
				// Create category filter.
				$category_filter = "AND categorie_naam = '" . str_replace('&20', ' ', $category) . "'";
				return $category_filter;
			} else {
				return null;
			}
		}
		
		/**
		 * @param $search
		 *  string Search parameter.
		 * @return null
		 *
		 *  Returns SQL code to filter by search.
		 */
		public static function getSearchFilter($search)
		{
			if (!empty($search)) {
				// Create category filter.
				$search_filter = "AND product_naam LIKE '%" . str_replace('&20', ' ', $search) . "%'";
				return $search_filter;
			} else {
				return null;
			}
		}
	}