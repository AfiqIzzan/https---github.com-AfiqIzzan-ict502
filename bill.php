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

        .box {
            margin: 0px auto;
            margin-top: 2%;
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

        select,
        input {
            width: 98.5%;
            height: 25px;
        }

        select {
            width: 100%;
            height: 30px;
        }
    </style>
</head>

<body>
    <?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = "SELECT * FROM bill INNER JOIN diagnosis USING (DIAGNOSIS_ID) INNER JOIN medicine USING (MED_ID) WHERE APPT_ID='" . $_GET['appt_id'] . "'";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_array($result);

    ?>
    

    <h1>Bill</h1>
    <div class="box">
        Bill Id <input style="border: none;" type="number" name="apptid" readonly value="<?php echo $row['BILL_ID']; ?>"><br><br>
        Bill Date  <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['BILL_DATE']; ?>"><br><br>
        Bill Amount (RM) <input type="text" style="border: none;" name="docid" readonly value="<?php echo $row['BILL_AMOUNT']; ?>"><br><br>
        Appointment Id  <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['APPT_ID']; ?>"><br><br>
        Diagnosis Id <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['DIAGNOSIS_NAME']; ?>"><br><br>
        Diagnosis Id <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['MED_NAME']; ?>">

    </div>
</body>
</html>