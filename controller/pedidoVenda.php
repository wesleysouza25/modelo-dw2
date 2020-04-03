<?php

include_once('../config/conexao.php');

if (isset($_POST['gravar'])) {
    include_once('../config/util.php');

    if (($_POST['cliente'] == NULL) || ($_POST['cliente'] == 0))
        modalMessage("Pedido de venda", "Informe a CLIENTE para prosseguir!", "../view/pedido_venda.php", "../index.php");
    else if ($_POST['quantidade_produto'] == NULL){
        modalMessage("Pedido de venda", "Informe a QUANTIDADE VENDIDA para prosseguir!", "../view/pedido_venda.php", "../index.php");
        
    } else {
        session_start();
        
        $data = $_POST['data'];
        $pessoa = $_POST['cliente'];
        $vendedor = $_SESSION['codigo'];

        $produto = $_POST['produtoid'];
        $qtd = $_POST['quantidade_produto'];
        $valor = $_POST['valor_produto'];

        $conn = conexao();
        $stmt = $conn->prepare("INSERT INTO pedido (datapedido, idpessoa, vendedorid) values (?,?,?);");
        $stmt->bindParam(1, $data);
        $stmt->bindParam(2, $pessoa);
        $stmt->bindParam(3, $vendedor);
        $stmt->execute();

        $ultimoPedido = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO item (produtoid, pedidoid, quantidade, valor) values (?,?,?,?);");
        $stmt->bindParam(1, $produto);
        $stmt->bindParam(2, $ultimoPedido);
        $stmt->bindParam(3, $qtd);
        $stmt->bindParam(4, $valor);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE pedido p set "
                             . "total = (select sum(valor*quantidade) as total "
                                           . "from item i where i.pedidoid = p.pedidoid) "
                                           . "where pedidoid =" . $ultimoPedido . ";");
        $stmt->execute();

        header('location: ../view/pedido_venda_salvo.php?id=' . $ultimoPedido);
    }
} else if (isset($_POST['gravar_item'])) {
    include_once('../config/util.php'); 
    
    $codigo_pedido = $_POST['pedidoid'];
     
    if ($_POST['quantidade_produto'] == NULL)
        modalMessage("Pedido de venda", "Informe a quantidade para prosseguir!", "../view/pedido_venda_salvo.php?id=" . $codigo_pedido, "../index.php");
    else {
        $codigo_produto = $_POST['produtoid'];
        $qtd = $_POST['quantidade_produto'];

        $conn = conexao();
        $stmt = $conn->prepare("SELECT * FROM produto where produtoid = " . $codigo_produto . ";");
        $stmt->execute();

        $produto = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $valor_produto = $produto[0]['venda'];

        $stmt = $conn->prepare("INSERT INTO item (produtoid, pedidoid, quantidade, valor) values (?,?,?,?);");
        $stmt->bindParam(1, $codigo_produto);
        $stmt->bindParam(2, $codigo_pedido);
        $stmt->bindParam(3, $qtd);
        $stmt->bindParam(4, $valor_produto);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE pedido p set total = (select sum(valor*quantidade) as total from item i where i.pedidoid = p.pedidoid) where pedidoid =" . $codigo_pedido . ";");
        $stmt->execute();

        header('location: ../view/pedido_venda_salvo.php?id=' . $codigo_pedido);
    }
} else if (isset($_REQUEST['del'])) {
    $codigo = $_REQUEST['id'];
    $pedido = $_REQUEST['del'];
    excluirItem($codigo, $pedido);
    header('location: ../view/pedido_venda_salvo.php?id=' . $pedido);
} else if (isset($_POST['finalizar'])) {
    header('location: ../view/pedido_venda.php');
}

/* * ****************************************************************** */
/*               FUNÇÕES REFERENTE AO PEDIDO DE VENDA                  */
/* * ****************************************************************** */

function localizarPedidoID($id) {
    include_once('../config/conexao.php');

    $conn = conexao();
    $stmt = $conn->prepare("SELECT * FROM pedido WHERE pedidoid =" . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function localizarItens($id) {
    include_once('../config/conexao.php');

    $conn = conexao();
    $stmt = $conn->prepare("select i.itemid, p.descricao, i.quantidade, i.valor, (i.quantidade * i.valor) as subtotal from item i, produto p where i.produtoid = p.produtoid and i.pedidoid = " . $id . ";");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirItem($id, $pedido) {
    include_once('../config/conexao.php');

    $conn = conexao();
    $stmt = $conn->prepare("DELETE FROM item WHERE itemid = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE pedido p set total = (select sum(valor*quantidade) as total from item i where i.pedidoid = p.pedidoid) where pedidoid = " . $pedido . ";");
    $stmt->execute();
}

?>