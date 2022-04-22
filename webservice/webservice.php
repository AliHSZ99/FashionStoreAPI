<?php

	//1- Read the request payload sent from client.php
	
	$request_body = file_get_contents('php://input');
	
	//2- Set the header filed content-type of the response to be application/json_decode
	header("content-type: application/json");	


	// Assume that we did the video conversion and built the response data.
	// send the response data:
	
	$data = (array) json_decode($request_body);
	
	$data += array("outputfile" => "c:\\outputfile.avi");
	
	echo json_encode($data);
	
	

?>