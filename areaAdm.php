<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php';






session_start();



?>

<body>

    <div class="grid-container" style="display: grid; align-items: center; height: 100vh;">
        <div class="grid-x grid-padding-x">

            <div class="small-12 large-12 cell">
                <fieldset class="fieldset">
                    <legend>Ola <b><?php echo $_SESSION['usuarioLogado']['dados'][0]['nome']   ?> </b></legend>
                    <div class="grid-x grid-padding-x">
                        <div class="small-12 large-4 cell">
                            <label for="selectUnidade"> Unidade
                                <select id="selectUnidade" style="height: 2.8em;"> </select>
                            </label>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 large-2 cell">
                            <label for="dataAgendamento"> Data
                                <input type="text" class="datepicker" id="dataAgendamento" style="height: 2.8em;" />
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="primeiroHorario"> Primeiro Horário
                                <input type="number" class="" id="primeiroHorario" style="height: 2.8em;" />
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="ultimoHorario">Ultimo Horário
                                <input type="number" class="" id="ultimoHorario" style="height: 2.8em;" />
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="qtdeMesas">Quantas Mesas
                                <input type="number" id="qtdeMesas" style="height: 2.8em;" />
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="selectTipoAgendamento">Tipo Agendamento
                                <select id="selectTipoAgendamento" style="height: 2.8em;"> </select>
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="qtdeMesas">&nbsp;<br>
                                <a class="success button" style="height: 3em; width: 100%; color: white; font-weight: bold;" onclick="preencherHorarios()">Cadastrar</a>
                            </label>
                        </div>
                    </div>
                </fieldset>

            </div>
            <img src="imgs/logoPrefeitura.png" />
        </div>

    </div>

    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        $(document).ready(function() {
            // $('#confirmacao').hide();



        })



        //parte para preencher os horários
        function preencherHorarios() {

            var formData = {
                inserirHorarios: 1,
                dataAgendamento: $('#dataAgendamento').val(),
                primeiroHorario: $('#primeiroHorario').val(),
                ultimoHorario: $('#ultimoHorario').val(),
                qtdeMesas: $('#qtdeMesas').val(),
                selectUnidade: $('#selectUnidade').val(),
                selectTipoAgendamento: $('#selectTipoAgendamento').val()
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/horarioController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);


                });
            event.preventDefault();

        }


        //carregar combo das unidades
        function comboUnidades() {

            var formData = {
                tipo: 1
            };
         
            $.ajax({
                    type: 'POST',
                    url: 'ajax/unidadeController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);


                    $('#selectUnidade').html(data);

                });
             
        }

        function comboTipoAgendamento() {

            var formData = {
                tipo: 1
            };
         
            $.ajax({
                    type: 'POST',
                    url: 'ajax/tipoAgendamentoController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);


                    $('#selectTipoAgendamento').html(data);

                });
          
        }

        comboUnidades();
        comboTipoAgendamento();
    </script>



</body>

</html>