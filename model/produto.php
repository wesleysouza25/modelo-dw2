<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarProduto($produto){
    $conn = conexao();
    $stmt = $conn->prepare("insert into produto (descricao, custo, venda, unidadeid, marcaid) values (?,?,?,?,?)");
    $stmt->bindParam(1, $produto['descricao']);
    $stmt->bindParam(2, $produto['custo']);
    $stmt->bindParam(3, $produto['venda'] );
    $stmt->bindParam(4, $produto['unidade']);
    $stmt->bindParam(5, $produto['marca']);
    $stmt->execute();
}
function alterarProduto($produto){
    $conn = conexao();
    $stmt = $conn->prepare("update produto set descricao = ?, custo = ?, venda = ?, unidadeid = ?, marcaid = ? where produtoid = ?");
    $stmt->bindParam(1, $produto['descricao']);
    $stmt->bindParam(2, $produto['custo']);
    $stmt->bindParam(3, $produto['venda'] );
    $stmt->bindParam(4, $produto['unidade']);
    $stmt->bindParam(5, $produto['marca']);
    $stmt->bindParam(6, $produto['idproduto']);
    $stmt->execute();
}

function localizarModelProduto($descricao) {

    include_once('../config/conexao.php');

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM produto WHERE descricao LIKE '%" . $descricao . "%' ORDER BY descricao;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function carregarModelProduto($descricao) {

    include_once('../config/conexao.php');

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM produto WHERE descricao LIKE '" . $descricao . "%' ORDER BY descricao;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelProduto($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM produto WHERE produtoid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
	echo "<script language='javascript'> alert('Produto excluída com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelProdutoID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM produto WHERE produtoid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
