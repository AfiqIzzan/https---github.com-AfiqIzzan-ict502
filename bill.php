<html>
<head>
    <title>Bill</title>
    <style>
        body {
            background-image: url("bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: sans-serif;
        }

        h1 {
            text-align: center;
            color: #414c6b;
        }
        table {
			border-collapse: collapse;
            border: none;
			margin-left: auto;
			margin-right: auto;
			margin: 0px auto;
			border-radius: 4px;
            width: 100%;
		}
        td, th{
            padding: 3px 50px;

            border-top: 1px solid;
        }
      button{
        text-align: center; 
        cursor: pointer;
        padding: 6px 14px;
    }
    </style>
</head>

<body>
    <?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = "SELECT * FROM bill INNER JOIN diagnosis USING (DIAGNOSIS_ID) INNER JOIN medicine USING (MED_ID) JOIN appointments USING (appt_id) JOIN patients USING (patient_id) JOIN doctors USING (doctor_id) JOIN staffs USING (staff_id) WHERE APPT_ID='" . $_GET['appt_id'] . "'";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_array($result);

    ?>
    

    <h1>Medical Bill Receipt</h1>
        <div>
            Bill Id: <?php echo $row['BILL_ID']; ?><br>
            Bill Date:  <?php echo $row['BILL_DATE']; ?><br>
            Appointment Id: <?php echo $row['APPT_ID']; ?><br>
            Doctor Name: <?php echo $row['STAFF_NAME']; ?>
        </div>
        <br><br>
        <div>
            Patient Details
            <br><br>Patient Name: <?php echo $row['PATIENT_NAME']; ?>
            <br>Ic Number: <?php echo $row['PATIENT_IC']; ?>
            <br>Address: <?php echo $row['PATIENT_ADDRESS']; ?>
        </div>
        <br><br>
        <table>
            <tr style="border-top: 3px solid; text-align:left">
            <th>CODE</th>
            <th>DESCRIPTION</th>
            <th>AMOUNT</th>
            <th>TOTAL</th>
            </tr>
            <tr>
            <td>CON</td>
            <td>CONSULTATION</td>
            <td>30.00</td>
            <td>30.00</td>
            </tr>
            <tr>
                <td><?php echo $row['MED_ID']; ?></td>
                <td><?php echo $row['MED_NAME']; ?></td>
                <td><?php echo $row['MED_PRICE']; ?>.00</td>
                <td><?php echo $row['MED_PRICE']; ?>.00</td>
            </tr>
            <tr style="border-top: 2px solid;">
                <td>TOTAL CHARGES:</td>
                <td></td>
                <td></td>
                <td><?php echo $row['BILL_AMOUNT']; ?>.00</td>
            </tr>

        </table>
        <br><br>
        <button><a href="home.php" style="text-decoration: none; color:black;">HOME</a></button>
        <button type="button" value="print" onclick="window.print()">PRINT</button>
</body>
</html>