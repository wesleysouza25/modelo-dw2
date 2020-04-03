<?php
include_once('../config/header.php');
include_once('../controller/pessoa.php');
include_once('../controller/estado.php');
include_once('../controller/cidade.php');
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
<center><h2 class="alert alert-info header">Cadastro de Pessoas</h2></center>
<form data-toggle="validator" 
      role="form" 
      action="../controller/pessoa.php" 
      enctype="multipart/form-data" 
      method="POST" >

    <?php
    if (isset($_REQUEST['id'])) {
        $pessoa = localizarPessoaID($_REQUEST['id']);
        ?>
        <div class="row">
            <div class="form-group col-md-5">
                <figure>
                    <img src="../config/img/<?php echo $pessoa[0]['idpessoa'] . '/' . $pessoa[0]['caminhofoto'] ?>" height="200" />
                </figure>
            </div>
            
        </div>

        <div class="row">
            <div class="form-group col-md-1">
                <label >Cod:</label>
                <input type="text" name="idpessoa" class="form-control" readonly value="<?php echo $pessoa[0]['idpessoa'] ?>" style="width:80px;"/><br/>
            </div>
            <div class="form-group col-md-11">   
                <label >Nome:</label>
                <input type="text" name="nome" value="<?php echo $pessoa[0]['nome'] ?>" class="form-control" required/>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Endereço:</label>
                <input type="text" name="endereco" value="<?php echo $pessoa[0]['endereco'] ?>" class="form-control" />
            </div>

            <div class="col-md-2">
                <label>UF:</label>
                <select name="estado" class="form-control">
                    <option value="0">Escolha um Estado</option>
                    <?php
                    //carrega todos os estados gravados no banco
                    $estados = localizarUF();
                    //Armazena estado que está gravado nesse cliente
                    if ($pessoa[0]['estadoid'] != NULL)
                        $selecionado = retornaUFID($pessoa[0]['estadoid']);
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
                <?php
//                if ($pessoa[0]['cidadeid'] != NULL)
//                    print_r(localizarCidadeID($pessoa[0]['cidadeid']));
                ?>
                <select name="cidade" name="cidade" class="form-control" >

                    <?php
                    //carrega todos os estados gravados no banco
                    if ($pessoa[0]['estadoid'] != NULL)
                        $cidades = carregarCidade($pessoa[0]['estadoid']);
                    //Armazena estado que está gravado nesse cliente
                    if ($pessoa[0]['cidadeid'] != NULL) {
                        $selecionado = localizarCidadeID($pessoa[0]['cidadeid']);
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
                substr($pessoa[0]['datanasc'], 8, 2) .
                substr($pessoa[0]['datanasc'], 5, 2) .
                substr($pessoa[0]['datanasc'], 0, 4)
                ?>" class="form-control" />
            </div>
            <div class="form-group col-md-3">
                <label>Fone:</label>
                <input type="text" name="fone" id="fone" value="<?php echo $pessoa[0]['telefone'] ?>" class="form-control" />
            </div>
            <div class="form-group col-md-3">
                <label>Foto</label>
                <input type="file" name="imagem" id="imagem" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
                <a href="tabPessoa.php" class="btn btn-primary">Localizar</a>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="row">
        <div class="form-group col-md-5">
            <label >Cod:</label>
            <input type="text" name="idpessoa" class="form-control" readonly  style="width:50px;"/><br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <label class="control-label">Nome:</label>
            <input type="text" name="nome" 
                   class="form-control" required/>
            <div class="help-block with-errors"></div>
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
    <?php if ($_SESSION['funcao'] == 'vendedor') { ?>
        <div class="row">
            <div class="form-group col-md-3">
                <label>Data nasc:</label>
                <input type="text"  name="nascimento" id="data" class="form-control" />
            </div>
            <div class="form-group col-md-3">

                <label>Fone:</label>
                <input type="text"  name="fone" id="fone" class="form-control" />

            </div>
            <div class="form-group col-md-3">
                <label>Foto</label>
                <input type="file" 
                       name="imagem" 
                       id="imagem" 
                       class="form-control">
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="form-group col-md-5">
            <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
            <a href="tabPessoa.php" class="btn btn-primary">Excluir</a>
            <a href="tabPessoa.php" class="btn btn-primary">Localizar</a>
        </div>
    </div>


    <?php
}
include_once('../config/footer.php');
?>

</form>
</div>
