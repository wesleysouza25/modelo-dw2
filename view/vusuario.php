<?php
    include_once('../controller/login.php');
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <script src="../config/js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <link href="../config/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <title>Modelo Projeto Integrador</title>
    </head>
    <body>
        <div class="container">
            <center><h2 class="alert alert-info header">Cadastro de Usuário</h2></center>
            <form action="../controller/login.php" method="POST">

                <?php
                if (isset($_REQUEST['id'])) {
                    $usuario = localizarUsuarioID($_REQUEST['id']);
                    ?>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label >Cod:</label>
                            <input type="text" name="idusuario" class="form-control" readonly value="<?php echo $usuario[0]['idusuario'] ?>" style="width:50px;"/><br/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">   
                            <label >Login:</label>
                            <input type="text" name="login" value="<?php echo $usuario[0]['login'] ?>" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">   
                            <label >Senha:</label>
                            <input type="password" name="senha" value="<?php echo $usuario[0]['senha'] ?>" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">   
                            <label >Nome:</label>
                            <input type="text" name="nome" value="<?php echo $usuario[0]['nome'] ?>" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-5">
                            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
                            <a href="principal.php" class="btn btn-primary">Principal</a>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label >Cod:</label>
                            <input type="text" name="idusuario" class="form-control" readonly  style="width:50px;"/><br/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label >Login:</label>
                            <input type="text" name="login" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label >Senha:</label>
                            <input type="password" name="senha" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label >Nome:</label>
                            <input type="text" name="nome" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-5">
                            <input type="submit" name="gravar" value="Gravar" class="btn btn-primary">
                            <a href="principal.php" class="btn btn-primary">Principal</a>
                            <a href="login.php" class="btn btn-primary">Login</a>
                        </div>
                    </div>
                    <?php
                }
                ?>


            </form>
        </div>
    </body>
</html>