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


            


            if ($dataUnidade == false) { ?>

                <div class="small-6 cell large-12">
                    <a class="button " style="width: 100%; border-radius: 10px; background-color: red; color: while; font-weight: bold;">
                        Não Há datas disponíveis para agendamento</a>
                </div>
                <script>
                    $('.comboHorarios').html('<option>Não Há horários</option')
                </script>

                <?php

            } else {
                echo '<div class="small-12 cell large-12"><label><b>Clique no botão azul para selecionar o dia  do seu agendamento</b></label></div><br>';
                foreach ($dataUnidade as $key => $value) {

 
                ?>
                    <div class="small-6 cell large-3">


                        <a class="button " style="width: 100%; border-radius: 10px;" onclick="$('.comboHorarios').html('<option>Aguarde por favor</option>')   
                         ;procuraHoras('<?= $value['dia']; ?>',0,<?=$_POST['idUnidade']?>)"> <?=$value['dia']; ?> </a>


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
