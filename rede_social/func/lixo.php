<?php 
include_once ('conexao.php');
$email = "raulan@gmail.com";
$query = "select * from usuario where email=:email";
$stmt= $conexao->prepare($query);
$stmt->bindParam(':email',$email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);

?>