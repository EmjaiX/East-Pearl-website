<?php
header("Content-Type: text/plain");
// header("Access-Control-Allow-Origin: http://127.0.0.1:5500");

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if ($contentType === "text/plain") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  if($content!=null) {
	  if($content == "stock"){
		include("dp.php");
		$query = "SELECT * FROM inventory;";
        $result = $conn->query($query); 
        $response = [];
        $i = 0;
        if ($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
				$response[$i]->item = $row["item"];
				$response[$i]->description = $row["description"];
				$response[$i]->quantity = $row["quantity"];
				$response[$i++]->cost = $row["cost"];	
			}
			exit(json_encode($response));
		}
		exit("'result': 0");
	 }else if($content == "covidkit"){
		 include("dp.php");
		$query = "SELECT * FROM customer_user;";
        $result = $conn->query($query); 
        $response = [];
        $i = 0;
        if ($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
				$response[$i]->id = $row["id"];
				$response[$i]->item = $row["item"];
				$response[$i++]->quantity = $row["quantity"];
			}
			exit(json_encode($response));
		}
		exit("'result': 0");
	 }else if($content == "customers"){
		include("dp.php");
		$query = "SELECT * FROM customer_user;";
        $result = $conn->query($query); 
        $response = [];
        $i = 0;
        if ($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
				$response[$i]->id = $row["ID"];
				$response[$i]->name = $row["name"];
				$response[$i]->address = $row["address"];
				$response[$i]->number = $row["number"];
				$response[$i++]->email = $row["email"];
				//$i += 1;	
			}
			exit(json_encode($response));
		}
		exit("'result': 0");
	 }else {
		$content = explode(":",$content);
		 if($content[0] == "item"){
			include("dp.php");
			$query = "SELECT * FROM inventory where ID = ".$content[1].";";
			$result = $conn->query($query);
			$i = 0;
			$response = "";
			if ($result->num_rows > 0) {
				//output data of each row
				while($row = $result->fetch_assoc()) {
					$response.= $row["ID"] .":". $row["item"] .":".$row["description"] .":". $row["quantity"] .":".$row["cost"] .";";	
				}
				exit($response);
			}else if($content[0] == "search"){
				include("dp.php");
				if($content[1] == ""){
					$query = "SELECT * FROM inventory";
				}
				else{
					$query = "SELECT * FROM inventory where item like '%".$content[1]."%';";
				}
				exit("hello");
				$result = $conn->query($query);
				
				$response = "";
				if ($result->num_rows > 0) {
					//output data of each row
					while($row = $result->fetch_assoc()) {
						$response.= $row["ID"] .":". $row["item"] .":".$row["description"] .":". $row["quantity"] .":".$row["cost"] .";";	
					}
					exit($response);
				}
			exit("'result': 0");
		 	}else {
			exit("Failure");
			}
	 	}
   	} 
	exit("Failure");
}else if($contentType === "application/json"){
    // $content = trim(file_get_contents("php://input"));
    // $content = json_decode($content,true);
    // if($content["request"]=="stock"){}
    exit("soon");
}}
exit("Failure");
?>
