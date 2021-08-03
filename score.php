<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "rbeitest_db");
    }
?>