<?php

    include_once('../config/conexao.php');
    include_once('../config/util.php');


function gravarVendedor($vendedor){
    
    $conn = conexao();
    $stmt = $conn->prepare("INSERT INTO vendedor (nome, endereco, telefone, cidadeid, estadoid, datanasc, funcao, usuarioid) ".
            "values (?,?,?,?,?,?,?,?);");
    $stmt->bindParam(1, $vendedor['nome'] );
    $stmt->bindParam(2, $vendedor['endereco']);
    $stmt->bindParam(3, $vendedor['fone']);
    $stmt->bindParam(4, $vendedor['cidade']);
    $stmt->bindParam(5, $vendedor['estado']);
    $stmt->bindParam(6, $vendedor['nascimento']);
    $stmt->bindParam(7, $vendedor['funcao']);
    $stmt->bindParam(8, $vendedor['usuario']);
    $stmt->execute();
}

function alterarVendedor($vendedor){
    $conn = conexao();
    $stmt = $conn->prepare("UPDATE vendedor set nome = ?, endereco = ?, telefone = ?, cidadeid = ?, ".
                            "estadoid = ?, datanasc = ?, funcao = ?, usuarioid = ? WHERE vendedorid = ?;");
    $stmt->bindParam(1, $vendedor['nome'] );
    $stmt->bindParam(2, $vendedor['endereco']);
    $stmt->bindParam(3, $vendedor['fone']);
    $stmt->bindParam(4, $vendedor['cidade']);
    $stmt->bindParam(5, $vendedor['estado']);
    $stmt->bindParam(6, $vendedor['nascimento']);
    $stmt->bindParam(7, $vendedor['funcao']);
    $stmt->bindParam(8, $vendedor['usuario']);
    $stmt->bindParam(9, $vendedor['vendedorid']);
    $stmt->execute();
}

function localizarModelVendedor($nome) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT v.*, u.login FROM vendedor v, usuarios u WHERE usuarioid = idusuario and v.nome LIKE '%" . $nome . "%' ORDER BY vendedorid;");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirModelVendedor($id) {
    try {
        $conn = conexao();
        $stmt = $conn->prepare("DELETE FROM vendedor WHERE vendedorid = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        echo "<script language='javascript'> alert('Vendedor excluída com sucesso!') </script>";
    } catch (Exception $ex) {
        echo "<script language='javascript'> alert('Ocorreu um erro ao tentar excluir!') </script>";
    }
}

function localizarModelVendedorID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM vendedor WHERE vendedorid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
