<?php
	$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
	$query = oci_parse($conn, "DELETE FROM APPOINTMENTS WHERE APPT_ID='". $_GET["APPT_ID"]."'");
	$result = oci_execute($query);  
	if($result)  
	{  
		oci_commit($conn); //*** Commit Transaction ***// 
		print "Data Deleted Successfully.";?>
		<html><body>
			<script> location.replace('listAppt.php')</script>;
		</body></html>
		<?php
	}
	else{
		print "Error.";
	}
?>