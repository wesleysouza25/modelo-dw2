<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/produto.php');

if (isset($_POST['descricao'])) {
    $produto['idproduto'] = filter_input(INPUT_POST, 'idproduto');
    $produto['descricao'] = filter_input(INPUT_POST, 'descricao');
    $produto['custo'] = filter_input(INPUT_POST, 'custo');
    $produto['venda'] = filter_input(INPUT_POST, 'venda');
    $produto['unidade'] = filter_input(INPUT_POST, 'unidade');
    $produto['marca'] = filter_input(INPUT_POST, 'marca');
}

$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$parametro = (isset($_GET['parametro'])) ? $_GET['parametro'] : '';
if ($acao == 'autocomplete') {
    $dados = localizarProduto($parametro);
    $json = json_encode($dados);
    echo $json;
} else if ($acao == 'consulta') {
    $dados = carregarProduto($parametro);
    $json = json_encode($dados);
    echo $json;
}

if (isset($_POST['gravar'])) {
    gravarProduto($produto);
    modalMessage("Cadastro de Produto", "Dados cadastrados com sucesso!", "../view/vproduto.php", "../view/principal.php");
} else
    if (isset($_POST['alterar'])) {
        alterarProduto($produto);
        modalMessage("Cadastro de Produto", "Dados alterados com sucesso!", "../view/vproduto.php", "../view/principal.php");
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarProduto($descricao) {
    return localizarModelProduto($descricao);
}

function carregarProduto($descricao) {
    return carregarModelProduto($descricao);
}

function excluirProduto($id) {
    excluirModelProduto($id);
}

function localizarProdutoID($id) {
    return localizarModelProdutoID($id);
}