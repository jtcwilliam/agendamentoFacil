<?php

include_once 'classe/ordemAnexo.php';

$objOrdem = new OrdemAnexo();

?>


<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>

    <div class="grid-x grid-padding-x" style="background-color: #155f9b; color: white; padding-left: 30px;">

        <b>Prefeitura de Guarlhos - Mockup de Testes</b>

    </div>
    <div class="grid-x grid-padding-x" style="background-color: #0494c7; padding-left: 30px;">
        <div class="large-4 cell">
            <img src="logoBarra.png">
        </div>

        <div class="large-3 cell">
        </div>

        <div class="large-5 cell">
            <img src="barra.png">
        </div>



    </div>


    <div class="grid-x grid-padding-x">

        <div class="large-3 cell" style="background-color: #001a23;height: 100vh;">

            <img src="barraLateral.png">
        </div>


        <div class="large-9 cell">
            <form action="gravarForm.php" enctype="multipart/form-data" method="POST">


                <br>&nbsp;<br>
                <div class="grid-x grid-padding-x">


                    <div class="medium-12 cell">
                        <fieldset class="fieldset">
                            <legend><label>
                                    <h3>Relatório Quantitativo de Ordens de Anexo</h3>
                            </legend>

                            <table>
                                <thead>
                                    <tr>
                                        <th width="30%">Nome</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qtde = $objOrdem->quantitaTivoOrdem();
                                    foreach ($qtde as $key => $value) {
                                        echo "<tr><td>Ordens de Anexo Registradas</td><td>" . $value['total'] . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </fieldset>
                    </div>



                    <div class="medium-12 cell">
                        <fieldset class="fieldset">
                            <legend><label>
                                    <h3>Relatório Quantitativo de Ordens de Anexo</h3>
                            </legend>
                            <table>
                                <thead>
                                    <tr>
                                        <th width="60%">Nome</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qtde = $objOrdem->sinteseOrdem();
                                    foreach ($qtde as $key => $value) {
                                        echo "<tr><td>" . $value['nomeOrdemAnexo'] . "</td><td>" . $value['count(valor)'] . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>



                    </fieldset>

                    <div class="medium-6 cell">
                       <center> <a href="index.php" class="button">Cadastrar Outra Ordem de Anexo</a></center>
                    </div>

                    <div class="medium-6 cell">
                        <center><a href="relatorio.php" class="button">Relatórios de Ordem de Anexo</a></center>
                    </div>
                </div>




            </form>
        </div>






    </div>


    </div>









    <script>
        $(document).ready(function() {
            $('#mySelect').select2();
        });
    </script>
</body>


/html>