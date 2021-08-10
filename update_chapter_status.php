<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rbeitest_db");

$chapter_name = $_GET['chapter'];
$usr_id = $_GET['user_id'];

// echo "The request was recieved by the ajax call with param chapter name : " . $chapter_name;

$button_query = "INSERT into chapter_completion_tb (user_id,Chap_name,Progress) values('$usr_id','$chapter_name','Done')";
$button_result = mysqli_query($conn, $button_query) or die(mysqli_error($conn));
// $button_row = mysqli_fetch_array($button_result);
?>
<!DOCTYPE html>
<html lang="en">

</html>