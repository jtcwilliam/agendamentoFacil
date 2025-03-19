<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';
include_once '../classes/Unidade.php';




$objAgendamento = new Agendamento();
$objDatas = new DatasAgendamento();
$objUnidade = new Unidade();





if (isset($_POST['trazerHorariosTodasUnidadesSuperAdm'])) {

    $unidades = $objUnidade->carregarTodasUnidades();



    foreach ($unidades as $key => $unidadeCarregada) {



        $agendamentos = $objDatas->trazerHorariosAdmPorUnidade($unidadeCarregada['idUnidade']);

      
?>



        <div class="small-12 large-12 cell">
            <fieldset class="fieldset">

                <legend> <label> <?= $unidadeCarregada['nomeUnidade']  ?> </label> </legend>
                <div class="grid-x grid-padding-x">
                    <?php


                    foreach ($agendamentos as $key => $value) { ?>
                        <div class="small-12 large-2 cell">
                            <a class="button fundoBotoesTopo "
                                style="height: 3em; width: 100%; color: white;  border-radius: 10px;" id="enviarHorarios" data-open="adm_das_datas"
                                onclick="verificarDatasUnidadeSuperAdm(<?=$unidadeCarregada['idUnidade'] ?>,'<?= $value['dia']  ?>' )"><?= $value['dia']  ?></a>
                        </div>
                    <?php
                    }  ?>
                </div>
            </fieldset>
        </div>


    <?php
    }






    exit();
}



if (isset($_POST['datasUnidadesADM'])) {




    $agendas = $objAgendamento->verificarAgendamentosUnidadeData($_POST['unidadeUsuario'], $_POST['dataDaUnidade']);

    ?>
    <div class="small-12 large-12 cell">
        <label style="color: #555;">Síntese dos agendamentos do dia <span style="color: black; "><br> <?= $_POST['dataDaUnidade'] ?></span></label><br>
    </div>



    <?php



    foreach ($agendas as $key => $value) {
    ?>
        <div class="small-12 large-12 cell">
            <?php echo '<label  style="color: #555;"> ' . $value['descricaoStatus'] . '<br> <span style="color: black"> ' . $value['qtde'] . '</label> <br>';  ?>

        </div>
    <?php
    } ?>

    <div class="small-12 large-12 cell">
        <a class="button " style="width: 100%;   " href="analiticoDiasSuperAdm.php?dataUnidade='<?= $_POST['dataDaUnidade'] ?>'&idUnidade=<?= $_POST['unidadeUsuario'] ?> "> Gestão das Senhas do dia</a>

    </div>


<?php

    exit();
}
