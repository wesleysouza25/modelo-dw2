<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/unidade.php');

if (isset($_POST['descricao'])) {
    $unidade['unidadeid'] = filter_input(INPUT_POST, 'unidadeid');
    $unidade['descricao'] = filter_input(INPUT_POST, 'descricao');
}

if (isset($_POST['gravar'])) {
    gravarUnidade($unidade);
    modalMessage("Cadastro de unidade","Dados cadastrados com sucesso!","../view/vunidade.php","../view/principal.php");   
} else 
    if (isset($_POST['alterar'])) {
        alterarUnidade($unidade);
        modalMessage("Cadastro de Unidade","Dados alterados com sucesso!","../view/vunidade.php","../view/principal.php");      
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarUnidade($descricao) {
    return localizarModelUnidade($descricao);
}

function excluirUnidade($id) {
    excluirModelUnidade($id);
}

function localizarUnidadeID($id) {
    return localizarModelUnidadeID($id);
}

function carregarUnidade() {
    return carregarModelUnidade();
}