<?php
include_once('../config/header.php');
include_once('../controller/pedidoVenda.php');
include_once('../controller/pessoa.php');

if (isset($_REQUEST['id'])) {
    $codigo = $_REQUEST['id'];
    $pedido = localizarPedidoID($codigo);
}
?>
<script type="text/javascript">

    $(function () {

        // Atribui evento e função para limpeza dos campos
        $('#busca').on('input', limpaCampos);

        // Dispara o Autocomplete a partir do segundo caracter
        $("#busca").autocomplete({
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    url: "../controller/produto.php",
                    dataType: "json",
                    data: {
                        acao: 'autocomplete',
                        parametro: $('#busca').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            focus: function (event, ui) {
                $("#busca").val(ui.item.descricao);
                carregarDados();
                return false;
            },
            select: function (event, ui) {
                $("#busca").val(ui.item.descricao);
                $('#quantidade_produto').focus();
                $('#busca').val('');
                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<br><b>Produto: </b>" + item.descricao + " - <b> Valor: </b>" + item.venda + "</a><br>")
                    .appendTo(ul);
        };

        // Função para carregar os dados da consulta nos respectivos campos
        function carregarDados() {
            var busca = $('#busca').val();

            if (busca != "" && busca.length >= 2) {
                $.ajax({
                    url: "../controller/produto.php",
                    dataType: "json",
                    data: {
                        acao: 'consulta',
                        parametro: $('#busca').val()
                    },
                    success: function (data) {
                        $('#produtoid').val(data[0].produtoid);
                        $('#descricao_produto').val(data[0].descricao);
                        $('#valor_produto').val(data[0].venda);
                    }
                });
            }
        }

        // Função para limpar os campos caso a busca esteja vazia
        function limpaCampos() {
            var busca = $('#busca').val();

            if (busca == "") {
                $('#produtoid').val('');
                $('#descricao_produto').val('');
                $('#valor_produto').val('');
            }
        }
    });

</script>

<div class="row alert alert-info header">
    <div class="col-md-2">
        <figure>
            <img src="../config/img/carrinho.png" id="carrinho" alt="Carrinho de compra"/>
        </figure>
    </div>
    <div class="col-md-10">
        <h1 id="titulo_pedido" class="">Carrinho de compras</h1>
    </div>
</div>
<form action="../controller/pedidoVenda.php" method="POST">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-1">
                <label >Cod:</label>
                <input type="text" name="pedidoid" class="form-control" value="<?php echo $pedido[0]['pedidoid'] ?>" readonly  style="width:60px;"/>
            </div>
            <div class="col-md-3">
                <label>Data compra:</label>
                <input type="text"  name="nascimento" id="data" 
                       value="<?php
                       echo
                       substr($pedido[0]['datapedido'], 8, 2) .
                       substr($pedido[0]['datapedido'], 5, 2) .
                       substr($pedido[0]['datapedido'], 0, 4)
                       ?>"
                       class="form-control" />
            </div>
            <div class="col-md-8">
                <label>Cliente: </label>
                <select name="estado" class="form-control">
                    <option value="0">Selecione um cliente</option>
                    <?php
                    $pessoas = localizarClientes();
                    foreach ($pessoas as $key => $value) {
                        if ( $value['idpessoa'] == $pedido[0]['idpessoa'])
                            $sel = "Selected";
                        else
                            $sel = "";
                        echo "<option value=\"" . $value['idpessoa'] . "\"  " . $sel . "  >" . $value['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Produto:</label>
                <input type="text" class="form-control" id="busca" placeholder="Informe o nome do produto">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-1">
                <label >Cod:</label>
                <input type="text" name="produtoid" id="produtoid" class="form-control" readonly  style="width:60px;"/>
            </div>
            <div class="col-md-5">
                <label >Descrição:</label>
                <input type="text" name="descricao_produto" id="descricao_produto" class="form-control" readonly  />
            </div>
            <div class="col-md-2">
                <label >Valor:</label>
                <input type="text" name="valor_produto" id="valor_produto" class="form-control" readonly  />
            </div>
            <div class="col-md-2">
                <label >Quantidade:</label>
                <input type="text" name="quantidade_produto" id="quantidade_produto" class="form-control" style="width:60px;"/>
            </div>
            <div class="col-md-2">
                <input type="submit" name="gravar_item" value="Inserir item" class="btn btn-primary" style="margin-top: 20px;">
            </div>
        </div>
        <hr/>
        <table  class="table table-striped">
            <tr class="row">
                <th class="col-md-1">
                    <span><b>Cód.</b></span>			
                </th>	
                <th class="col-md-3">
                    <span><b>Produto</b></span>			
                </th>
                <th class="col-md-3">
                    <span><b>Quantidade</b></span>			
                </th>
                <th class="col-md-2">
                    <span><b>Valor</b></span>			
                </th>
                <th class="col-md-2">
                    <span><b>Subtotal</b></span>			
                </th>
                <th class="col-md-1">
                    <span></span>			
                </th>
            </tr>
            <?php
            $retorno = localizarItens($pedido[0]['pedidoid']);

            for ($i = 0; $i < count($retorno); $i++) {
                echo "<tr class='row'>";
                echo "	<td class='col-md-1'>";
                echo "		<span>" . $retorno[$i]['itemid'] . "</span>";
                echo "	</td>";
                echo "<td class='col-md-3'>";
                echo "		<span>" . $retorno[$i]['descricao'] . "</span>";
                echo "</td>";
                echo "<td class='col-md-3'>";
                echo "		<span>" . $retorno[$i]['quantidade'] . "</span>";
                echo "</td>";
                echo "<td class='col-md-2'>";
                echo "	<span>" . $retorno[$i]['valor'] . "</span>";
                echo "</td>";
                echo "<td class='col-md-2'>";
                echo "	<span>" . $retorno[$i]['subtotal'] . "</span>";
                echo "</td>";
                echo "<td class='col-md-1'>";
                echo "	<a href='controller/pedidoVenda.php?del=" . $pedido[0]['pedidoid'] . "&id=" . $retorno[$i]['itemid'] . "'>Excluir </a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div class="row">
            <div class="col-sm-3">
                <br/>
                <input type="submit" name="finalizar" value="Finalizar" class="btn btn-primary">
            </div>
            <div class="col-sm-6">
                &nbsp;
            </div>
            <div class="col-sm-3">
                <label>Total pedido:</label>
                <input type="text" name="total" class="form-control" value="<?php echo $pedido[0]['total'] ?>" readonly/>
            </div>
        </div>
    </div>
</form>
<?php
include_once('config/footer.php');
?>

</form>
</div>

