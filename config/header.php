<?php
session_start();
if ($_SESSION['login'] == null) {
    header('location: login.php');
}

if (isset($_REQUEST['sair'])) {
    $_SESSION['login'] = null;
    header('location: login.php');
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        
        
        <link href="../config/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../config/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../config/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../config/css/jquery.modal.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="../config/css/estilo.css" rel="stylesheet" type="text/css"/>

        <script src="../config/js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../config/bootstrap-3.4.1-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../config/js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="../config/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../config/js/validator.js" type="text/javascript"></script>
        <script src="../config/js/jquery.modal.min.js" type="text/javascript"></script>
        
        <script>
            $(function () {
                $("#data").datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    nextText: 'Próximo',
                    prevText: 'Anterior'
                });
            });
            $(document).ready(function () {
                $('#data').mask('99/99/9999');
                $('#fone').mask('(99)99999-9999');
            });
        </script>

        <title>Modelo Projeto Integrador 2020</title>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Modelo projeto</h1>
            </center>
            <h3>Bem vindo <?php echo $_SESSION['funcao'] . ", " . $_SESSION['nome']; ?></h3>
            <div style="text-align: right;"> 
                <a href="?sair=1">Sair do sistema</a>
            </div>

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" 
                                data-toggle="collapse" 
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">IFSP</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php if ($_SESSION['funcao'] == 'vendedor') { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        Cadastro <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="vpessoa.php">Cliente</a></li>
                                        <li><a href="vmarca.php">Marca</a></li>
                                        <li><a href="vunidade.php">Unidade</a></li>
                                        <li><a href="vproduto.php">Produto</a></li>
                                        <li><a href="vvendedor.php">Vendedor</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="vusuario.php">Usuários</a></li>
                                        <li><a href="vestado.php">Estado</a></li>
                                        <li><a href="vcidade.php">Cidade</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="vimportarCSV.php">Importar Clientes CSV</a></li>
                                        <li><a href="vupload.php">Upload Foto</a></li>
                                    </ul>
                                </li>
                            <?php } else {?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        Cadastro <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="vpessoa.php">Cliente</a></li>
                                    </ul>
                                </li>
                            <?php }?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vendas <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="pedido_venda.php">Pedido de venda</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatórios <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php if ($_SESSION['funcao'] == 'vendedor') { ?>
                                        <li><a href="relCliente.php">Clientes</a></li>
                                        <li><a href="#">Produtos</a></li>
                                    <?php } ?>
                                    <li><a href="#">Vendas</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="nav navbar-form navbar-right">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Procurar">
                            </div>
                            <button type="submit" class="btn btn-default">Busca</button>
                        </form>
                    </div> 
                </div> 
            </nav>

           