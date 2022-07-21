<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
            height: 14px;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            border: 1px solid #c0c0c2;
            outline: none;
        }

        select {
            width: 100%;
            height: 30px;
        }
        .box{
            height: 32px;
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
    <title>Create Appointment</title>
</head>

<body>
    <?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    $query = 'select max(APPT_ID) as APPT_ID from APPOINTMENTS';
    $stid = oci_parse($conn, $query);
    $row = oci_execute($stid);
    $fetch = oci_fetch_assoc($stid);
    $lastid = $fetch["APPT_ID"];
    $newappt = $lastid +1;
    ?>
    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="addPat.php">Register Patient</a>
        <a href="listPat.php">List Of Patient</a>
        <a class="active" href="addAppt.php">Create Appointment</a>
        <a href="listAppt.php">List Of Appointment</a>
    </div>
    <h1>Create Appointment</h1>
    <form action="" method="POST">
        Appointment ID <input style="border: none; color:darkgray;" class="box" type="text" name="idappt" value="<?php echo $newappt; ?>" readonly><br /><br />

        Patient
        <select name='id'>
            <option value="">Select Patient</option>
            <?php
            $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
            $stid = oci_parse($conn, 'select * from PATIENTS order by PATIENT_ID asc');
            $row = oci_execute($stid);
            $i = 0;
            while ($row = oci_fetch_assoc($stid)) {
            ?>
                <option value="<?php echo $row["PATIENT_ID"]; ?>"><?php echo $row["PATIENT_ID"]; ?> &nbsp;<?php echo $row["PATIENT_NAME"]; ?></option>
            <?php
                if (isset($select) && $select != "") {
                    $select = $_POST['id'];
                }
                $i++;
            }
            ?>
        </select><br>
        Doctor
        <select name='doc_id'>
        <option value="">Select Doctor</option>
            <?php
            $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
            $stid = oci_parse($conn, 'select * from STAFFS INNER JOIN DOCTORS ON DOCTORS.DOCTOR_ID = STAFFS.STAFF_ID order by DOCTOR_ID asc');
            $row = oci_execute($stid);
            $i = 0;
            while ($row = oci_fetch_assoc($stid)) {
            ?>
                <option value="<?php echo $row["DOCTOR_ID"]; ?>"><?php echo $row["DOCTOR_ID"]; ?> &nbsp;<?php echo $row["STAFF_NAME"]; ?></option>
            <?php
                if (isset($select) && $select != "") {
                    $select = $_POST['doc_id'];
                }
                $i++;
            }
            ?>
        </select><br>
        Assistant
        <select name='ast_id'>
        <option value="">Select Assistant</option>
            <?php
            $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
            $stid = oci_parse($conn, 'select * from STAFFS INNER JOIN ASSISTANTS ON ASSISTANTS.ASSISTANT_ID = STAFFS.STAFF_ID order by ASSISTANT_ID asc');
            $row = oci_execute($stid);
            $i = 0;
            while ($row = oci_fetch_assoc($stid)) {
            ?>
                <option value="<?php echo $row["ASSISTANT_ID"]; ?>"><?php echo $row["ASSISTANT_ID"]; ?> &nbsp;<?php echo $row["STAFF_NAME"]; ?></option>
            <?php
                if (isset($select) && $select != "") {
                    $select = $_POST['ast_id'];
                }
                $i++;
            }
            ?>
        </select><br>
        Appointment Date <input class="box" type="text" name="date" placeholder="DD-MONTH-YYYY" /><br /><br />
        Appointment Time <input class="box" type="text" name="time" placeholder="HH:MM AM/PM" /><br /><br />

        <input class="button" type="submit" name="submit" value="SAVE" />
    </form>
</body>

</html>

<?php

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $doctor_id = $_POST["doc_id"];
    $assistant_id = $_POST["ast_id"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    if ($id == "") {
        echo "<script>window.alert('Please Select Patient Id!')</script>";
    } else if ($doctor_id == "") {
        echo "<script>window.alert('Please Enter Appointment Date!')</script>";
    } else if ($assistant_id == "") {
        echo "<script>window.alert('Please Enter Appointment Time!')</script>";
    } else if ($date == "") {
        echo "<script>window.alert('Please Enter Select Assistant!')</script>";
    } else if ($time == "") {
        echo "<script>window.alert('Please Enter Select Doctor!')</script>";
    } else {
        $sql = oci_parse($conn, "INSERT INTO APPOINTMENTS( APPT_DATE, APPT_TIME, PATIENT_ID, ASSISTANT_ID, DOCTOR_ID)  
        values('$date','$time','$id', '$assistant_id', '$doctor_id')");

        oci_execute($sql);
        if ($sql) { ?>
            <html>
            <script>
                window.alert('Data Successfully Inserted');
                window.location.href = 'listAppt.php';
            </script>

            </html>;
<?php
        } else {
            echo "Data Unseccessfully Inserted!";
        }
    }
}
?>