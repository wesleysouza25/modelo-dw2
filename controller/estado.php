<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/estado.php');

if (isset($_POST['sigla'])) {
    $estado['estadoid'] = filter_input(INPUT_POST, 'estadoid');
    $estado['sigla'] = filter_input(INPUT_POST, 'sigla');
    $estado['descricao'] = filter_input(INPUT_POST, 'descricao');
}

if (isset($_POST['gravar'])) {
    gravarEstado($estado);
    modalMessage("Cadastro de estado", "Dados cadastrados com sucesso!", "../view/vestado.php", "../view/principal.php");
} else
    if (isset($_POST['alterar'])) {
        alterarEstado($estado);
        modalMessage("Cadastro de estado", "Dados alterados com sucesso!", "../view/vestado.php", "../view/index.php");
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarEstado($descricao) {
    return localizarModelEstado($descricao);
}

function excluirEstado($id) {
    excluirModelEstado($id);
}

function localizarUF() {
    return localizarModelUF();
}

function retornaUFID($id) {
    return retornaModelUFID($id);
}

