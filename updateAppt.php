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
			margin-top: 2%;
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
			$query="SELECT * FROM appointments WHERE APPT_ID='" . $_GET['APPT_ID'] . "'";
			$result=oci_parse($conn,$query);
			oci_execute($result);
			$row=oci_fetch_array($result);
		?>

		<form name="frmUser" method="post" action="">
            <h1>Update Appointment</h1>
			Appointment Id <input style="border: none;" type="number" name="apptid" readonly value="<?php echo $row['APPT_ID'];?>">
			<br><br>
			Doctor Id <input type="text" style="border: none;" name="docid" readonly value="<?php echo $row['DOCTOR_ID']; ?>">
			<br><br>
			Patient Id <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['PATIENT_ID']; ?>">
			<br><br>
			Appointment Date <input type="text" name="date" value="<?php echo $row['APPT_DATE']; ?>">
			<br><br>
			Appointment Time <input type="text" name="time" value="<?php echo $row['APPT_TIME']; ?>">
			<br><br>
			Assistant 
            <select name='asstid'>  
            <option ><?php echo $row['ASSISTANT_ID']; ?></option>  
            <?php  
                $conn = oci_connect('demo', 'system', 'localhost:1521/xe');  
                $stid = oci_parse($conn, 'select * from STAFFS INNER JOIN ASSISTANTS ON ASSISTANTS.ASSISTANT_ID = STAFFS.STAFF_ID order by ASSISTANT_ID asc');
                $row = oci_execute($stid);
                $i=0;
                while($row=oci_fetch_assoc($stid)) 
                { 
            ?>
                    <option value="<?php echo $row["ASSISTANT_ID"]; ?>"><?php echo $row["ASSISTANT_ID"]; ?> &nbsp;<?php echo $row["STAFF_NAME"]; ?></option>  
            <?php 
                    if (isset ($select)&&$select!="")
                    { $select=$_POST['asstid']; } 
                    $i++; 
                }  
            ?>
            </select><br><br>
            
			
			<input class="button" type="submit" name="submit" value="SAVE">
		</form>
		<?php
			include_once 'connection.php';
			if(count($_POST)>0) 
			{
				$query = oci_parse($conn, "UPDATE appointments SET appt_id='" . $_POST['apptid'] . "', 
				appt_date='" . $_POST['date'] . "', appt_time='" . $_POST['time'] . "', 
				patient_id='" . $_POST['id'] . "', assistant_id='" . $_POST['asstid'] . "', doctor_id='" . $_POST['docid'] . "' 
                WHERE appt_id='" . $_POST['apptid'] . "'");
				$result = oci_execute($query, OCI_DEFAULT);  
				if($result)  
				{  
					oci_commit($conn); 
		?>
					<html>
						<script>
						window.alert('Data Successfully Updated');
						window.location.href='listAppt.php';
						</script>
					</html>;
					<?php
				}
				else{ echo "Error."; }
			}
		?>
	</body>
</html>