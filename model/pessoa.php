<?php
include_once('../config/conexao.php');
include_once('../config/util.php');

function gravarPessoa($pessoa){

    $conn = conexao();
    $stmt = $conn->prepare("INSERT INTO pessoa (nome, endereco, telefone, cidadeid, estadoid, datanasc, caminhofoto) values (?,?,?,?,?,?,?);");
    $stmt->bindParam(1, $pessoa['nome']);
    $stmt->bindParam(2, $pessoa['endereco']);
    $stmt->bindParam(3, $pessoa['fone'] );
    $stmt->bindParam(4, $pessoa['cidade']);
    $stmt->bindParam(5, $pessoa['estado']);
    $stmt->bindParam(6, $pessoa['nascimento']);
    $stmt->bindParam(7, $pessoa['nome_imagem']);
    $stmt->execute();
    
    return $conn->lastInsertId();
    
}

function alterarPessoa($pessoa){
    $conn = conexao();
    $stmt = $conn->prepare("UPDATE pessoa set nome = ?, endereco = ?, telefone = ?, cidadeid = ?, estadoid = ?, datanasc = ?, caminhofoto = ? WHERE idpessoa = ?;");
    $stmt->bindParam(1, $pessoa['nome']);
    $stmt->bindParam(2, $pessoa['endereco']);
    $stmt->bindParam(3, $pessoa['fone'] );
    $stmt->bindParam(4, $pessoa['cidade']);
    $stmt->bindParam(5, $pessoa['estado']);
    $stmt->bindParam(6, $pessoa['nascimento']);
    $stmt->bindParam(7, $pessoa['nome_imagem']);
    $stmt->bindParam(8, $pessoa['idpessoa'] );
    $stmt->execute();
}

function localizarModelPessoa($nome) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM pessoa WHERE nome LIKE '%" . $nome . "%' ORDER BY idpessoa;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function localizarListaModelPessoa() {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT p.*, e.descricao as estado, c.nome as cidade ".
                            "FROM pessoa p, estado e, cidade c ".
                            "where p.estadoid = e.estadoid ".
                            "and p.cidadeid = c.cidadeid ".
                            "ORDER BY p.idpessoa desc  ");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelPessoa($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM pessoa WHERE idpessoa = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        echo "<script language='javascript'> alert('Pessoa excluída com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelPessoaID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM pessoa WHERE idpessoa =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function localizarModelClientes() {
    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM pessoa order by nome;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
