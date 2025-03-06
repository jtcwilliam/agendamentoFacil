<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento = new Agendamento();

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



    //aqui muda a quantidade de agendamentos permitidos
    if ($agendamentos >= 6) {
        echo  json_encode(array('retorno' => false, 'dados' => $comboHoras));
    }
}

if (isset($_POST['registrarAgendamento'])) {


    /*  registrarAgendamento:1,
                idUsuario:    $('#txtIdUsuario').val(),
                comboHorarios: $('#comboHorarios').val(),
                idUnidade:$('#unidade').val()*/

 
         


                
    $objAgendamento->setIdPessoas($_POST['idUsuario']);
    $objAgendamento->setIdStatus($_POST['idStatus']);
    $objAgendamento->setIdAgendamento($_POST['comboHorarios']);
    $objAgendamento->setIdUnidade($_POST['selectUnidade']);



    $objAgendamento->registrarAgendamentoUsuario();








    /*
        registrarAgendamento:1,
        idUsuario:    $('#txtIdUsuario').val(),
        comboHorarios: $('#comboHorarios').val()
        */

    exit();
}








//registrarAgendamento
?>