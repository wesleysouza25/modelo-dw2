<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarUnidade($unidade){
    $conn = conexao();
    $stmt = $conn->prepare("insert into unidade (descricao) values (?)");
    $stmt->bindParam(1, $unidade['descricao']);
    $stmt->execute();
}

function alterarUnidade($unidade){
    $conn = conexao();
    $stmt = $conn->prepare("update unidade set descricao = ? where unidadeid = ?");
    $stmt->bindParam(1, $unidade['descricao']);
    $stmt->bindParam(2, $unidade['unidadeid']);
    $stmt->execute();
}


function localizarModelUnidade($descricao) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM unidade WHERE descricao LIKE '%" . $descricao . "%' ORDER BY unidadeid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelUnidade($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM unidade WHERE unidadeid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        echo "<script language='javascript'> alert('Unidade excluída com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelUnidadeID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM unidade WHERE unidadeid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function carregarModelUnidade() {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM unidade");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}