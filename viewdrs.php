<!DOCTYPE html>
<html>

<head>
	<title>List Of Patient</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-image: url("bg2.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			color: #555555;
			text-align: center;
			font-family: sans-serif;
			margin: 0;
		}

		h1 {
			text-align: center;
			color: #414c6b;
			font-size: 40px;
		}

		table {
			border-collapse: collapse;
			border: none;
			margin-left: auto;
			margin-right: auto;
			margin: 0px auto;
			background: #f7f7f7;
			border-radius: 4px;
			padding: 20px;
			box-shadow: rgba(60, 66, 87, 0.12) 0px 17px 24px 0px, rgba(0, 0, 0, 0.12) 0px 13px 16px 0px;
		}

		.but {
			background-color: #CED6E0;
			padding: 4px 8px;
			color: #555555;
		}

		.but:hover {
			cursor: pointer;
			color: #111111;
		}

		button {
			background-color: #CED6E0;
			border: none;
			padding: 14px 16px;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
			color: #555555;
			border-radius: 4px;
		}

		a {
			color: #555555;
			text-decoration: none;
			cursor: pointer;
		}

		button:hover,
		a:hover {
			color: black;
		}

		.fil:hover,
		button:hover,
		.but:hover {
			cursor: pointer;
			color: #111111;
		}

		.fil,
		button {
			background-color: #CED6E0;
			border: none;
			padding: 14px 16px;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
			color: #555555;
			border-radius: 4px;
		}

		th,
		td {
			padding: 7px;
		}
	</style>
</head>
<script src="https://www.w3schools.com/lib/w3.js"></script>

<body>
	<h1>List Of Doctors</h1>
	<table id="myTable" border="1">
		<tr>
			<th>DOCTOR ID</th>
			<th>STAFF NAME</th>
			<th>STAFF CONTACT</th>
			<th>STAFF ADDRESS</th>
			<th>YEARS OF SERVICE</th>
            <th>SPECIALIZATION</th>
		</tr>

		<?php
		$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
		$query = 'select * from doctors INNER JOIN staffs USING (staff_id) ORDER BY doctor_id asc';
		$stid = oci_parse($conn, $query);
		$row = oci_execute($stid);
		$i = 0;
		while ($row = oci_fetch_array($stid)) {
		?>
			<tr class="item">
				<td><?php echo $row["DOCTOR_ID"]; ?></td>
				<td><?php echo $row["STAFF_NAME"]; ?></td>
				<td><?php echo $row["STAFF_CONTACT"]; ?></td>
				<td><?php echo $row["STAFF_ADDRESS"]; ?></td>
				<td><?php echo $row["DOCTOR_YEAROFSERVICE"]; ?></td>
                <td><?php echo $row["DOCTOR_SPECIALIZATION"]; ?></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</table><br><br>
    <br><br><a class="fil" href="home.php" action="">Back</a>
</body>

</html>