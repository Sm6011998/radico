<?php 

	/* ==========================  Define variables ========================== */

	#Your e-mail address
	define("__TO__", "besimdauti24@gmail.com");

	#Message subject
	define("__SUBJECT__", "examples.com = From:");

	#Success message
	define('__SUCCESS_MESSAGE__', "Your reservation message has been sent. Thank you!");

	#Error message 
	define('__ERROR_MESSAGE__', "Error, your message hasn't been sent");

	#Messege when one or more fields are empty
	define('__MESSAGE_EMPTY_FILDS__', "Please fill out all fields");

	/* ========================  End Define variables ======================== */

	//Send mail function
	function send_mail($to,$subject,$message,$headers){
		if(@mail($to,$subject,$message,$headers)){
			echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
		} else {
			echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
		}
	}

	//Check e-mail validation
	function check_email($email){
		if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			return false;
		} else {
			return true;
		}
	}

	//Get post data
	if(isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['date']) and isset($_POST['time']) and isset($_POST['guests']) and isset($_POST['phone-number'])){
		$name 	 = $_POST['name'];
		$mail 	 = $_POST['mail'];
		$date  = $_POST['date'];
		$time  = $_POST['time'];
		$guests = $_POST['guests'];
		$phone = $_POST['phone-number'];
		$subject = 'Reservation';

		if($name == '') {
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
			exit();
		} else if($mail == '' or check_email($mail) == false){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
			exit();
		} else if($date == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter reservation date."));
			exit();
		} else if($time == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter reservation time (ex: 7:00 p.m)."));
			exit();
		} else if($guests == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter number of Guests."));
			exit();
		} else if($phone == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your phone number."));
			exit();
		} else {
			//Send Mail
			$to = __TO__;
			$message = '
			<html>
			<head>
			  <title>Mail from '. $name .'</title>
			</head>
			<body>
			  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Name:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $name .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $mail .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Date Reservation:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $date .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Time reservation:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $time .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Number of Guests:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $guests .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Phone Number:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $phone .'</td>
				</tr>
			  </table>
			</body>
			</html>
			';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: ' . $mail . "\r\n";

			send_mail($to,$subject,$message,$headers);
		}
	} else {
		echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FILDS__));
	}
 ?>