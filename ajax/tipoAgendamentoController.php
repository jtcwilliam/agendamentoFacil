<?php


include_once '../classes/TipoAgendamento.php';

$objTipoAgendamento = new TipoAgendamento();



$dadosTipoAgendamento = $objTipoAgendamento->carregartipoAgendamento();

 


foreach ($dadosTipoAgendamento['dados'] as $key => $value) {
?>

    <option value="<?= $value['idTipoAgendamento'] ?>"><?php echo $value['tipoAtendimento']   ?></option>


<?php
}
?>