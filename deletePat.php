<?php
	$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
	$query = oci_parse($conn, "DELETE FROM PATIENTS WHERE PATIENT_ID='". $_GET["PATIENT_ID"]."'");
	$result = oci_execute($query);  
	if($result)  
	{  
		oci_commit($conn); //*** Commit Transaction ***// 
		print "Data Deleted Successfully.";?>
		<html><body>
			<script> location.replace('listPat.php')</script>;
		</body></html>
		<?php
	}
	else{
		print "Error.";
	}
?>