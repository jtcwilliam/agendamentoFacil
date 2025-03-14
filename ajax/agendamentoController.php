<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

$objAgendamento = new Agendamento();

$objDatas = new DatasAgendamento();


if (isset($_POST['verificarAgendamentosAtivos'])) {

    $agendamentos = $objAgendamento->verificarAgendamentosAtivos($_POST['idPessoa'], $_POST['idStatus']);


    $qtdeAgendamentos =  sizeof($agendamentos);

    $agendamentosAntigos = '';

    foreach ($agendamentos as $key => $value) {
        $agendamentosAntigos .=  "<div class='small-12 cell large-12'> <div> <b>Protocolo: </b>" . $value['idAgendamento'] . "<br> <b> Dia e Hora: </b>" . $value['dia'] . "  às " . $value['hora'] . "h00 no <b>" . $value['nomeUnidade'] . "</b></div>   <hr> </div> ";
    }

    echo  json_encode(array('qtdeAgendamentos' => $qtdeAgendamentos, 'agendamentoAntigo' => $agendamentosAntigos, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));




    exit();
}

if (isset($_POST['verificarHora'])) {

    $comboHoras = $objDatas->trazerHorarios($_POST['dia']);

    $tipoExibicao = $_POST['tipoExibicao'];


    if ($tipoExibicao == 0) {
        foreach ($comboHoras as $key => $value) { ?>
            <div class="small-12 large-12 cell">
                <?php

                if ($value['idStatus'] == 7) {
                ?>
                    <option value="<?= $value['idAgendamento'] ?>"><?php echo $value['dia'] .  ' às ' . $value['hora'] . 'h00'   ?></option>
                <?php
                } ?>




            </div><?php
                }
            } else  if ($tipoExibicao == 1) { ?>

        <div class="grid-x grid-padding-x">
            <?php



                foreach ($comboHoras as $key => $value) {

                  
            ?>
                <div class="small-12 large-2 cell" style="margin-top: 10px;">



                    <?php

                    if ($value['idStatus'] == '3') {


                    ?>
                        <a data-open="exampleModal1" class="button" style="border-radius: 10px; text-align: left; background-color: #ffa405;">
                            <p style="color: black;">
                                Status: Agendado
                                Hora: <?php echo   $value['hora'] . 'h00';  ?><br>
                                Protocolo: <?= $value['idAgendamento'] ?><br>

                            </p>
                        </a><?php

                        } else  if ($value['idStatus'] == '0') {


                            ?>
                        <a data-open="exampleModal1" class="button" style="border-radius: 10px; text-align: left; background-color: #06813b;">
                            <p style="color: white;">
                            Status: Disponível
                                Hora: <?php echo   $value['hora'] . 'h00';  ?><br>
                                Protocolo: <?= $value['idAgendamento'] ?><br>

                            </p>
                        </a><?php

                        }








                            ?>



                </div><?php
                    } ?>
        </div><?php
            }

            exit();
        }


        if (isset($_POST['registrarAgendamento'])) {


            $objAgendamento->setIdPessoas($_POST['idUsuario']);
            $objAgendamento->setIdStatus($_POST['idStatus']);
            $objAgendamento->setIdAgendamento($_POST['comboHorarios']);
            $objAgendamento->setIdUnidade($_POST['selectUnidade']);
            $objAgendamento->setIdTipoAgendamento($_POST['selectAgendamento']);

            if ($objAgendamento->registrarAgendamentoUsuario()) {
                echo json_encode(array('retorno' => true));
            }


            exit();
        }








        //registrarAgendamento
                ?>