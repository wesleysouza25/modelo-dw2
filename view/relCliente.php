<?php
include_once('config/header.php');
include_once('controller/pessoa.php');
?>


<?php
include_once('controller/pessoa.php');
    $retorno = localizarListaPessoa();
    $i = 0;
    //for($i = 0; $i < count($retorno); $i++){
    while ($i < count($retorno)){
            echo "<div class='row'>";

            echo "   <div class='col-sm-6 col-md-4'>";
            echo "        <div class='thumbnail' style='height:300px;'>";
            echo "            <img src='img/".$retorno[$i]['idpessoa']."/".$retorno[$i]['caminhofoto']."' alt='Foto cliente' width=100>";
            echo "            <div class='caption'>";
            echo "                <h3>".$retorno[$i]['nome']."</h3>";
            echo "                <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
            echo "                <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
            echo "                <p><a href='#ex".$retorno[$i]['idpessoa']."' class='btn btn-primary' role='button' rel='modal:open'>Detalhes</a></p> ";
            echo "            </div>";
            echo "        </div>";
            echo "    </div>";

            echo "<div id='ex".$retorno[$i]['idpessoa']."' class='modal'>";
            echo "   <p><b>Nome: </b>".$retorno[$i]['nome']."</p>";
            echo "   <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
            echo "   <p><b>Cidade:</b>".$retorno[$i]['cidade']." - ".$retorno[$i]['estado']."</p>";
            echo "   <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
            echo "   <p><b>Data Nasc: </b>".$retorno[$i]['datanasc']."</p>";
            echo "</div>";
            
            $i = $i + 1;
            
            
            
            

            if ($i < count($retorno)){
                echo "   <div class='col-sm-6 col-md-4'>";
                echo "        <div class='thumbnail'style='height:300px;'>";
                echo "            <img src='img/".$retorno[$i]['idpessoa']."/".$retorno[$i]['caminhofoto']."' alt='Foto cliente' width=100>";
                echo "            <div class='caption'>";
                echo "                <h3>".$retorno[$i]['nome']."</h3>";
                echo "                <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
                echo "                <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
                echo "                <p><a href='#ex".$retorno[$i]['idpessoa']."' class='btn btn-primary' role='button' rel='modal:open'>Detalhes</a></p> ";
                echo "            </div>";
                echo "        </div>";
                echo "    </div>";
                
                echo "<div id='ex".$retorno[$i]['idpessoa']."' class='modal'>";
                echo "   <p><b>Nome: </b>".$retorno[$i]['nome']."</p>";
                echo "   <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
                echo "   <p><b>Cidade:</b>".$retorno[$i]['cidade']." - ".$retorno[$i]['estado']."</p>";
                echo "   <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
                echo "   <p><b>Data Nasc: </b>".$retorno[$i]['datanasc']."</p>";
                echo "</div>";
            
            }

            
             $i = $i + 1;

            if ($i < count($retorno)){
                echo "   <div class='col-sm-6 col-md-4'>";
                echo "        <div class='thumbnail' style='height:300px;'>";
                echo "            <img src='img/".$retorno[$i]['idpessoa']."/".$retorno[$i]['caminhofoto']."' alt='Foto cliente' width=100>";
                echo "            <div class='caption'>";
                echo "                <h3>".$retorno[$i]['nome']."</h3>";
                echo "                <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
                echo "                <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
                echo "                <p><a href='#ex".$retorno[$i]['idpessoa']."' class='btn btn-primary' role='button' rel='modal:open'>Detalhes</a></p> ";
                echo "            </div>";
                echo "        </div>";
                echo "    </div>";
                
                echo "<div id='ex".$retorno[$i]['idpessoa']."' class='modal'>";
                echo "   <p><b>Nome: </b>".$retorno[$i]['nome']."</p>";
                echo "   <p><b>Endereço: </b>".$retorno[$i]['endereco']."</p>";
                echo "   <p><b>Cidade:</b>".$retorno[$i]['cidade']." - ".$retorno[$i]['estado']."</p>";
                echo "   <p><b>Telefone: </b>".$retorno[$i]['telefone']."</p>";
                echo "   <p><b>Data Nasc: </b>".$retorno[$i]['datanasc']."</p>";
                echo "</div>";
            }
            
            
            
            $i = $i + 1;
            echo "</div>";
    }
    

?>


<br/>
<a href='vpessoa.php' class='alert alert-info'>Voltar ao cadastro</a>
<?php
include_once('config/footer.php');
?>