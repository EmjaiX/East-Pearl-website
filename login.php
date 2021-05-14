<?php
header("Content-Type: text/plain");
header("Access-Control-Allow-Origin: *");
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "text/plain") {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));
    $content = explode(";",$content);
    include("dp.php");
    $query = "SELECT token FROM customer_user WHERE username='".$content[0]."' and password='".$content[1]."';";
    $result = $conn->query($query);
    if ($result) {
        while($row = mysqli_fetch_array($result)) {
            exit("success:".$row["token"]);
            }
    }
    exit("failure");
}
header("Location: ./index.html");
?>
