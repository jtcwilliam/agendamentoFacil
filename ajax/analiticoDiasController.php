<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento  = new Agendamento();




// esse controle serve para trazer os agendamentos da pessoa digitada (cpf ou cnpj)
if (isset($_POST['analiseDeDias'])) {

    $dadosAgendamento = $objAgendamento->verificarAgendamentoParaBaixaADM($_POST['envioDados']);

    $diaDeHoje = date('d/m/Y');


    $cor = '';
    $mensagem = 'Não Atender!';


    foreach ($dadosAgendamento as $key => $value) {

 

        if ($diaDeHoje == $value['dia']) {
            $cor = 'background-color:rgb(79, 212, 3)';
            $mensagem = 'Atendimento Permitido';
        } else {
            $cor = 'background-color:rgb(181, 182, 180)';
        }
?>

        <div class="   large-6 cell">
            <div class="button" style="width: 100%; text-align: left; border-radius: 10px;  <?=$cor?>  ; color: black; ">
                <p><b>Protocolo</b>: <?= $value['idAgendamento']   ?><br>
                    <b>Nome</b>: <?= $value['nomePessoa']   ?><br>
                    <b>Dia</b>: <?= $value['dia']   ?><br>
                    <b>Hora</b>: <?= $value['hora']   ?>
                    <h6><b>Aviso: <?=  $mensagem  ?> </b></h6>


                </p>
            </div>


            <div class="   large-6 cell">
                <a class=" button" style=" background-color:rgb(4, 29, 46); width: 100%;">Cancelar Atendimento</a>

                <a class=" button" style=" background-color:rgb(41, 77, 0); width: 100%;">Iniciar Atendimento</a>
            </div>


        </div>


<?php
        # code...
    }
}
