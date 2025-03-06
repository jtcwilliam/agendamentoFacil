<?php



include_once '../classes/Unidade.php';
include_once '../classes/Datas.php';
$objUnidade = new Unidade();

$objDatasAgendamento = new DatasAgendamento();
$unidades = $objUnidade->carregarTodasUnidades();



if (isset($_POST['datasDaUnidade'])) {


    $dataUnidade = $objDatasAgendamento->verificarDatasNaUnidade($_POST['idUnidade']);


?><div class="grid-x grid-padding-x">
    
    
    
    
    <?php

                                        foreach ($dataUnidade as $key => $value) { ?>
            <div class="small-6 cell large-3">
                <a class="button success" style="width: 100%;" onclick="procuraHoras('<?= $value['dia']; ?>')"  > <?= $value['dia']; ?> </a>
            </div>

        <?php
                                        }

        ?>
    </div><?php

            //<div class="small-12 cell large-12">





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
