<?php
	session_start();



if(isset($_POST["image"]))
{
	$data = $_POST["image"];


	$image_array_1 = explode(";", $data);


	$image_array_2 = explode(",", $image_array_1[1]);


	$data = base64_decode($image_array_2[1]);

	$imageName = time() . '.png';



	$_SESSION['foto'] = $data;
	
	echo '<p><img src="data:image/png;base64,'.base64_encode ($data).'"></p>';


}

?>