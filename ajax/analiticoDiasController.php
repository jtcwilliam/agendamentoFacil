<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento  = new Agendamento();



//verificarAgendamentoParaBaixaADM


if (isset($_POST['analiseDeDias'])) {

    $dadosAgendamento = $objAgendamento->verificarAgendamentoParaBaixaADM($_POST['envioDados']);



    foreach ($dadosAgendamento as $key => $value) {
?>

        <div class="   large-6 cell" style="">
            <div class="button" style="width: 100%; text-align: left; border-radius: 10px; ">
                <p><b>Protocolo</b>: <?= $value['idAgendamento']   ?><br>
                    <b>Nome</b>: <?= $value['nomePessoa']   ?><br>
                    <b>Dia</b>: <?= $value['dia']   ?><br>
                    <b>Hora</b>: <?= $value['hora']   ?>
                    <br>
                </p>
            </div>


        </div>


<?php
        # code...
    }
}
