<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Filter Appointment By IC Number</title>
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

        table {
            background: #f7f7f7;
            text-align: center;
            margin-left: 5px;
            margin-right: 5px;
            border-collapse: collapse;
            border-width: 2px;
            margin-left: auto;
            margin-right: auto;
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

        .button {
            background-color: #CED6E0;
            border: none;
            padding: 8px 12px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            color: #555555;
            border-radius: 4px;
        }
        .txtfield{
            padding: 8px 12px;
        }
        h1 {
            text-align: center;
            color: #414c6b;
            font-size: 40px;
        }

        a {
            color: #555555;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            color: black;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="addPat.php">Register Patient</a>
        <a href="listPat.php">List Of Patient</a>
        <a href="addAppt.php">Create Appointment</a>
        <a href="listAppt.php">List Of Appointment</a>
    </div>
    <form action="" method="POST">
    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });
        </script>
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
        </select><br> <input class="button" name="submit" type="submit" value="SEARCH">
    </form>



    <?php
    if (isset($_POST["submit"])) {
        $doctor_id = $_POST["doc_id"];
        //echo $doctor_id;
        $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
        $query = "SELECT * FROM APPOINTMENTS  WHERE doctor_id =  $doctor_id order by appt_id ";
        $stid = oci_parse($conn, $query);
        $row = oci_execute($stid);?>
        <table id="myTable" border="1">
            <tr>
                <th>APPOINTMENT ID</th>
                <th>APPOINTMENT DATE</th>
                <th>APPOINTMENT TIME</th>
                <th>PATIENT ID</th>
                <th>ASSISTANT ID</th>
                <th>DOCTOR ID</th>
                <th colspan="3">ACTION</th>
            </tr>
                <tr class="item"><?php
                    while ($row = oci_fetch_assoc($stid)) { ?>
                
                    <td><?php echo $row["APPT_ID"]; ?></td>
                    <td><?php echo $row["APPT_DATE"]; ?></td>
                    <td><?php echo $row["APPT_TIME"]; ?></td>
                    <td><?php echo $row["PATIENT_ID"]; ?></td>
                    <td><?php echo $row["ASSISTANT_ID"]; ?></td>
                    <td><?php echo $row["DOCTOR_ID"]; ?></td>
                    <td><a class="but" href="updateAppt.php?APPT_ID=<?= $row["APPT_ID"]; ?>">Update</a></td>
                    <td><a class="but" href="deleteAppt.php?APPT_ID=<?= $row["APPT_ID"]; ?>">Delete</a></td>
                    <td><a class="but" href="addDiag.php?APPT_ID=<?= $row["APPT_ID"]; ?>">Add Diagnosis</a></td>
                </tr>
                <?php
                    }
		?>
        </table><?php
                    
    }
    ?>
</body>

</html>

