<table>
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Home Address</th>
			<th>Home Phone</th>
			<th>Cellphone</th>
		</tr>
	</thead>

	<?php

		extract($_POST);

		$query = "SELECT first_name, last_name, email, home_address, home_phone, cellphone from userinfo";

		$json_db = file_get_contents('db.json');
		$db = json_decode($json_db, true);

		$db_servername = $db['servername'];
		$db_username = $db['username'];
		$db_password = $db['password'];
		$db_dbname = $db['dbname'];

		$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
		
		if ($conn->connect_error) {
			die("Could not connect database.".$conn->connect_error);
		}

		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			print("<tbody>");

			while($row = $result->fetch_assoc()) {
				print("<tr>");
				foreach($row as $key => $value){
					print("<td>$value</td>");
				}
				print("</tr>");
			}

			print("</tbody>");
		}

		$conn->close();
	?>
</table>