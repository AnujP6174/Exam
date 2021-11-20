<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "rbeitest_db");

$chapter_id = $_GET['chapter'];

$usr_id = $_GET['user_id'];

$class_name = $_GET['class_name'];
echo $chapter_id, "\n";
echo $usr_id, "\n";
echo $class_name;
$Selecting_Chapter_Query = "SELECT Chap_name from `rb_chapter_tb` WHERE id='$chapter_id' AND Class_Name='$class_name'";

$Selecting_Chapter_Result = mysqli_query($conn, $Selecting_Chapter_Query) or die(mysqli_error($conn));

$Selecting_Chapter_Row = mysqli_fetch_array($Selecting_Chapter_Result);
echo $Selecting_Chapter_Row[0];
$button_query = "INSERT INTO chapter_completion_tb (user_id,Chap_name,Progress) values('$usr_id',
'$Selecting_Chapter_Row[0]','Done')";

$button_result = mysqli_query($conn, $button_query) or die(mysqli_error($conn));
