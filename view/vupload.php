<?php
include_once('config/header.php');
?>

<center><h2 class="alert alert-info header">Upload de arquivo</h2></center>
<form enctype="multipart/form-data" action="controller/upload.php" method="POST">
    <div class="row">
        <div class="form-group col-md-5">
            <label >Cod:</label>
            <input type="text" name="marcaid" class="form-control" readonly  style="width:50px;"/><br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Foto</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
        </div>
    </div>


    <?php
    include_once('config/footer.php');
    ?>

</form>
</div>
