<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rbeitest_db");

$chapter_name = $_GET['chapter'];
$usr_id = $_GET['user_id'];

$button_query = "INSERT into chapter_completion_tb (user_id,Chap_name,Progress) values('$usr_id','$chapter_name','Done')";
$button_result = mysqli_query($conn, $button_query) or die(mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">

</html>