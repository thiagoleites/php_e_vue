<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbsa = 'crud';
$conn = new mysqli($host, $user, $pass, $dbsa, 9900);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = array('error' => false);
$action = '';

if(isset($_GET['action'])) {
    $action = $_GET['action'];
}
if($action == 'read') {
  $sql = $conn->query("SELECT * FROM users");
  $users = array();
  while ($row = $sql->fetch_assoc()) {
    array_push($users, $row);
  }
  $result['users'] = $users;
}
if($action == 'create') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = $conn->query("INSERT INTO users (name,email) VALUES ('$name', '$email')");
  if($sql) {
    $result['message'] = "Usuário adicionado com sucesso!";
  } else {
    $result['error'] = true;
    $result['message'] = "Erro ao adicionar usuário!";
  }
}

if($action == 'update') {
  $sql = $conn->query("UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."' WHERE id=".$_POST['id']);
  if($sql) {
    $result['message'] = "Usuário atualizado com sucesso!";
  } else {
    $result['error'] = true;
    $result['message'] = "Erro ao atualizar usuário!";
  }
}

if($action == 'delete') {
  $sql = $conn->query("DELETE FROM users  WHERE id = ".$_POST['id']);
  if($sql) {
    $result['message'] = "Usuário removido com sucesso!";
  } else {
    $result['error'] = true;
    $result['message'] = "Erro ao remover usuário!";
  }
}
echo json_encode($result);