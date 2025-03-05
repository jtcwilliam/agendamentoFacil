<?php



include_once '../classes/Unidade.php';
$objUnidade = new Unidade();

$unidades = $objUnidade->carregarTodasUnidades();

session_start();


if ($_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 4) {
    foreach ($unidades as $key => $value) {
?>

        <option value="<?= $value['idUnidade'] ?>"><?php echo $value['nomeUnidade']   ?></option>


    <?php
    }
} else {
    ?>
        <option value="<?= $_SESSION['usuarioLogado']['dados'][0]['idUnidade'] ?>"><?php echo  $_SESSION['usuarioLogado']['dados'][0]['nomeUnidade']   ?></option>

    <?php
}
