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

    <div class="reveal" id="adm_das_datas" data-reveal style="background-color:ivory">
        <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">
            

            <div class="grid-x grid-padding-x" id="inforDatas">

            </div>

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







                <!-- liberação de datas para agendamento -->
                <fieldset class="fieldset">
                    <legend> <label>Criar Horários para Atendimento</label></legend>

                    <form action="#">
                        <div class="grid-x grid-padding-x">

                            <div class="small-12 large-2 cell">
                                <label for="selectUnidade"> Unidade</label>
                                <select id="selectUnidade" style="height: 2.8em;"> </select>

                            </div>


                            <div class="small-12 large-2 cell">
                                <label for="dataAgendamento"> Data
                                    <input type="text" class="datepicker" id="dataAgendamento" style="height: 2.8em;" required />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell">
                                <label for="primeiroHorario"> Primeiro Horário
                                    <input type="number" class="" id="primeiroHorario" style="height: 2.8em;" required />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell">
                                <label for="ultimoHorario">Ultimo Horário
                                    <input type="number" class="" id="ultimoHorario" style="height: 2.8em;" required />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell">
                                <label for="qtdeMesas">Quantas Mesas
                                    <input type="number" id="qtdeMesas" style="height: 2.8em;" />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell">
                                <label for="qtdeMesas">&nbsp;<br>
                                    <input type="submit" class="button fundoBotoesTopo "
                                        style="height: 3em; width: 100%; color: white; font-weight: bold;" id="enviarHorarios" onclick="preencherHorarios()" value="Cadastrar" />
                                </label>
                            </div>

                        </div>
                    </form>
                </fieldset>




                <!-- todas as datas do agendamento disponível -->
                <fieldset class="fieldset">
                    <legend> <label>Analítico das Agendas</label></legend>

                    <form action="#">
                        <div class="grid-x grid-padding-x" id="analiseAgendas">





                        </div>
                    </form>
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

            listasDataUnidadeADM(<?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']   ?>)
        })



        //parte para preencher os horários
        function preencherHorarios() {

            $('#enviarHorarios').prop('disabled', true);

            var horario = $('#ultimoHorario').val();

            var dataAgendamento = $('#dataAgendamento').val();

            var primeiroHorario = $('#primeiroHorario').val();

            var qtdeMesas = $('#qtdeMesas').val();

            if (horario.length == 0 || dataAgendamento.length == 0 || primeiroHorario.length == 0 || qtdeMesas.length == 0) {

                alert("Por Favor, preencha todos os dados");

                return false;
            }

            var formData = {
                inserirHorarios: 1,
                dataAgendamento: $('#dataAgendamento').val(),
                primeiroHorario: $('#primeiroHorario').val(),
                ultimoHorario: $('#ultimoHorario').val(),
                qtdeMesas: $('#qtdeMesas').val(),
                selectUnidade: $('#selectUnidade').val(),
                selectTipoAgendamento: '1'
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/horarioController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);
                    if (data.retorno == true) {




                        $('#ultimoHorario').val('');

                        $('#dataAgendamento').val('');

                        $('#primeiroHorario').val('');

                        $('#qtdeMesas').val('');

                        listasDataUnidadeADM(<?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']   ?>)
                        alert('Agendamentos Liberados para a data mencionada');


                    } else {
                        alert('Tente novamente em poucos minutos');
                    }
                    setTimeout(() => {
                        $('#enviarHorarios').attr("disabled", false);
                    }, 3600);



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