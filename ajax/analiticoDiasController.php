<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento  = new Agendamento();




// esse controle serve para trazer os agendamentos da pessoa digitada (cpf ou cnpj)
if (isset($_POST['analiseDeDias_pesquisa'])) {



    $dadosAgendamento = $objAgendamento->verificarAgendamentoParaBaixaADM_pesquisa($_POST['docPessoa'], $_POST['idAgendamento']);

    $diaDeHoje = date('d/m/Y');


    $cor = '';
    $mensagem = 'Não Atender!';

    $tamanho = sizeof($dadosAgendamento);

    if ($tamanho == 0) {
?>

        <div class="   large-12 cell">
            <center>
                <h5>Não há agendamentos para este documento</h5>
            </center>
        </div>


    <?php

    }


    foreach ($dadosAgendamento as $key => $value) {




        $cor = 'background-color:rgb(79, 212, 3)';
        $corTexto = ' color: black;';
        $mensagem = 'Atendimento Permitido';

    ?>
        <div class="grid-x grid-padding-x"  >
            <div class="   large-12 cell">
                <h3 style="color: white;">Check in para atendimento</h3>
                <div class="button" style="width: 100%; text-align: left; border-radius: 0px;  <?= $cor ?>  ;  <?= $corTexto ?>  ">
                    <p><b>Protocolo</b>: <?= $value['idAgendamento']   ?><br>
                    <p><b>Agendamento</b>: <?= $value['tipoAtendimento']   ?><br>
                    <h6><b>Nome</b>: <?= $value['nomePessoa']   ?><br></h6>

                    <h6><b>Hora</b>: <?= $value['hora'] . 'h00'   ?></h6>
                    <h6><b>Dia</b>: <?= $value['dia']   ?><br></h6>
                    <h6><b>Doc</b>: <?= $value['documentoPessoa'] ?></h6>

                    </p>
                </div>


                <div class="   large-12 cell">
                    <!--  <a class=" button" onclick="alterarStatusAgendamento(<?= $value['idAgendamento']   ?>, '4') " style=" background-color:rgb(179, 42, 0); width: 100%;">Cancelar Atendimento</a> -->

                    <a class=" button" onclick="alterarStatusAgendamento(<?= $value['idAgendamento']   ?>, '6') " style=" background-color:rgb(41, 77, 0); width: 100%;">Iniciar Atendimento</a>
                </div>


            </div>
        </div>


    <?php
        # code...
    }

    exit();
}












// esse controle serve para trazer os agendamentos da pessoa digitada (cpf ou cnpj)
if (isset($_POST['analiseDeDias'])) {


    
    $dadosAgendamento = $objAgendamento->verificarAgendamentoParaBaixaADM($_POST['envioDados']);


    $tamanho = sizeof($dadosAgendamento);

    if ($tamanho == 0) {
    ?>

        <div class="   large-12 cell">
            <center>
                <h5>Não há agendamentos para este documento</h5>
            </center>
        </div>


    <?php

    }


    //
    echo "<div class='   large-12 cell'> <h3> Agendamentos ativos </h3></div>";


    foreach ($dadosAgendamento as $key => $value) {


    ?>

        <div class="   large-6 cell">
            <div class="button" style="width: 100%; text-align: left; border-radius: 10px; background-color:#28536b ; color: white;  ">
                <p><b>Protocolo</b>: <?= $value['idAgendamento']   ?><br>
                <h6><b>Nome</b>: <?= $value['nomePessoa']   ?><br></h6>
                <h6><b>Hora</b>: <?= $value['hora'] . 'h00'   ?></h6>
                <h6><b>Dia</b>: <?= $value['dia']   ?><br></h6>
                <h6><b>Doc</b>: <?= $value['documentoPessoa'] ?></h6>
                <h5><b>Unidade: <?= $value['nomeUnidade'] ?></b></h5>
                </p>
            </div>
            <div class="   large-6 cell">
                <a class=" button" onclick="alterarStatusAgendamento(<?= $value['idAgendamento']   ?>, '6') " style="border-radius: 10px;  background-color:rgb(79, 212, 3); width: 100%; color: black; font-weight: 600;">Iniciar Atendimento</a>
                <a class=" button" onclick="alterarStatusAgendamento(<?= $value['idAgendamento']   ?>, '4') " style="border-radius: 10px; background-color:rgb(179, 42, 0); width: 100%;">Cancelar Agendamento</a>


            </div>
        </div>
    <?php

    }

    exit();
}





if (isset($_POST['datasAnaliticoAdmSintetico'])) {




    $agendas = $objAgendamento->verificarTodosAgendamentosUnidadeAdmDeUnidade($_POST['unidadeUsuario'], $_POST['dataDaUnidade']);

    $agendaDisponiveis = 0;
    $agendasAtendidas = 0;
    $telefonicas = 0;
    $agendadas = 0;

    $totalizadores =  count($agendas);


    foreach ($agendas as $key => $value) {

        switch ($value['idStatus']) {
            case '7':
                $agendaDisponiveis++;
                break;
            case '6':
                $agendasAtendidas++;
                break;
            case '3':
                $agendadas++;
                break;
            case '8':
                $telefonicas++;
                break;

            default:
                # code...
                break;
        }
    }



    $disponivel = $agendaDisponiveis -  $agendasAtendidas;

    ?>


    <div class="small-12 large-12 cell">
        <fieldset class="fieldset">
            <legend>
                <h4><?= $totalizadores ?> Senhas para o dia</h4>
            </legend>
            <div class="grid-x grid-padding-x">



                <div class="small-12 large-3 cell">
                    <a class="button" style="color: #555; width: 100%; background-color:rgb(160, 208, 231)">Agendas Disponíveis<br><?= $agendaDisponiveis ?> </a><br>
                </div>

                <div class="small-12 large-3 cell">
                    <a class="button" style="color: black; width: 100%;background-color:rgb(252, 202, 37); ">Aguardando Atendimento<br><?= $agendadas ?> </a><br>
                </div>

                <div class="small-12 large-3 cell">
                    <a class="button" style="color: white; width: 100%; background-color:rgb(60, 133, 0);">Atendidos<br><?= $agendasAtendidas ?> </a><br>
                </div>

                <div class="small-12 large-3 cell">
                    <a class="button" style="color: white; width: 100%; background-color:rgb(120, 3, 81)">Agendamentos Telefonicos <br><?= $telefonicas ?> </a><br>
                </div>

            </div>
        </fieldset>
    </div>
    <div class="   small-12 large- cell">
        <br>
        <label>Agendas disponibilizadas </label>

    </div>


    <?php

    $color = '';





    foreach ($agendas as $key => $value) {
        switch ($value['idStatus']) {
            case '7':
                $color = 'background-color:rgb(160, 208, 231);';
                $texto = 'white';
                break;

            case '3':
                $color = 'background-color:rgb(252, 202, 37)';
                $texto = 'black';
                break;

            case '6':
                $color = 'background-color:rgb(60, 133, 0);';
                $texto = 'white';
                break;

            case '8':
                $color = 'background-color:rgb(120, 3, 81);';
                $texto = 'white';
                break;

            default:
                # code...
                break;
        }
    ?>


        <div class="   small-12 large-3 cell">
            <a onclick="consultarDados_individual('<?= $value['documentoPessoa'] ?>',  '<?= $value['idAgendamento']  ?> ')" class="button" href="#" style="width: 100%; <?= $color ?>; text-align: left; color: <?= $texto ?>">
                <?php echo  'Protocolo: ' . $value['idAgendamento']  ?><br><br>
                <?php echo  'Agendamento: ' . $value['descricaoStatus']  ?><br><br>

                <?php echo  'Atendimento: ' . $value['tipoAtendimento']  ?><br><br>

                <?php echo  'Hora: ' . $value['hora'] . 'h00'  ?><br><br>
                <?php echo  'Documento: ' . $value['documentoPessoa']  ?>
            </a>



        </div>
    <?php
    } ?>




<?php

    exit();
}




if (isset($_POST['alterarStatusAgendamento'])) {


    $objAgendamento->setIdAgendamento($_POST['idAgendamento']);
    $objAgendamento->setIdStatus($_POST['idAcao']);



    if ($objAgendamento->mudarStatusoAgendamentoPeloAdm() == true) {
        echo json_encode(array('retorno' => true));
    }





    exit();
}
