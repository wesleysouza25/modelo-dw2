<?php
include_once('../config/header.php');
include_once('../controller/unidade.php');
?>

<center><h2 class="alert alert-info header">Cadastro de Unidade</h2></center>
<form action="../controller/unidade.php" method="POST">

    <?php
    if (isset($_REQUEST['id'])) {
        $unidade = localizarUnidadeID($_REQUEST['id']);
        ?>
        <div class="row">
            <div class="form-group col-md-5">
                <label >Cod:</label>
                <input type="text" name="marcaid" class="form-control" readonly value="<?php echo $unidade[0]['unidadeid'] ?>" style="width:50px;"/><br/>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">   
                <label >Descrição:</label>
                <input type="text" name="descricao" value="<?php echo $unidade[0]['descricao'] ?>" class="form-control" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-5">
                <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
                <a href="tabUnidade.php" class="btn btn-primary">Localizar</a>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="row">
        <div class="form-group col-md-5">
            <label >Cod:</label>
            <input type="text" name="marcaid" class="form-control" readonly  style="width:50px;"/><br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <label >Descrição:</label>
            <input type="text" name="descricao" class="form-control" required/>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-5">
            <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
            <a href="tabUnidade.php" class="btn btn-primary">Excluir</a>
            <a href="tabUnidade.php" class="btn btn-primary">Localizar</a>
        </div>
    </div>


    <?php
}
include_once('../config/footer.php');
?>

</form>
</div>
