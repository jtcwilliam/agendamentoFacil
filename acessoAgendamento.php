<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php';

session_start();

$dadoTipoPessoa =     $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['idUnidade'];

include_once 'includes/verificadorADM.php';



?>

<body>

    <div class="reveal" id="exampleModal1" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">

        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>



    <?php

    ////
    include_once 'includes/linksAdm.php';

?>

    <div class="grid-container">
        <div class="grid-x grid-padding-x">
 


            <div class="small-12 large-12 cell">






                <fieldset class="fieldset">
                    <legend>Ola <b><?php echo $_SESSION['usuarioLogado']['dados'][0]['nome']   ?> </b></legend>
                    <div class="grid-x grid-padding-x">
                        <div class="small-12 large-4 cell">
                            <label for="selectUnidade"> Unidade
                                <?php
                                if ($dadoTipoPessoa == 4) {
                                ?>
                                    <select id="selectUnidade" onchange="datasNaUnidade(1,0);" style="height: 2.8em;"> </select>
                                <?php
                                } else { ?>

                                    <select id="selectUnidade" style="height: 2.8em;"> </select>

                                <?php
                                }
                                ?>
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
                                <select id="selectTipoAgendamento" class="selectTipoAgendamento" style="height: 2.8em;"> </select>
                            </label>
                        </div>

                        <div class="small-12 large-2 cell">
                            <label for="qtdeMesas">&nbsp;<br>
                                <a class="success button" style="height: 3em; width: 100%; color: white; font-weight: bold;" onclick="preencherHorarios()">Cadastrar</a>
                            </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Administração das Senhas do dia</legend>

                    <select id="aparecerDatas" onchange="procuraHoras($('#aparecerDatas').val(), 1 )">

                    </select>

                    <div class="small-12 large-12 cell">

                        <fieldset class="fieldset">
                            <legend>Senhas</legend>

                            <div class="comboHorarios">

                            </div>
                        </fieldset>
                    </div>

                </fieldset>

            </div>

        </div>

    </div>

    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        $(document).ready(function() {
            comboUnidades();
            comboTipoAgendamento();
            datasNaUnidadeAdm(1, <?= $responsavelPessoa ?>);
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
                selectTipoAgendamento: $('.selectTipoAgendamento').val()
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
    </script>



</body>

</html>