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

        form {
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
</head>

<body>
    <?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = "SELECT * FROM prescription WHERE APPT_ID='" . $_GET['appt_id'] . "'";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_array($result);

    $apptid = $_GET['appt_id'];

    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $sql = "SELECT appt_id, SUM(med_price) as AMOUNT, appt_date FROM medicine INNER JOIN prescription USING (med_id) INNER JOIN diagnosis USING(appt_id) INNER JOIN appointments USING (appt_id) GROUP BY appt_id, appt_date HAVING appt_id = '" . $apptid . "'";
    $sqli = oci_parse($conn, $sql);
    oci_define_by_name($sqli, "AMOUNT", $total);
    oci_define_by_name($sqli, "APPT_DATE", $appt_date);
    $row = oci_execute($sqli);

    
    
    while($row = oci_fetch_assoc($sqli)) {
        echo "id: " . $row["APPT_ID"]. " - Total RM : " . $row["AMOUNT"]. "<br><br>";
        echo "MYR " .$total;
        echo "\t DATE " .$appt_date;
      }
      $ins = "INSERT INTO BILL(BILL_AMOUNT, APPT_ID, BILL_DATE) values ('$total','$apptid', '$appt_date')";
    $sqlins = oci_parse($conn, $ins);
    $insrow = oci_execute($sqlins);
    ?>
    

    <h1>Bill</h1>
    Bill Id <input style="border: none;" type="number" name="apptid" readonly value="<?php echo $row['BILL_ID']; ?>">
    <br><br>
    Bill Amount <input type="text" style="border: none;" name="docid" readonly value="<?php echo $row['BILL_AMOUNT']; ?>">
    <br><br>
    Appointment Id <input type="text" style="border: none;" name="id" readonly value="<?php echo $row['APPT_ID']; ?>">
    <br><br>


    <input class="button" type="submit" name="submit" value="SAVE">
</body>
</html>