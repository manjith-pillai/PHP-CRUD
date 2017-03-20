<?php
require 'db_connect.php';

$id  = $_POST["id"];

$sql = "DELETE FROM items WHERE id = '".$id."'";

$result = $mysql->query($sql);

echo json_encode([$id]);