<?php
include_once('../config/header.php');
include_once('../controller/produto.php');
include_once('../controller/marca.php');
include_once('../controller/unidade.php');
?>
<center><h2 class="alert alert-info header">Cadastro de Produto</h2></center>
<form action="../controller/produto.php" method="POST">
    <?php
    if (isset($_REQUEST['id'])) {
        $produto = localizarProdutoID($_REQUEST['id']);
        ?>
        <div class="row">
            <div class="form-group col-md-5">
                <label >Cod:</label>
                <input type="text" name="idproduto" class="form-control" readonly  style="width:50px;" value="<?php echo $produto[0]['produtoid'] ?>"/><br/>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label >Descrição:</label>
                <input type="text" name="descricao" class="form-control" value="<?php echo $produto[0]['descricao'] ?>" />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3">
                <label>Custo:</label>
                <input type="text" name="custo" class="form-control" value="<?php echo $produto[0]['custo'] ?>"/>
            </div>
            <div class="col-md-3">
                <label>Venda:</label>
                <input type="text" name="venda" class="form-control" value="<?php echo $produto[0]['venda'] ?>"/>
            </div>
            <div class="col-md-3">
                <label>Unidade:</label>
                <div class=" input-group form-group">
                    <select name="unidade" class="form-control">
                        <?php
                        //carrega todos os estados gravados no banco
                        $unidades = carregarUnidade();
                        //Armazena estado que está gravado nesse cliente
                        if ($produto[0]['unidadeid'] != NULL)
                            $selecionado = localizarMarcaID($produto[0]['unidadeid']);
                        else
                            $selecionado = NULL;

                        echo "<option value='0'>Selecione</option>";
                        foreach ($unidades as $key => $value) {
                            if ($value['unidadeid'] != $selecionado[0]["unidadeid"])
                                echo "<option value=\"" . $value['unidadeid'] . "\">" . $value['descricao'] . "</option>";
                            else
                                echo "<option value=\"" . $value['unidadeid'] . "\" selected=\"selected\">" . $value['descricao'] . "</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadUnidade" href="vunidade.php"></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <label>Marca:</label>
                <div class=" input-group form-group">
                    <select name="marca" class="form-control">
                        <?php
                        //carrega todos os estados gravados no banco
                        $marcas = carregarMarca();
                        //Armazena estado que está gravado nesse cliente
                        if ($produto[0]['marcaid'] != NULL)
                            $selecionado = localizarMarcaID($produto[0]['marcaid']);
                        else
                            $selecionado = NULL;
                        echo "<option value='0'>Selecione</option>";
                        foreach ($marcas as $key => $value) {
                            if ($value['marcaid'] != $selecionado[0]["marcaid"])
                                echo "<option value=\"" . $value['marcaid'] . "\">" . $value['descricao'] . "</option>";
                            else
                                echo "<option value=\"" . $value['marcaid'] . "\" selected=\"selected\">" . $value['descricao'] . "</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadMarca" href="vmarca.php"></a></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
                <a href="tabProduto.php" class="btn btn-primary">Localizar</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="form-group col-md-5">
                <label >Cod:</label>
                <input type="text" name="idproduto" class="form-control" readonly  style="width:50px;"/><br/>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label >Descrição:</label>
                <input type="text" name="descricao" class="form-control" required/>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3">
                <label>Custo:</label>
                <input type="text" name="custo" class="form-control" />
            </div>
            <div class="col-md-3">
                <label>Venda:</label>
                <input type="text" name="venda" class="form-control" />
            </div>
            <div class="col-md-3">
                <label>Unidade:</label>
                <div class=" input-group form-group">
                    <select name="unidade" class="form-control">
                        <?php
                        //carrega todos os estados gravados no banco
                        $unidades = carregarUnidade();
                        echo "<option value='0'>Selecione</option>";
                        foreach ($unidades as $key => $value) {
                            echo "<option value=\"" . $value['unidadeid'] . "\">" . $value['descricao'] . "</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadUnidade" href="vunidade.php"></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <label>Marca:</label>
                <div class=" input-group form-group">
                    <select name="marca" class="form-control">
                        <?php
                        //carrega todos os estados gravados no banco
                        $marca = carregarMarca();
                        echo "<option value='0'>Selecione</option>";
                        foreach ($marca as $key => $value) {
                            echo "<option value=\"" . $value['marcaid'] . "\">" . $value['descricao'] . "</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadMarca" href="vmarca.php"></a></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
                <a href="tabProduto.php" class="btn btn-primary">Excluir</a>
                <a href="tabProduto.php" class="btn btn-primary">Localizar</a>
            </div>
        </div>

        <?php
    }
    include_once('../config/footer.php');
    ?>


</form>
</div>