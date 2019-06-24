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
				$conn = new PDO("mysql:host=$servername;dbname=sqlprojectweek2", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
				$conn = null;
			}
			return $conn;
		}
		
		/**
		 * @param $table
		 *  string Name of table.
		 * @param $id_column
		 *  string Name of id column.
		 * @return int|mixed
		 *
		 *  Gets new user ID from database table gebruikers.
		 */
		public static function getNewUserId($table, $id_column)
		{
			$conn = self::pdoConnect();
			$users = $conn->query("SELECT COUNT($id_column) FROM $table")->fetchColumn();
			
			if ($users >= 1) {
				$new_id = $conn->query("SELECT MAX($id_column) + 1 FROM $table")->fetchColumn();
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
		
		/**
		 * @param $table
		 *  string Table name.
		 * @return array
		 *
		 *  Fetches user data.
		 */
		public static function fetch($table)
		{
			$conn = Utility::pdoConnect();
			$user_data = $conn->query("SELECT * FROM $table ")->fetchAll(PDO::FETCH_ASSOC);;
			return $user_data;
		}
		
		/**
		 * @param $id
		 *  mixed Delete id.
		 * @param $table
		 *  string Table name.
		 * @param $id_column
		 *  string Id column name.
		 *
		 *  Deletes row according to parameters.
		 */
		public static function deleteRow($id, $table, $id_column)
		{
			if (!empty($id)) {
				$conn = Utility::pdoConnect();
				
				$del = $conn->prepare("DELETE FROM $table WHERE $id_column = ?;");
				$del->bindParam(1, $id);
				$del->execute();
			} else {
				http_response_code(405);
			}
		}
		
		/**
		 * @param $search
		 *  string Search parameter.
		 * @param $search_column
		 *  string Name of column to search.
		 * @return null
		 *
		 *  Returns SQL code to filter by search.
		 */
		public static function setSearchFilter($search, $search_column)
		{
			if (!empty($search)) {
				// Create category filter.
				$search_filter = "AND $search_column LIKE '%" . str_replace('&20', ' ', $search) . "%'";
				return $search_filter;
			} else {
				return null;
			}
		}
		
		/**
		 * @param $postcode
		 *  string Postal code.
		 * @return bool
		 *
		 *  Checks Dutch postal code.
		 */
		public static function check_postcode($postcode)
		{
			$pattern = '{
                    \A                              # start
                    [1-9][0-9]{3}                   # vier cijfers waarvan de eerste niet een 0 is
                    (                               # twee opties
                        [A-RT-Z] [A-Z]              # elke twee letters waarvan de eerste geen S is
                        |                           # of
                        [S] [BCE-RT-Z]              # een S gevolgd door een letter maar geen A,D, of S
                    )
                    \z                              # eind
                }x';                                # comment modus
			
			if ( preg_match($pattern,$postcode) )           // formaat juist
				if ($postcode <= '9999XL')                  // hoogst mogelijke postcode
					return true;
			
			return false;
		}
		
		/**
		 * @param $value
		 *  mixed Value to check for.
		 * @param $table
		 *  string Name of table.
		 * @param $column
		 *  string Name of column.
		 * @param $desired_max_count
		 *  int Desired max count. Example: 1 means 1 match in table will return true, 2 matches will return false.
		 * @return bool
		 *
		 *  Searches table.column for specified value. returns true if found, false if not.
		 */
		public static function doesValueExistInColumn($value, $table, $column, $desired_max_count = null)
		{
			$conn = Utility::pdoConnect();
			
			$check_user_name_query = $conn->prepare("SELECT $column FROM $table
																   WHERE $column = ?");
			$check_user_name_query->bindParam("1", $value);
			$check_user_name_query->execute();
			
			if ($check_user_name_query->rowCount() > $desired_max_count) {
				return true;
			} else {
				return false;
			}
		}
	}