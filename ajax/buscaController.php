<?php



include_once '../classes/servicos.php';

$objservico = new servicosFacil();

$dados = $objservico->trazerServicos();

 echo  '<option    >     </option>';


foreach ($dados as $key => $value) {
    echo '<option value=' . $value['idLinks'] . '  >' . $value['nomeDoLink'] . '</option>';
}
