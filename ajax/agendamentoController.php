<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento = new Agendamento();

$objDatas = new DatasAgendamento();


if (isset($_POST['verificarAgendamentosAtivos'])) {

    $agendamentos = $objAgendamento->verificarAgendamentosAtivos($_POST['idPessoa'], $_POST['idStatus']);


    $qtdeAgendamentos =  sizeof($agendamentos);
 
    $agendamentosAntigos = '';

    foreach ($agendamentos as $key => $value) 
    {
        $agendamentosAntigos.=  "<div class='small-12 cell large-12'> <label> <b>Protocolo: </b>". $value['idAgendamento']."<br> <b> Dia e Hora: </b>".$value['dia']. "  às ". $value['hora']. "h00 no <b>". $value['nomeUnidade']. "</b></label>   <hr> </div> ";
    }

    echo  json_encode(array( 'qtdeAgendamentos'=>$qtdeAgendamentos   , 'agendamentoAntigo'=>$agendamentosAntigos, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE ));




    exit();
}

if (isset($_POST['verificarHora'])) {

    $comboHoras = $objDatas->trazerHorarios($_POST['dia']);



    foreach ($comboHoras as $key => $value) { ?>

        <option value="<?= $value['idAgendamento'] ?>"><?php echo $value['dia'] .  ' às ' . $value['hora'] . 'h00'   ?></option>


<?php
    }
    exit();
}


if (isset($_POST['registrarAgendamento'])) {







    $objAgendamento->setIdPessoas($_POST['idUsuario']);
    $objAgendamento->setIdStatus($_POST['idStatus']);
    $objAgendamento->setIdAgendamento($_POST['comboHorarios']);
    $objAgendamento->setIdUnidade($_POST['selectUnidade']);



    if ($objAgendamento->registrarAgendamentoUsuario()) {
        echo json_encode(array('retorno' => true));
    }








    /*
        registrarAgendamento:1,
        idUsuario:    $('#txtIdUsuario').val(),
        comboHorarios: $('#comboHorarios').val()
        */

    exit();
}








//registrarAgendamento
?>