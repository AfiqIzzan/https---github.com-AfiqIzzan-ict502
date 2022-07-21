<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("cu.jpg");
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
        h1 {
            text-align: center;
            color: #414c6b;
            font-size: 40px;
        }
		.pic{
			float: left;
		}
		.tx{
			font-family: Arial, Helvetica, serif;
			width: 50%;
			text-align: justify; 
			overflow: hidden;
			background-color: whitesmoke;
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px;
            padding: 20px;
            box-shadow: rgba(60, 66, 87, 0.12) 0px 17px 24px 0px, rgba(0, 0, 0, 0.12) 0px 3px 6px 0px;
		}
    </style>
</head>
<body>
	<div class="topnav">
        <a class="active" href="home.php">Home</a>
        <a href="addPat.php">Register Patient</a>
        <a href="listPat.php">List Of Patient</a>
        <a href="addAppt.php">Create Appointment</a>
        <a href="listAppt.php">List Of Appointment</a>
    </div>
	<h1>My Health Clinic</h1><br>

	<div><p class="tx">MyHealth Clinic is a network of multi-specialty medical clinics offering 
		comprehensive outpatient healthcare products and services. Believing that healthcare should be not just 
		of quality, but must also be accessible, we integrated in our clinics the entire 
		spectrum of medical services that patients need to take better care of their health.</p>
		<br>
		<hr style="overflow: hidden; width:52%; margin-left:22.6em; border-width: 2px;">
	</div><br><br>
	

</body>
</html>