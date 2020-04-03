<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarMarca($marca){
    $conn = conexao();
    $stmt = $conn->prepare("insert into marca (descricao) values (?)");
    $stmt->bindParam(1, $marca['descricao']);
    $stmt->execute();
}

function alterarMarca($marca){
    $conn = conexao();
    $stmt = $conn->prepare("update marca set descricao = ? where marcaid = ?");
    $stmt->bindParam(1, $marca['descricao']);
    $stmt->bindParam(2, $marca['marcaid']);
    $stmt->execute();
}

function localizarModelMarca($descricao) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM marca WHERE descricao LIKE '%" . $descricao . "%' ORDER BY marcaid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelMarca($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM marca WHERE marcaid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        echo "<script language='javascript'> alert('Exclusão realizada com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir! Existe produto vinculado!') </script>";
    }
}

function localizarModelMarcaID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM marca WHERE marcaid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function carregarModelMarca() {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM marca");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}