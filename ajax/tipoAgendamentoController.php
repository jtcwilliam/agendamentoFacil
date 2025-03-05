<?php


include_once '../classes/TipoAgendamento.php';

$objTipoAgendamento = new TipoAgendamento();



$dadosTipoAgendamento = $objTipoAgendamento->carregartipoAgendamento();

//print_r($dadosTipoAgendamento) ;


foreach ($dadosTipoAgendamento as $key => $value) {
?>

    <option value="<?= $value['idTipoAgendamento'] ?>"><?php echo $value['tipoAtendamento']   ?></option>


<?php
}
?>