<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Register Patient</title>
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
            width: 98%;
            height: 25px;
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

        .back {
            background-image: url("back.png");
            background-color: transparent;
            height: 40px;
            width: 40px;
            border: none;
        }
    </style>
</head>

<body>
    <?php $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = 'select max(PATIENT_ID) as PATIENT_ID from PATIENTS';
    $stid = oci_parse($conn, $query);
    $row = oci_execute($stid);
    $fetch = oci_fetch_assoc($stid);
    $lastid = $fetch["PATIENT_ID"];

    $newid = $lastid + 1;
    ?>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a class="active" href="addPat.php">Register Patient</a>
        <a href="listPat.php">List Of Patient</a>
        <a href="addAppt.php">Create Appointment</a>
        <a href="listAppt.php">List Of Appointment</a>
    </div>
    <h1>Register Patient</h1>
    <form action="" method="POST">
        ID <br><input style="border: none; color:darkgray; cursor:not-allowed;" type="number" name="id" value="<?php echo $newid; ?>" readonly><br /><br />
        Name <br><input type="text" name="name" /><br /><br />
        IC Number <br><input type="text" name="ic" placeholder="XXXXXX-XX-XX" /><br /><br />
        Contact Number <br><input type="text" name="contact"  placeholder="XXX-XXXXXXX"/><br /><br />
        Address <br><input type="text" name="address" /><br /><br />

        <input class="button" type="submit" name="submit" value="REGISTER" /><br>
    </form>
</body>

</html>

<?php

if (isset($_POST["submit"])) {
    $newid = $_POST["id"];
    $name = $_POST["name"];
    $ic = $_POST["ic"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    if ($name == "") {
        echo "<script>window.alert('Please Select Patient Id!')</script>";
    } else if ($ic == "") {
        echo "<script>window.alert('Please Enter Appointment Date!')</script>";
    } else if ($contact == "") {
        echo "<script>window.alert('Please Enter Appointment Date!')</script>";
    } else if ($address == "") {
        echo "<script>window.alert('Please Enter Appointment Date!')</script>";
    } else {
        $sql = oci_parse($conn, "INSERT INTO PATIENTS(PATIENT_ID, PATIENT_NAME, PATIENT_IC, PATIENT_CONTACT, PATIENT_ADDRESS)  
        values('$newid','$name','$ic','$contact','$address')");
        oci_execute($sql);
        if ($sql) { ?>
            <html>
            <script>
                window.alert('Data Successfully Inserted');
                window.location.href = 'listPat.php';
            </script>

            </html>;
            <?php
        } else {
            echo "Data Unseccessfully Inserted!";
        }
    }
}
?>