<?php
    include_once('../config/header.php');
    include_once('../controller/vendedor.php');
 ?>
  	<br/>
	<form action="tabVendedor.php" method="POST" class="alert alert-info">
		<label style="margin-right: 10px;margin-left: 10px;"><b>Localizar por nome:</b></label><input type="text" name="pesquisa" style="width: 400px;">
		<input type="submit" value="Localizar">
	</form>
	<br/>
	<table  class="table table-striped">
		<tr class="row">
			<th class="col-md-1">
				<span><b>Cód.</b></span>			
			</th>	
			<th class="col-md-3">
				<span><b>Nome</b></span>			
			</th>
			<th class="col-md-3">
				<span><b>Função</b></span>			
			</th>
			<th class="col-md-2">
				<span><b>Login</b></span>			
			</th>
			<th class="col-md-3">
				&nbsp;
			</th>
		</tr>
		<?php 
		    if (isset( $_POST['pesquisa'])){
			    $retorno = localizarVendedor( $_POST['pesquisa']);

			    for($i = 0; $i < count($retorno); $i++){
					echo "<tr class='row'>";
					echo "	<td class='col-md-1'>";
					echo "		<span>".$retorno[$i]['vendedorid']."</span>";
					echo "	</td>";
					echo "<td class='col-md-3'>";
					echo "		<span>".$retorno[$i]['nome']."</span>";			
					echo "</td>";
					echo "<td class='col-md-3'>";
					echo "		<span>".$retorno[$i]['funcao']."</span>";
					echo "</td>";
					echo "<td class='col-md-2'>";
					echo "	<span>".$retorno[$i]['login']."</span>";
					echo "</td>";
					echo "<td class='col-md-3'>";
					echo "	<a href='?acao=del&id=".$retorno[$i]['vendedorid']."'>Excluir </a>|<a href='?acao=alt&id=".$retorno[$i]['vendedorid']."'> Alterar</a>";
					echo "</td>";
					echo "</tr>";
				}
			}
		?>
	</table>
	<br/>
	<a href='vvendedor.php' class='alert alert-info'>Voltar ao cadastro</a>
<?php
    include_once('../config/footer.php');

    if (isset($_REQUEST['acao'])){
	    if ($_REQUEST['acao'] == "del"){
                excluirVendedor($_REQUEST['id']);
			echo " <script>document.location.href='tabVendedor.php'</script>";
		}
		else if ($_REQUEST['acao'] == "alt"){
			echo "<script>document.location.href='vvendedor.php?id=".$_REQUEST['id']."'</script>";
		}
	}
 ?>