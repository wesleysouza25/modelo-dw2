<?php
    include_once('../config/header.php');
    include_once('../controller/marca.php');
 ?>
  	<br/>
	<form action="tabMarca.php" method="POST" class="alert alert-info">
		<label style="margin-right: 10px;margin-left: 10px;"><b>Localizar por descrição:</b></label><input type="text" name="pesquisa" style="width: 400px;">
		<input type="submit" value="Localizar">
	</form>
	<br/>
	<table  class="table table-striped">
		<tr class="row">
			<th class="col-md-1">
				<span><b>Cód.</b></span>			
			</th>	
			<th class="col-md-3">
				<span><b>Descrição</b></span>			
			</th>
			<th class="col-md-3">
				&nbsp;
			</th>
		</tr>
		<?php 
		    if (isset( $_POST['pesquisa'])){
			    $retorno = localizarMarca( $_POST['pesquisa']);

			    for($i = 0; $i < count($retorno); $i++){
					echo "<tr class='row'>";
					echo "	<td class='col-md-1'>";
					echo "		<span>".$retorno[$i]['marcaid']."</span>";
					echo "	</td>";
					echo "<td class='col-md-3'>";
					echo "		<span>".$retorno[$i]['descricao']."</span>";			
					echo "</td>";
					
                                        echo "<td class='col-md-3'>";
					echo "	<a href='?acao=del&id=".$retorno[$i]['marcaid']."'>Excluir </a>|<a href='?acao=alt&id=".$retorno[$i]['marcaid']."'> Alterar</a>";
					echo "</td>";
					echo "</tr>";
				}
			}
		?>
	</table>
	<br/>
	<a href='vmarca.php' class='alert alert-info'>Voltar ao cadastro</a>
<?php
    include_once('../config/footer.php');

    if (isset($_REQUEST['acao'])){
	    if ($_REQUEST['acao'] == "del"){
	    	excluirMarca($_REQUEST['id']);
			echo " <script>document.location.href='tabMarca.php'</script>";
		}
		else if ($_REQUEST['acao'] == "alt"){
			echo "<script>document.location.href='vmarca.php?id=".$_REQUEST['id']."'</script>";
		}
	}
 ?>