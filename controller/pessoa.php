<?php

include_once('../config/conexao.php');
include_once('../config/util.php');
include_once('../model/pessoa.php');

if (isset($_POST['nome'])) {
    $pessoa['idpessoa'] = filter_input(INPUT_POST, 'idpessoa');
    $pessoa['nome'] = filter_input(INPUT_POST, 'nome');
    $pessoa['endereco'] = filter_input(INPUT_POST, 'endereco');
    $pessoa['cidade'] = filter_input(INPUT_POST, 'cidade');
    $pessoa['estado'] = filter_input(INPUT_POST, 'estado');
    $pessoa['fone'] = filter_input(INPUT_POST, 'fone');
    $pessoa['nascimento'] = filter_input(INPUT_POST, 'nascimento');
}

if (isset($_POST['gravar'])) {

    $pessoa['nome_imagem'] = $_FILES['imagem']['name'];
    $ultimo_id = gravarPessoa($pessoa);
    
    if ($ultimo_id) {
        //Recuperar último ID inserido no banco de dados
        //$ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../config/img/' . $ultimo_id . '/';
        $uploadfile = $diretorio . basename($_FILES['imagem']['name']);

        //Criar a pasta de foto 
        mkdir($diretorio, 0755);

        if (move_uploaded_file($_FILES['imagem']['tmp_name'],$uploadfile)) {
            modalMessage("Cadastro de cliente", "Dados salvos com sucesso e upload da imagem realizado com sucesso", "../view/vpessoa.php", "../view/principal.php");
        } else {
            modalMessage("Cadastro de cliente", "Dados cadastrados com sucesso!", "../view/vpessoa.php", "../view/principal.php");
        }
    } else {
        modalMessage("Cadastro de cliente", "Erro ao salvar cliente.", "../view/vpessoa.php", "../view/principal.php");
    }
} else
    if (isset($_POST['alterar'])) {
        $pessoa['nome_imagem'] = $_FILES['imagem']['name'];
        alterarPessoa($pessoa);
        
        //Diretório onde o arquivo vai ser salvo
        $diretorio = '../config/img/' . $pessoa['idpessoa'] . '/';
        $uploadfile = $diretorio . basename($_FILES['imagem']['name']);
        
        if(!is_dir($diretorio)){
            //Criar a pasta de foto 
            mkdir($diretorio, 0755);
        }

        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'],$uploadfile)) {
            modalMessage("Cadastro de cliente", "Dados alterados com sucesso e upload da imagem realizado com sucesso", "../view/vpessoa.php", "../view/principal.php");
        } else {
            modalMessage("Cadastro de cliente", "Dados alterados com sucesso!", "../view/vpessoa.php", "../view/principal.php");
        }
        
    }

/* --------------------------- FUNÇÕES ---------------------- */

function localizarPessoa($nome) {
    return localizarModelPessoa($nome);
}

function localizarListaPessoa() {
   return localizarListaModelPessoa();
}

function excluirPessoa($id) {
    excluirModelPessoa($id);
}

function localizarPessoaID($id) {
    return localizarModelPessoaID($id);
}

function localizarClientes() {
    return localizarModelClientes();
}

?>