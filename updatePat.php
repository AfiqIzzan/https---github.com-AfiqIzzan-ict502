<html>
	<head>
	<title>Update Employee Data</title>
	<style>
        body{
            background-image: url("bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: sans-serif;
        }
        form{
            margin: 0px auto;
			margin-top: 6%;
            width: 100%;
            max-width: 447px;
            background: #f7f7f7;
            border-radius: 4px;
            padding: 20px;
            box-shadow: rgba(60, 66, 87, 0.12) 0px 17px 24px 0px, rgba(0, 0, 0, 0.12) 0px 13px 16px 0px;
        }
        h1{
            text-align: center;
            color: #414c6b;
            font-size: 40px;
        }
        select, input{
            width: 98.5%;
            height: 25px;
        }
        select{
            width: 100%;
            height: 30px;
        }
        .button{
            max-width: 30%;
            height: 40px;
            position: relative;
            left: 37%;
            background-color: #24a0ed;
            border: none;
            border-radius: 6px;
            color: #111111;
        }
        .button:hover{
            cursor: pointer;
            background-color: #008CBA ;
            color: whitesmoke;
        }
    </style>
	</head>
	<body>
		<?php
			$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
			$query="SELECT * FROM patients WHERE PATIENT_ID='" . $_GET['PATIENT_ID'] . "'";
			$result=oci_parse($conn,$query);
			oci_execute($result);
			$row=oci_fetch_array($result);
		?>

		<form name="frmUser" method="post" action="">
			<h1>Update Patient Details</h1>
			Id <input style="border: none;" type="number" name="id" readonly value="<?php echo $row['PATIENT_ID'];?>">
			<br><br>
			Name <input style="border: none;" type="text" name="name" readonly value="<?php echo $row['PATIENT_NAME']; ?>">
			<br><br>
			IC Number <input style="border: none;" type="text" name="ic" readonly value="<?php echo $row['PATIENT_IC']; ?>">
			<br><br>
			Address <input type="text" name="address" value="<?php echo $row['PATIENT_ADDRESS']; ?>">
			<br><br>
			
			<input class="button" type="submit" name="submit" value="SAVE">
		</form>
		<?php
			include_once 'connection.php';
			if(count($_POST)>0) 
			{
				$query = oci_parse($conn, "UPDATE patients SET patient_id='" . $_POST['id'] . "', 
				patient_name='" . $_POST['name'] . "', patient_ic='" . $_POST['ic'] . "', 
				patient_address='" . $_POST['address'] . "' WHERE patient_id='" . $_POST['id'] . "'");
				$result = oci_execute($query, OCI_DEFAULT);  
				if($result)  
				{  
					oci_commit($conn); 
		?>
					<html>
						<script>
						window.alert('Data Successfully Updated');
						window.location.href='listPat.php';
						</script>
					</html>;
					<?php
				}
				else{ echo "Error."; }
			}
		?>
	</body>
</html>