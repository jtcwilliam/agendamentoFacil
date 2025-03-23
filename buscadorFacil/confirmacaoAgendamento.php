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
    <title>Foundation for Sites</title>
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
                            <a style="color: white;" href="#">Prefeitura</a>

                        </li>
                        <li><a style="color: white;" href="#">Agendamentos</a></li>
                        <li><a style="color: white;" href="#">Endereços</a></li>
                        <li><a style="color: white;" href="#">Consulta de Processos</a></li>
                        <li><a style="color: white;" href="#">Guia de Serviços</a></li>



                    </ul>
                </div>


            </div>
        </div>
    </div>




    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell" style="padding-top: 200px;">


             
<center>
                <h1>Seu Agendamento foi realizado com Sucesso</h1>

                <h3>Compareça no Local e data escolhidos. </h3>


                <h5>Número de Protocolo:  <?php echo rand(5, 15), "\n"; ?> </h5>


</center>

        <br>
               <center><img src="confirmacao.jpeg" style="width: 40%;" /></center>



            </div>
        </div>
    </div>







    <script>
        $(document).ready(function() {


            $('.mySelect').select2();   

        });

        function informar(){
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