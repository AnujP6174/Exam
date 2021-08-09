<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rbeitest_db");

$chapter_name = $_GET['chapter'];

//echo "The request was recieved by the ajax call with param chapter name : " . $chapter_name;

$button_query = "UPDATE `chapter_completion_tb` SET Progress='Done' WHERE Chap_name='$chapter_name'";
$button_result = mysqli_query($conn, $button_query) or die(mysqli_error($conn));
// $button_row = mysqli_fetch_array($button_result);
?>
<!DOCTYPE html>
<html lang="en">

</html>