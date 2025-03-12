<?php



include_once '../classes/Unidade.php';
include_once '../classes/Datas.php';
$objUnidade = new Unidade();

$objDatasAgendamento = new DatasAgendamento();
$unidades = $objUnidade->carregarTodasUnidades();


if (isset($_POST['unidadesComum'])) {


    foreach ($unidades as $key => $value) {
?>

        <option value="<?= $value['idUnidade'] ?>"><?php echo $value['nomeUnidade']   ?></option>


    <?php
    }
    exit();
}



if (isset($_POST['datasDaUnidade'])) {



    $tipoExibicao = $_POST['tipoExibicao'];

    if ($tipoExibicao == '0') {
        $dataUnidade = $objDatasAgendamento->verificarDatasNaUnidade($_POST['idUnidade']);
    } else  if ($tipoExibicao == 1) {
        $dataUnidade = $objDatasAgendamento->verificarDatasNaUnidadeADM($_POST['idUnidade']);
    }



    ?><div class="grid-x grid-padding-x">

        <?php

        if ($_POST['tipoExibicao'] == 0) {


            if ($dataUnidade['retorno'] == 0) { ?>

                <div class="small-6 cell large-12">
                    <a class="button " style="width: 100%; border-radius: 10px; background-color: red; color: while; font-weight: bold;"  >  Não Há datas disponíveis para agendamento</a>
                </div>

                <?php

            } else {
                echo '<div class="small-6 cell large-12"><label><b>Selecione a Data do seu agendamento</b></label></div>';
                foreach ($dataUnidade as $key => $value) {


                ?>
                    <div class="small-6 cell large-3">
                        <a class="button " style="width: 100%; border-radius: 10px;" onclick="procuraHoras('<?= $value['dia']; ?>',0)"> <?= $value['dia']; ?> </a>
                    </div>

                <?php

                }
            }
        } else  
        if ($_POST['tipoExibicao'] == 1) {

            echo '<option>Clique aqui para Selecionar</option>';

            foreach ($dataUnidade as $key => $value) {



                ?>



                <option id="procuraHoras('<?= $value['dia']; ?>')"> <?= $value['dia']; ?> </option>


        <?php
            }
        }

        ?>
    </div><?php
            exit();
        }



        session_start();



        if ($_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 4) {



            foreach ($unidades as $key => $value) {
            ?>

        <option value="<?= $value['idUnidade'] ?>"><?php echo $value['nomeUnidade']   ?></option>


    <?php
            }
        } else {
    ?>
    <option value="<?= $_SESSION['usuarioLogado']['dados'][0]['idUnidade'] ?>"><?php echo  $_SESSION['usuarioLogado']['dados'][0]['nomeUnidade']   ?></option>

<?php
        }
