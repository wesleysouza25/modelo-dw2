<?php
include_once('../config/header.php');
include_once('../controller/vendedor.php');
include_once('../controller/estado.php');
include_once('../controller/cidade.php');
include_once('../controller/login.php');
?>
<script type="text/javascript">

    $(document).ready(function () {

        $("select[name=estado]").change(function () {
            $("select[name=cidade]").html('<option value="0">Carregando...</option>');

            $.post("../controller/comboCidade.php",
                    {estado: $(this).val()},
                    function (valor) {
                        $("select[name=cidade]").html(valor);
                    }
            )

        })
    })

</script>
<center><h2 class="alert alert-info header">Cadastro de Vendedor</h2></center>
<form action="../controller/vendedor.php" method="POST">

    <?php
    if (isset($_REQUEST['id'])) {
        $vendedor = localizarVendedorID($_REQUEST['id']);
        ?>
        <div class="row">
            <div class="form-group col-md-5">
                <label >Cod:</label>
                <input type="text" name="vendedorid" class="form-control" readonly value="<?php echo $vendedor[0]['vendedorid'] ?>" style="width:50px;"/><br/>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">   
                <label >Nome:</label>
                <input type="text" name="nome" value="<?php echo $vendedor[0]['nome'] ?>" class="form-control" required/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Endereço:</label>
                <input type="text" name="endereco" value="<?php echo $vendedor[0]['endereco'] ?>" class="form-control" />
            </div>

            <div class="col-md-2">
                <label>UF:</label>
                <select name="estado" class="form-control">
                    <option value="0">Escolha um Estado</option>
                    <?php
                    //carrega todos os estados gravados no banco
                    $estados = localizarUF();
                    //Armazena estado que está gravado nesse cliente
                    if ($vendedor[0]['estadoid'] != NULL)
                        $selecionado = retornaUFID($vendedor[0]['estadoid']);
                    else
                        echo "<option value='0'>Escolha um Estado</option>";

                    foreach ($estados as $key => $value) {
                        if ($value['estadoid'] != $selecionado[0]["estadoid"])
                            echo "<option value=\"" . $value['estadoid'] . "\">" . $value['sigla'] . "</option>";
                        else
                            echo "<option value=\"" . $value['estadoid'] . "\" selected=\"selected\">" . $value['sigla'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label>Cidade:</label>
                <select name="cidade" name="cidade" class="form-control" >

                    <?php
                    //carrega todos os estados gravados no banco
                    if ($vendedor[0]['estadoid'] != NULL)
                        $cidades = carregarCidade($vendedor[0]['estadoid']);
                    //Armazena estado que está gravado nesse cliente
                    if ($vendedor[0]['cidadeid'] != NULL) {
                        $selecionado = localizarCidadeID($vendedor[0]['cidadeid']);
                    }

                    foreach ($cidades as $key => $value) {
                        if ($value['cidadeid'] != $selecionado[0]["cidadeid"])
                            echo "<option value=\"" . $value['cidadeid'] . "\">" . $value['nome'] . "</option>";
                        else
                            echo "<option value=\"" . $selecionado[0]['cidadeid'] . "\" selected=\"selected\">" . $selecionado[0]['nome'] . "</option>";
                    }
                    ?>
                </select>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Data nasc:</label>
                <input type="text" name="nascimento" id="data" value="<?php
                echo
                substr($vendedor[0]['datanasc'], 8, 2) .
                substr($vendedor[0]['datanasc'], 5, 2) .
                substr($vendedor[0]['datanasc'], 0, 4)
                ?>" class="form-control" />
            </div>
            <div class="form-group col-md-3">
                <label>Fone:</label>
                <input type="text" name="fone" id="fone" value="<?php echo $vendedor[0]['telefone'] ?>" class="form-control" />
            </div>
            <div class="form-group col-md-3">
                <label>Função:</label>

                <div class="row">
                    <div class="col-md-2">
                        <?php
                        $check = '';
                        if ($vendedor[0]['funcao'] == 'vendedor') {
                            $check = 'checked';
                        }
                        ?>
                        <input type="checkbox" name="funcao" id="funcao" class="form-control" <?php echo $check ?> />

                    </div>
                    <div class="col-md-2" style="margin-top: 10px; margin-left: -20px;">
                        <label for="funcao">Vendedor</label>   
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>Usuario:</label>
                <div class=" input-group form-group">
                    <select name="usuario" class="form-control">
                        <option value="0">Escolha um login</option>
                        <?php
                        //carrega todos os estados gravados no banco
                        $usuarios = localizarUsuarios();
                        //Armazena estado que está gravado nesse cliente
                        if ($vendedor[0]['usuarioid'] != NULL)
                            $selecionado = localizarUsuarioID($vendedor[0]['usuarioid']);
                        else
                            echo "<option value='0'>Escolha um login</option>";

                        foreach ($usuarios as $key => $value) {
                            if ($value['idusuario'] != $selecionado[0]["idusuario"])
                                echo "<option value=\"" . $value['idusuario'] . "\">" . $value['login'] . "</option>";
                            else
                                echo "<option value=\"" . $value['idusuario'] . "\" selected=\"selected\">" . $value['login'] . "</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadUnidade" href="vusuario.php"></a></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="row">
        <div class="form-group col-md-5">
            <label >Cod:</label>
            <input type="text" name="vendedorid" class="form-control" readonly  style="width:50px;"/><br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <label >Nome:</label>
            <input type="text" name="nome" class="form-control" required/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <label>Endereço:</label>
            <input type="text" name="endereco" class="form-control" />
        </div>

        <div class="col-md-2">
            <label>Estado:</label>
            <select name="estado" class="form-control">
                <option value="0">Escolha um Estado</option>
                <?php
                $estados = localizarUF();
                foreach ($estados as $key => $value) {
                    echo "<option value=\"" . $value['estadoid'] . "\">" . $value['sigla'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Cidade:</label>
            <select name="cidade" name="cidade" class="form-control" >
                <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Data nasc:</label>
            <input type="text" name="nascimento" id="data" class="form-control" />
        </div>
        <div class="form-group col-md-3">
            <label>Fone:</label>
            <input type="text" name="fone" id="fone" class="form-control" />
        </div>
        <div class="form-group col-md-3">
            <label>Função:</label>
            <div class="row">
                <div class="col-md-2">
                    <input type="checkbox" name="funcao" id="funcao" class="form-control" />
                </div>
                <div class="col-md-2" style="margin-top: 10px; margin-left: -20px;">
                    <label for="funcao">Vendedor</label>   
                </div>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label>Usuario:</label>
            <div class=" input-group form-group">
                <select name="usuario" class="form-control">
                    <option value="0">Escolha um login</option>
                    <?php
                    $usuarios = localizarUsuarios();
                    foreach ($usuarios as $key => $value) {
                        echo "<option value=\"" . $value['idusuario'] . "\">" . $value['login'] . "</option>";
                    }
                    ?>
                </select>
                <span class="input-group-addon"><a class="glyphicon glyphicon-plus" id="cadUnidade" href="vusuario.php"></a></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-5">
            <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
            <a href="tabVendedor.php" class="btn btn-primary">Excluir</a>
            <a href="tabVendedor.php" class="btn btn-primary">Localizar</a>
        </div>
    </div>


    <?php
}
include_once('../config/footer.php');
?>

</form>
</div>
