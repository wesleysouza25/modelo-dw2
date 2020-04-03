<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/usuario.php');


if (isset($_POST['login'])) {
    $usuario['login'] = filter_input(INPUT_POST, 'login');
    $usuario['senha'] = filter_input(INPUT_POST, 'senha');
    $usuario['nome'] = filter_input(INPUT_POST, 'nome');
}

if (isset($_POST['gravar'])) {
    gravarUsuario($usuario);
    modalMessage("Cadastro de Usuario", "Dados cadastrados com sucesso!", "../view/login.php", "../view/login.php");
} 
else 
    if (isset($_POST['cadastrar'])) {
        header('location:../view/vusuario.php');
    } else 
        if (isset($_POST['login-submit'])) {
            session_start();

            $res = login($usuario);

            if ($res != null) {
                //Gravando valores dentro da sessão aberta:
                $_SESSION['login'] = $res[0]['login'];
                $_SESSION['senha'] = $res[0]['senha'];
                $_SESSION['nome'] = $res[0]['nome'];
                $_SESSION['funcao'] = $res[0]['funcao'];
                $_SESSION['codigo'] = $res[0]['vendedorid'];

                header('location:../view/principal.php');
            } else
                header('location:../view/login.php');
        }

function localizarUsuarios() {
    return localizarModelUsuarios();
}

function localizarUsuarioID($id) {
    return localizarModelUsuarioID($id);
}