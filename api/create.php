<?php
require 'db_connect.php';

$post = $_POST;

$sql = "INSERT INTO items(title,description) VALUES ('".$post['title']."','".$post['description']."')";

$result = $mysql->query($sql);

$sql = "SELECT * FROM items ORDER BY id DESC LIMIT 1";

$result = $mysql->query($sql);

$data = $result->fetch_assoc();

echo json_encode($data);