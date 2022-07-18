<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
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

        form {
            margin: 0px auto;
            width: 100%;
            max-width: 447px;
            background: #f7f7f7;
            border-radius: 4px;
            padding: 20px;
            box-shadow: rgba(60, 66, 87, 0.12) 0px 17px 24px 0px, rgba(0, 0, 0, 0.12) 0px 13px 16px 0px;
        }

        h1 {
            text-align: center;
            color: #414c6b;
            font-size: 40px;
        }

        input {
            width: 100%;
            height: 30px;
            border-radius: 4px;
            outline: none;

            box-sizing: border-box;
            border: 1px solid #c0c0c2;
            outline: none;
        }

        .cbox {
            height: 17px;
            width: auto;
            text-align: center;
        }

        .button {
            max-width: 30%;
            height: 40px;
            position: relative;
            left: 37%;
            background-color: #24a0ed;
            border: none;
            border-radius: 6px;
            color: #111111;
        }

        .button:hover {
            cursor: pointer;
            background-color: #008CBA;
            color: whitesmoke;
        }
    </style>
    <title>Update Employee Data</title>
</head>

<body>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="addPat.php">Register Patient</a>
        <a href="listPat.php">List Of Patient</a>
        <a href="addAppt.php">Create Appointment</a>
        <a href="listAppt.php">List Of Appointment</a>
    </div>
    <?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = "SELECT * FROM appointments WHERE APPT_ID='" . $_GET['APPT_ID'] . "'";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_array($result);
    ?>
    <h1>Add Diagnosis and Prescription</h1>
    <form name="frmUser" method="post" action="">
        Appointment Id <input style="border: none;" type="number" name="apptid" readonly value="<?php echo $row['APPT_ID']; ?>">
        <br><br>
        Appointment Date <input style="border: none;" type="text" name="date" readonly value="<?php echo $row['APPT_DATE']; ?>">
        <br><br>
        Appointment Time <input style="border: none;" type="text" name="time" readonly value="<?php echo $row['APPT_TIME']; ?>">
        <br><br>
        Patient Id: <input style="border: none;" type="text" name="id" readonly value="<?php echo $row['PATIENT_ID']; ?>">
        <br><br>
        Doctor Id <input style="border: none;" type="text" name="docid" readonly value="<?php echo $row['DOCTOR_ID']; ?>">
        <br><br>
        Diagnosis Details <input type="text" name="details">
        <br><br>
        Prescription Remarks<input type="text" name="pres">
        <br><br>
        Medicine<br>
        <?php
        $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
        $stid = oci_parse($conn, 'select * from MEDICINE');
        $row = oci_execute($stid);
        $i = 0;
        while ($row = oci_fetch_assoc($stid)) {
        ?>
            <input class="cbox" type="checkbox" name="medc[]" value="<?php echo $row["MED_ID"]; ?>"><?php echo $row["MED_NAME"]; ?><br>
        <?php
            $i++;
        }
        ?>
        <br><br>
        <input type="submit" name="submit" value="Generate bill">
    </form>
    <?php



    if (isset($_POST["submit"])) {
        $appt_id = $_POST["apptid"];
        $details = $_POST["details"];
        $pres = $_POST["pres"];

        $sql = oci_parse($conn, "INSERT INTO DIAGNOSIS(APPT_ID, DIAGNOSIS_DETAILS)  
        values('$appt_id', '$details')");
        oci_execute($sql);

        foreach ($_POST['medc'] as $medc) {
            $sqlpres = oci_parse($conn, "INSERT INTO PRESCRIPTION(APPT_ID, PRESC_REMARKS, MED_ID)  
                values('$appt_id', '$pres', '$medc')");
            oci_execute($sqlpres);
        }

        if (($sql) && ($sqlpres)) {
            echo "<script>window.alert('Data Inserted Successfully.');window.location.href='bill.php?appt_id=" . $appt_id . "'; </script>";
        } else {
            echo "Data Unseccessfully Inserted!";
        }
    }

    ?>
</body>

</html>