<?php
header("Content-Type: text/plain");
header("Access-Control-Allow-Origin: *");
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "text/plain") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));
  $content = explode(";",$content);
  
  include("db.php");
    $query = "SELECT * FROM Links WHERE Active=1;";
    $result = $conn->query($query);
    if ($result) {
        while($row = mysqli_fetch_array($result)) {
            $row["Active"]    
            }
    }
  exit(gettype($content));
  if($content!=null) {
    exit("temporal success");
  }
}
exit("some error");
?>
