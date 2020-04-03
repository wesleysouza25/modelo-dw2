<?php

    include_once('../config/conexao.php');
    include_once('../config/util.php');
    include_once('../model/cidade.php');

if (isset($_POST['nome'])) {
    $cidade['cidadeid'] = filter_input(INPUT_POST, 'cidadeid');
    $cidade['estadoid'] = filter_input(INPUT_POST, 'estadoid');
    $cidade['nome'] = filter_input(INPUT_POST, 'nome');
    $cidade['ibge'] = filter_input(INPUT_POST, 'ibge');
}

if (isset($_POST['gravar'])) {
    gravarCidade($cidade);
    modalMessage("Cadastro de Cidade", "Dados cadastrados com sucesso!", "../view/vcidade.php", "../view/principal.php");
} else
    if (isset($_POST['alterar'])) {
        alterarCidade($cidade);
        modalMessage("Cadastro de Cidade", "Dados alterados com sucesso!", "../view/vcidade.php", "../view/principal.php");
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarCidade($descricao) {
    return localizarModelCidade($descricao);
}

function carregarCidade($uf) {
    return carregarModelCidade($uf);
}

function excluirCidade($id) {
    excluirModelCidade($id);
}

function localizarCidadeID($id) {
    return localizarModelCidadeID($id);
}
