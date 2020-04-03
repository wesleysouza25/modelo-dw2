<?php

include_once('../config/conexao.php');
include_once('../config/util.php');


function gravarUsuario($usuario){
    $conn = conexao();
    $stmt = $conn->prepare("insert into usuarios (login, senha, nome) values (?,?,?)");
    $stmt->bindParam(1, $usuario['login']);
    $stmt->bindParam(2, $usuario['login']);
    $stmt->bindParam(3, $usuario['nome']);
    $stmt->execute();
}

function login($usuario){
    $conn = conexao();

    $stmt = $conn->prepare("SELECT u.*, v.funcao, v.vendedorid ".
            " FROM usuarios u left outer join vendedor v on v.usuarioid = u.idusuario ".
            " WHERE login = ? and senha = ?");
    
    $stmt->bindParam(1, $usuario['login']);
    $stmt->bindParam(2, $usuario['senha']);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function localizarModelUsuarios() {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM usuarios");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function localizarModelUsuarioID($id) {

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE idusuario =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
