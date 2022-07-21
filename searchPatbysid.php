<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Filter Appointment By IC Number</title>
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

        .txtfield {
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
        .fil:hover {
			cursor: pointer;
			color: #111111;
		}

		.fil{
			background-color: #CED6E0;
			border: none;
			padding: 14px 16px;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
			color: #555555;
			border-radius: 4px;
            text-decoration: none;
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
        <select name='supid'>
        <option value="">Select Supervisor</option>
            <?php
            $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
            $stid = oci_parse($conn, 'select a.staff_id, s.staff_name from assistants a JOIN staffs s ON s.staff_id= a.staff_id WHERE a.supervisor_id is null');
            $row = oci_execute($stid);
            $i = 0;
            while ($row = oci_fetch_assoc($stid)) {
            ?>
                <option value="<?php echo $row["STAFF_ID"]; ?>"><?php echo $row["STAFF_ID"]; ?> &nbsp;<?php echo $row["STAFF_NAME"]; ?></option>
            <?php
                if (isset($select) && $select != "") {
                    $select = $_POST['supid'];
                }
                $i++;
            }
            ?><br>
            </select><br> <input class="button" name="submit" type="submit" value="SEARCH">
    </form>



    <?php
    if (isset($_POST["submit"])) {
        $search = $_POST["supid"];
        //echo $search;
        $query = "SELECT * FROM staffs INNER JOIN assistants USING (staff_id) WHERE SUPERVISOR_ID='" . $search . "'";
        $stid = oci_parse($conn, $query);
        $row = oci_execute($stid); ?>
        <table id="myTable" border="1">
            <tr>
                <th>STAFF ID</th>
                <th>STAFF NAME</th>
                <th>STAFF CONTACT</th>
                <th>STAFF ADDRESS</th>
                <th>ROLE</th>
            </tr><?php
                    while ($row = oci_fetch_assoc($stid)) { ?>
                <tr class="item">
                    <td><?php echo $row["STAFF_ID"]; ?></td>
                    <td><?php echo $row["STAFF_NAME"]; ?></td>
                    <td><?php echo $row["STAFF_CONTACT"]; ?></td>
                    <td><?php echo $row["STAFF_ADDRESS"]; ?></td>
                    <td><?php echo $row["ASSISTANT_ROLE"]; ?></td>
                </tr><?php
                    } ?>
        </table><?php
            }
                ?>
                <br><br><a class="fil" href="home.php" action="">Back</a>
</body>

</html>