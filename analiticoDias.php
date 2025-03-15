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





                            <div class="small-12 large-3 cell">
                                <label for="dadosEntrada">Protocolo, CPF OU CNPJ
                                    <input type="text" class="cpf" onkeydown="mudarMascara(this.value)" style="height: 2.8em;" value="306.911.807-80" />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell">
                                <label for="qtdeMesas">&nbsp;<br>
                                    <input type="submit" class="button fundoBotoesTopo "
                                        style="height: 3em; width: 100%; color: white; font-weight: bold;"
                                        id="enviarHorarios" onclick="consultarDados($('.cpf').val())" value="Cadastrar" />
                                </label>
                            </div>

                            <div class="small-12 large-7 cell">
                                <div class="grid-x grid-padding-x" id="agendamentosAtivosNoDia">

                                </div>

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
        function consultarDados(pesquisa) {



            var formData = {
                analiseDeDias: 1,
                envioDados: pesquisa,

                selectTipoAgendamento: '1'
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/analiticoDiasController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);

                    $('#agendamentosAtivosNoDia').html(data);



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