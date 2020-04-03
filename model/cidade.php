<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarCidade($cidade){
    $conn = conexao();
    $stmt = $conn->prepare("insert into cidade (nome, estadoid, codibge) values (?,?,?)");
    $stmt->bindParam(1, $cidade['nome']);
    $stmt->bindParam(2, $cidade['estadoid'] );
    $stmt->bindParam(3, $cidade['ibge']);
    $stmt->execute();
}
function alterarCidade($cidade){
    $conn = conexao();
    $stmt = $conn->prepare("update cidade set nome = ?, estadoid = ?, codibge = ? where cidadeid = ?");
    $stmt->bindParam(1, $cidade['nome']);
    $stmt->bindParam(2, $cidade['estadoid'] );
    $stmt->bindParam(3, $cidade['ibge']);
    $stmt->bindParam(4, $cidade['cidadeid']);
    $stmt->execute();
}

function localizarModelCidade($descricao) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM cidade WHERE nome LIKE '%" . $descricao . "%' ORDER BY cidadeid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function carregarModelCidade($uf) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM cidade where estadoid = $uf ORDER BY cidadeid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelCidade($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM cidade WHERE cidadeid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelCidadeID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM cidade WHERE cidadeid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}