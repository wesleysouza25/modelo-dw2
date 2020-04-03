<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/marca.php');

if (isset($_POST['descricao'])) {
    $marca['marcaid'] = filter_input(INPUT_POST, 'marcaid');
    $marca['descricao'] = filter_input(INPUT_POST, 'descricao');
}

if (isset($_POST['gravar'])) {
    gravarMarca($marca);
    modalMessage("Cadastro de Marca","Dados cadastrados com sucesso!","../view/vmarca.php","../view/principal.php");   
} else 
    if (isset($_POST['alterar'])) {
        alterarMarca($marca);
        modalMessage("Cadastro de Marca","Dados alterados com sucesso!","../view/vmarca.php","../view/principal.php");      
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarMarca($descricao) {
    return localizarModelMarca($descricao);
}

function excluirMarca($id) {
    excluirModelMarca($id);
}

function localizarMarcaID($id) {
    return localizarModelMarcaID($id);
}

function carregarMarca() {
    return carregarModelMarca();
}