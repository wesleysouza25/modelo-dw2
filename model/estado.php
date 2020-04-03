<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarEstado($estado){
    $conn = conexao();
    $stmt = $conn->prepare("insert into estado (sigla, descricao) values (?,?)");
    $stmt->bindParam(1, $estado['sigla']);
    $stmt->bindParam(2, $estado['descricao']);
    $stmt->execute();
}
function alterarEstado($estado){
    $conn = conexao();
    $stmt = $conn->prepare("update estado set sigla = ?, descricao = ? where estadoid = ?");
    $stmt->bindParam(1, $estado['sigla']);
    $stmt->bindParam(2, $estado['descricao']);
    $stmt->bindParam(3, $estado['estadoid']);
    $stmt->execute();
}

function localizarModelEstado($descricao) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM estado WHERE descricao LIKE '%" . $descricao . "%' ORDER BY estadoid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelEstado($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM estado WHERE estadoid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        echo "<script language='javascript'> alert('Estado excluído com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelUF() {
    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM estado;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function retornaModelUFID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM estado where estadoid=" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

