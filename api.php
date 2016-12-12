<?php
require_once("Rest.inc.php");
require_once("db.php");
include('functions.php');

class API extends REST {
	public $data = "";

	//Public method for access api.
	//This method dynmically call the method based on the query string
	public function processApi() {
		$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
		if((int)method_exists($this,$func) > 0)
		$this->$func();
		else
		$this->response('',404);
		// If the method not exist with in this class, response would be "Page not found".
	}

	private function login() {
		// Cross validation if the request method is POST else it will return "Not Acceptable" status
		if($this->get_request_method() != "POST") {
			$this->response('',406);
		}

		$username = $this->_request['username'];
		$password = $this->_request['password'];

		// Input validations
		//if(!empty($username) and !empty($password)) {
		if (true) {
			$sql = mysql_query('SELECT * FROM users WHERE Username = "'. $username .'" AND Password = "'. md5($password) .'"');
			if(mysql_num_rows($sql) > 0) {
				$result = mysql_fetch_array($sql,MYSQL_ASSOC);
				// If success everythig is good send header as "OK" and user details
				$this->response($this->json($result), 200);
				session_save_path("/home/users/web/b1159/nf.hiptopdesign1/cgi-bin/tmp");
			}
			else {
				$this->response('No user found with those credentials', 200); // If no records "No Content" status
			}
		}
		else {
			// If invalid inputs "Bad Request" status message and reason
			$error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			$this->response($this->json($error), 400);
		}
	}


	private function register() {
		if($this->get_request_method() != "POST") {
			$this->response('',406);
		}

		$postdata = file_get_contents("php://input");
    	$requesta = json_decode($postdata);
    	$request = $requesta->vendor;

    	$username = $request->username;
    	$password = $request->password;
    	$email = $request->email;
    	$addressline1 = $request->addressline1;
    	$addressline2 = $request->addressline2;
    	$addressline3 = $request->addressline3;
    	$city = $request->city;
    	$state = $request->state;
    	$zip = $request->zip;
    	$PhoneNumber = $request->PhoneNumber;
    	$BusinessName = $request->BusinessName;
    	$latitude = $request->latitude;
    	$longitude = $request->longitude;

    	$query = mysql_query("INSERT INTO Vendors (`Username` , `Password`, `Email`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `City`, `State`, `ZipCode`, `PhoneNumber`, `BusinessName`, `Latitude`, `Longitude`, `Random_key`) VALUES ('". $username ."', '". md5($password) ."', '". $email ."', '". $addressline1 ."', '". $addressline2 ."', '". $addressline3 ."', '". $city ."', '". $state ."', '". $zip ."', '". $PhoneNumber ."', '". $BusinessName ."', '". $latitude ."', '". $longitude ."','".random_string('alnum', 32)."')") or die(mysql_error());

		$getUser = mysql_query('SELECT ID, Username, Temp_pass, Email FROM users WHERE Email = "' . $email .'"');

		if(mysql_num_rows($getUser)==1) {
		
			$row = mysql_fetch_assoc($getUser);

			$headers = 	'From: webmaster@yoursite.com' . "\r\n" .
    					'Reply-To: webmaster@yoursite.com' . "\r\n" .
    					'X-Mailer: PHP/' . phpversion();
			$subject = "Activation email from yoursite.com";
			$message = "Dear ".$row['Username'].", this is your activation link to join our website. In order to confirm your membership please click on the following link: http://www.yoursite.com/confirm.php?ID=".$row['ID']."&amp;key=".$row['Random_key']." Thank you for joining";

			if(mail($row['Email'], $subject, $message, $headers)) {
				$msg = 'Account created. Please login to the email you provided during registration and confirm your membership.';
				$this->response($this->json($msg), 200);
			}
			else {
				$error = 'I created the account but failed sending the validation email out. Please inform my boss about this cancer of mine';
				$this->response($this->json($error), 200);
			}
		}
		else {
			$error = 'You just made possible the old guy (the impossible). Please inform my boss in order to give you the price for this.';
			$this->response($this->json($error), 200);
		}

	}

	private function users() {

	}

	private function deleteUser() {

	}

	//Encode array into JSON
	private function json($data) {
		if(is_array($data)){
			return json_encode($data);
		}
	}
}

// Initiiate Library
$api = new API;
$api->processApi();

?>