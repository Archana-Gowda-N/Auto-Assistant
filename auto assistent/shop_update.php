<?php
$conn = new mysqli("localhost", "root", "", "auto_assistant");
$id = $_POST['id'];
$status = $_POST['status'];
$conn->query("UPDATE breakdown_requests SET status = '$status' WHERE id = $id");
header("Location: shop_dashboard.php");
