<?php



include_once '../classes/Datas.php';

$objDatas = new DatasAgendamento();



$comboHoras = $objDatas->trazerHorarios($_POST['dia']);


foreach ($comboHoras as $key => $value) {
?>

    <option value="<?= $value['idAgendamento'] ?>"><?php echo $value['dia'] .  ' às '.$value['hora'].'h00'   ?></option>


<?php
}
?>