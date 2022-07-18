<?php
    $conn = oci_connect('demo', 'system', 'localhost:1521/xe');
    if (!$conn) 
    {
        $m = oci_error(); 
        echo $m['message'], "\n";
        exit;
    }

    $stid = oci_parse($conn,"INSERT INTO PATIENT (PATIENT_ID, PATIENT_NAME, PATIENT_IC, PATIENT_ADDRESS) 
    VALUES(:id, :name, :ic, :address)");

    $PATIENT_ID = 12;
    $PATIENT_NAME = "Iqmal";
    $PATIENT_IC = "125";
    $PATIENT_ADDRESS = "3, Jalan Panchor";

    oci_bind_by_name($stid, ":id", $PATIENT_ID);
    oci_bind_by_name($stid, ":name", $PATIENT_NAME);
    oci_bind_by_name($stid, ":ic", $PATIENT_IC);
    oci_bind_by_name($stid, ":address", $PATIENT_ADDRESS);

    oci_execute($stid);
    print "Successfully inserted into DB!";
?>