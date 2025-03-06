<?php



include_once '../classes/Datas.php';

$objDatas = new DatasAgendamento();

if (isset($_POST['verificarHora'])) {

    $comboHoras = $objDatas->trazerHorarios($_POST['dia']);



    foreach ($comboHoras as $key => $value) { ?>

        <option value="<?= $value['idAgendamento'] ?>"><?php echo $value['dia'] .  ' às ' . $value['hora'] . 'h00'   ?></option>


<?php
    }
    exit();
}




if (isset($_POST['verificarDuasAgendas'])) {
    $comboHoras = $objDatas->verificarAgendamentoPrevio($_POST['idPessoa'], $_POST['idStatus']);

    $agendamentos = sizeof($comboHoras);

    if($agendamentos >= 2){
        echo  json_encode(array('retorno'=>false, 'dados'=>$comboHoras));
    }
}

?>