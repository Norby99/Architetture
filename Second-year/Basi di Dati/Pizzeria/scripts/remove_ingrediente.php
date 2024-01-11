<?php
$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/setup.json'), true);

$conn = new mysqli("localhost", $data['dbUserName'], $data['dbPassword'], $data['dbName']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_GET['nome'];

$stmt = $conn->prepare("DELETE FROM ingredienti WHERE nome = ?");
$stmt->bind_param("s", $nome);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: /ingredienti.php");
?>
