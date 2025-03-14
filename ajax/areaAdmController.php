<?php



include_once '../classes/Datas.php';
include_once '../classes/Agendamento.php';

if (!isset($_SESSION)) {
    session_start();
}

$objAgendamento = new Agendamento();

$objDatas = new DatasAgendamento();


if (isset($_POST['verificarDatasPorUnidade'])) {
    $agendamentos = $objDatas->trazerHorariosAdmPorUnidade($_POST['unidadeUsuario']);
    foreach ($agendamentos as $key => $value) {
?>
        <div class="small-12 large-2 cell">
            <a class="button fundoBotoesTopo "
                style="height: 3em; width: 100%; color: white;  border-radius: 10px;" id="enviarHorarios" data-open="adm_das_datas"
                onclick="verificarDatasUnidadeADM(<?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']  ?>,'<?= $value['dia']  ?>' )"><?= $value['dia']  ?></a>
        </div>
    <?php
    }
    exit();
}



if (isset($_POST['datasUnidadesADM'])) {


    $agendas = $objAgendamento->verificarAgendamentosUnidadeData($_POST['unidadeUsuario'], $_POST['dataDaUnidade']);


    foreach ($agendas as $key => $value) {
    ?>
        <div class="small-12 large-12 cell">
            <?php


            echo '<label> '.$value['descricaoStatus'] . ': </label> ' . $value['qtde'];




            ?>
        </div>
<?php
    }
    exit();
}
