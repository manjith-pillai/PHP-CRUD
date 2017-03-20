<?php
require 'db_connect.php';

$id = $_POST["id"];
$post = $_POST;

$sql = "UPDATE items SET title = '".$post['title']."',description = '".$post['description']."' WHERE id = '".$id."'";

$result = $mysql->query($sql);

$sql = "SELECT * FROM items WHERE id = '".$id."'";

$result = $mysql->query($sql);

$data = $result->fetch_assoc();

echo json_encode($data);