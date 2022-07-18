<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LogIn</title>
    <style>
        body {
            text-align: center;
            background-image: url("bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            color: #555555;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
        }

        .button {
            background-color: #CED6E0;
            border: none;
            border-radius: 8px;
            padding: 6px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            color: #555555;
        }

        .button:hover {
            color: black;
            background-color: #bac3cf;
        }
    </style>
</head>

<body>
    <img src="logo.png"><br>
    <h1>My Health Clinic</h1><br>
    <form action="" method="POST" >
        <input type="text" name="id" placeholder="ID"><br><br />
        <input type="password" name="katalaluan" placeholder="PASSWORD"><br /><br /> 
        <input class="button" type="submit" name="login" value="Login" />
    </form>
</body>

</html>

<?php
if (isset($_POST["login"])) {
    $id = $_POST["id"];
    $pswrd = $_POST["katalaluan"];
    if ($id == "") {
        echo "<script>window.alert('Sila Masukkan ID Guru!')</script>";
    } else if ($pswrd == "") {
        echo "<script>window.alert('Sila Masukkan Kata Laluan!')</script>";
    } else {

        $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
        $sql = oci_parse($conn, "SELECT * FROM staffs WHERE STAFF_ID='$id' AND STAFF_CONTACT='$pswrd'");
        $stid = oci_execute($sql);
        if (oci_num_rows($sql) == 0) {
            $row = oci_fetch_assoc($sql);
            if ($row['STAFF_ID'] === $id && $row['STAFF_CONTACT'] === $pswrd) {
                echo "<script>window.alert('Logged In');window.location.href='home.php';</script>";
            }
        } else {
            echo "<script>window.alert('ID Guru atau Kata Laluan tidak sah!')</script>";
        }
    }
}
?>