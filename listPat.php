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

		.topnav {
			overflow: hidden;
			background-color: transparent;
			margin-left: 22%;
		}

		.topnav a {
			float: left;
			color: #f2f2f2;
			text-align: center;
			padding: 12px 16px;
			text-decoration: none;
			font-size: 17px;
			color: #111111;
		}

		.topnav a:hover {
			background-color: #ddd;
			color: black;
		}

		.topnav a.active {
			background-color: #04AA6D;
			color: white;
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
	<div class="topnav">
		<a href="home.php">Home</a>
		<a href="addPat.php">Register Patient</a>
		<a class="active" href="listPat.php">List Of Patient</a>
		<a href="addAppt.php">Create Appointment</a>
		<a href="listAppt.php">List Of Appointment</a>
	</div>
	<h1>List Of Patient</h1>
	<table id="myTable" border="1">
		<tr>
			<th>PATIENT ID</th>
			<th>PATIENT NAME</th>
			<th>PATIENT IC</th>
			<th>PATIENT CONTACT</th>
			<th>PATIENT ADDRESS</th>
			<th colspan="2">ACTION</th>
		</tr>

		<?php
		$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
		$query = 'select * from PATIENTS order by PATIENT_ID asc';
		$stid = oci_parse($conn, $query);
		$row = oci_execute($stid);
		$i = 0;
		while ($row = oci_fetch_array($stid)) {
		?>
			<tr class="item">
				<td><?php echo $row["PATIENT_ID"]; ?></td>
				<td><?php echo $row["PATIENT_NAME"]; ?></td>
				<td><?php echo $row["PATIENT_IC"]; ?></td>
				<td><?php echo $row["PATIENT_CONTACT"]; ?></td>
				<td><?php echo $row["PATIENT_ADDRESS"]; ?></td>
				<td><a class="but" href="updatePat.php?PATIENT_ID=<?= $row["PATIENT_ID"]; ?>">Update</a></td>
				<td><a class="but" href="deletePat.php?PATIENT_ID=<?= $row["PATIENT_ID"]; ?>">Delete</a></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</table><br><br>

	<a class="fil" href="searchPat.php" action="">Filter Patient by IC Number</a>
</body>

</html>