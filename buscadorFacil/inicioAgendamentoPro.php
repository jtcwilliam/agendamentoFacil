<?php


include_once 'classe/servicos.php';

$objservico = new servicosFacil();

$dados = $objservico->trazerServicos();




?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo ao agendamento Fácil Pró</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>

    </script>
    <style>
        label {
            font-weight: 800;
            font-size: 1.1em;

        }

        .tituloTabela {
            font-weight: 800;
            font-size: 1.1em;
            background-color: #e0e0e0;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>


    <div class="grid-x grid-padding-x " style="background-color: #4845A0; color: white;">
        <div class="medium-12 cell " style="background-color: #4845A0;">

            <div class="top-bar" style="background-color: #4845A0; color: white">
                <div class="grid-container">

                    <ul class=" menu" menu style="background-color: #4845A0; color: white;">

                        <li>
                            <a style="color: white;" href="https://www.guarulhos.sp.gov.br">Prefeitura</a>

                        </li>
                        <li><a style="color: white;" href="https://portaleducacao.guarulhos.sp.gov.br/wp_site/facil/paginaInicial/#agendamento">Agendamentos</a></li>
                        <li><a style="color: white;" href="https://portaleducacao.guarulhos.sp.gov.br/wp_site/facil/paginaInicial/#unidades">Endereços</a></li>
                        <li><a style="color: white;" href="https://www.guarulhos.sp.gov.br/consulta-de-processos-administrativos">Consulta de Processos</a></li>
                        <li><a style="color: white;" href="http://vscassociates.com.br/facil/proposta/">Guia de Serviços</a></li>



                    </ul>
                </div>


            </div>

        </div>
    </div>




    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">




                <fieldset class="fieldset">


                    <div class="grid-x grid-padding-x">
                        <div class="auto cell"></div>
                        <div class="large-6 cell">
                            <label>Informe seu CPF ou Cnpj para para iniciar seu agendamento</label>
                            <input type="text" placeholder="informe seu CPF ou CNPJ" />
                        </div>
                        <div class="auto cell"></div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="auto cell"></div>
                        <div class="large-6 cell">
                            <label>Qual sua Profissão?</label>
                            <select>

                                <option>Advogado</option>
                                <option>Engenheiro</option>
                                <option>Arquiteto</option>
                                <option>Contador</option>
 





                            </select>
                        </div>
                        <div class="auto cell"></div>
                    </div>






                    <div class="grid-x grid-padding-x">
                        <div class="auto cell"></div>
                        <div class="large-6 cell">
                            <a href="agendamento.php" type="submit" class="button success" style="width: 100%;">Acessar</a>
                        </div>
                        <div class="auto cell"></div>
                    </div>


                </fieldset>


                <div id="infor">

                </div>



            </div>
        </div>
    </div>







    <script>
        $(document).ready(function() {


            $('.mySelect').select2();

        });

        function informar() {
            alert('Seu Agendamento está Confirmado');

        }
    </script>

    <script>
        function consultarServicos() {

            var comboProcessos = $('#comboProcessos').val();

            var formData = {
                comboProcessos: comboProcessos,

                consultarServico: '1'
            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/agentamentoController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true

                })

                .done(function(data) {


                    $('#infor').html(data);
                });

            event.preventDefault();

        }
    </script>


</body>


</html>