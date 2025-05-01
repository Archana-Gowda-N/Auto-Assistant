<?php
$conn = new mysqli("localhost", "root", "", "auto_assistant");
$id = $_POST['id'];
$conn->query("DELETE FROM breakdown_requests WHERE id = $id");
header("Location: admin_panel.php");
