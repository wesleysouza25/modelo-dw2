<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/vendedor.php');


if (isset($_POST['nome'])) {
    
    $vendedor['vendedorid'] = filter_input(INPUT_POST, 'vendedorid');
    $vendedor['nome'] = filter_input(INPUT_POST, 'nome');
    $vendedor['endereco'] = filter_input(INPUT_POST, 'endereco');
    $vendedor['cidade'] = filter_input(INPUT_POST, 'cidade');
    $vendedor['estado'] = filter_input(INPUT_POST, 'estado');
    $vendedor['fone'] = filter_input(INPUT_POST, 'fone');
    $vendedor['nascimento'] = filter_input(INPUT_POST, 'nascimento');
    $vendedor['usuario'] = filter_input(INPUT_POST, 'usuario');
    $vendedor['funcao'] = (filter_input(INPUT_POST, 'funcao') == 'on' ? 'vendedor' : NULL);
    
}

if (isset($_POST['gravar'])) {
    gravarVendedor($vendedor);
    modalMessage("Cadastro de vendedor", "Dados cadastrados com sucesso!", "../view/vvendedor.php", "../view/index.php");
} else
    if (isset($_POST['alterar'])) {
        alterarVendedor($vendedor);
        modalMessage("Cadastro de vendedor", "Dados alterados com sucesso!", "../view/vvendedor.php", "../view/index.php");
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarVendedor($nome) {
    return localizarModelVendedor($nome);
}

function excluirVendedor($id) {
     excluirModelVendedor($id);
}

function localizarVendedorID($id) {
    return localizarModelVendedorID($id);
}
