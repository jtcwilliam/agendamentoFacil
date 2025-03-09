<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';

?>

<body>


    <div class="full reveal" id="modalSucesso" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh;">
            <center style="color: white;">
                <h1>Ótimas Notícias!</h1>
                <p class="lead">Seu Agendamento foi registrado com Sucesso</p>
                <p id="protocoloAgendamento"></p>
                <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" />
            </center>

        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>




    <div class="grid-container" style="display: grid; align-items: center; height: 100vh;">
        <div class="grid-x grid-padding-x">
            <div class="auto cell">

            </div>



            <div class="small-12 large-6 cell" id="exibiAgendamento">

                <div id="todosContainers">

                    <!-- primeiro formulario, consulta cpf -->
                    <div class="grid-x grid-padding-x" id="loginCPF">
                        <div class="small-12 large-12 cell">
                            <label style="font-weight: bold;"> Digite o CPF para Iniciar o Agendamento
                                <input type="text" placeholder="Digite aqui seu CPF" class="cpf" id="cpf" onkeydown="mudarMascara(this.value)" />
                            </label>
                            <a class="button succes" href="#" onclick="consultarCPF()" style="width: 100%;">Consultar</a>
                            <br>
                        </div>
                    </div>

                    <!-- segundo formulario, consulta inseere nome-->
                    <div class="grid-x grid-padding-x" id="nomeUsuario">
                        <div class="small-12 large-12 cell">
                            <label style="font-weight: bold;"> Vamos continuar seu agendamento! Digite seu nome por favor
                                <input type="text" placeholder="Digite aqui seu Aqui" class="nomeAgendamento" id="nomeAgendamento" />
                            </label>
                            <a class="button succes" href="#" onclick="inserirUsuario()" style="width: 100%;">Seguir para Agendamento</a>
                            <br>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x" id="campoMensagemAgendamentosAtivos">
                        <div class="small-12 cell large-12">
                            <br>
                            <center>
                                <h4>Olá. Você Ja possui <span id="valorAgendamentos"></span> agendamentos ativos</h4>
                                </h5> Após encerrar esses atendimentos, você poderá agendar novos Horários</h5>
                            </center>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x" id="agendamentosRealizadosAtivos">
                        <div class="small-12 cell large-12">
                            <fieldset class="fieldset">
                                <Legend style="font-weight: 800;">Seus Agendamentos Ativos</Legend>

                                <div class="grid-x grid-padding-x" id="exibirAgendamentosAntigos"></div>



                        </div>
                        </fieldset>
                    </div>



                    <!-- aqui faz o agendamento -->

                    <div class="grid-x grid-padding-x" id="formularioAgendamento">
                        <div class="small-12 cell large-12">
                            <br>
                            <label>
                                CPF
                                <input type="text" name="txtCPF" id="txtCPF" readonly />
                            </label>
                        </div>

                        <div class="small-12 cell large-12" style="display: none;">
                            <br>
                            <label>
                                idUsuario
                                <input type="text" name="txtIdUsuario" id="txtIdUsuario" readonly />
                            </label>
                        </div>

                        <div class="small-12 cell large-12">
                            <label>
                                Nome
                                <input type="text" name="txtNome" id="txtNome" value="" readonly />
                            </label>
                        </div>

                        <div class="small-12 cell large-12">
                            <label>
                                Escolha a Unidade para Atendimento
                                <select id="selectUnidade" onchange="datasNaUnidade()">

                                </select>
                            </label>
                        </div>
                        <div class="small-12 cell large-12" id="aparecerDatas">

                        </div>




                        <div class="small-12 medium-12  large-12 cell">
                            Hora
                            <select id="comboHorarios">

                            </select>
                        </div>

                        <div class="small-12 cell large-12">
                            <label>
                                Escolha o tipo de Atendimento
                                <select>
                                    <option>PMG</option>
                                </select>
                            </label>
                        </div>


                        <div class="small-12 cell large-12">
                            <Br>

                            <a class="button  " onclick="registrarAgendamento()" style="width: 100%; background-color: #28536b; color: white;">
                                Concluir Agendamento
                            </a>

                        </div>




                    </div>


                </div>




                <img src="imgs/logoPrefeitura.png" />
            </div>

            <div class="auto cell">

            </div>
        </div>







    </div>

    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        $(document).ready(function() {
            $('#nomeUsuario').hide();
            $('#formularioAgendamento').hide();
            $('#campoMensagemAgendamentosAtivos').hide();
            
            $('#agendamentosRealizadosAtivos').hide();

        })


        //carregar combo das unidades
        function procuraHoras(dia) {

            console.log(dia);

            var formData = {
                dia: dia,
                verificarHora: 1
            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/agendamentoController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);
                    $('#comboHorarios').html(data);
                });
        }

        function mudarMascara(cpf) {


            var tamanho = cpf.length;
            if (tamanho >= 15) {
                $('.cpf').mask('00.000.000/0000-00');
            } else {
                $('.cpf').mask('000.000.000-000');
            }

        }

        function consultarCPF() {



            var formData = {
                cpf: $('#cpf').val()

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/verificadorController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                    condicao = data.retornoCondicao.condicao;
                    if (condicao == false) {
                        //condição retornou false, a pessoa não ta cadastrada, abre o nome para gravar
                        $('#loginCPF').hide();
                        $('#nomeUsuario').delay('fast').fadeIn();

                    } else {
                        //condição retornou true, então pode seguir para o agendamento. ta fa

                        $('#loginCPF').hide();
                        $('#nomeUsuario').hide();
                        $('#formularioAgendamento').show();


                        $('#txtNome').val(data.retornoCondicao.dados[0].nomePessoa);
                        $('#txtCPF').val(data.retornoCondicao.dados[0].documentoPessoa);
                        $('#txtIdUsuario').val(data.retornoCondicao.dados[0].idPessoas);

                        comboUnidadesComum();
                        agendamentosAtivos(data.retornoCondicao.dados[0].idPessoas);



                    }

                });
            event.preventDefault();
        }

        function inserirUsuario() {
            var formData = {
                cpf: $('#cpf').val(),
                nomeUsuario: $('#nomeAgendamento').val()

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/inserirController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                    console.log(data);

                    if (data.retorno == true) {
                        consultarCPF();
                    }

                });
            event.preventDefault();
        }



        function registrarAgendamento() {


            var formData = {
                registrarAgendamento: 1,
                idUsuario: $('#txtIdUsuario').val(),
                comboHorarios: $('#comboHorarios').val(),
                selectUnidade: $('#selectUnidade').val(),
                idStatus: '3'


            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/agendamentoController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {


                    if (data.retorno == true) {
                        $('#formularioAgendamento').hide();
                        $('#modalSucesso').foundation('open');
                        $('#protocoloAgendamento').html('Seu Protocolo de Atendimento: <b>' + $('#comboHorarios').val() + "/2025 </b><br>Vamos te redirecionar para o Portal do Fáci    l")

                        window.setTimeout(() => {
                            window.location = "https://portaleducacao.guarulhos.sp.gov.br/wp_site/facil/paginaInicial/#";
                        }, 4600);

                        //https://portalfacil.guarulhos.sp.gov.br/paginaInicial/

                    }


                });
            event.preventDefault();
        }



        //retorno dos Agendamentos Ativos
        function agendamentosAtivos(idPessoa) {



            var formData = {
                verificarAgendamentosAtivos: 1,
                idPessoa: idPessoa,
                idStatus: 3

            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/agendamentoController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {


                  

                    if (data.qtdeAgendamentos > 2) {
                        $('#formularioAgendamento').hide();
                        $('#campoMensagemAgendamentosAtivos').show();
                        console.log('passou aqui');
                    }

                    $('#agendamentosRealizadosAtivos').show();
                 

                    $('#valorAgendamentos').html('<b>'+ data.qtdeAgendamentos + "</b>");

                    $('#exibirAgendamentosAntigos').html(data.agendamentoAntigo);
                });
        }




        //retorno das datas disponiveis da unidade
        function datasNaUnidade() {
            $('#aparecerDatas').html('<h4>Estamos consultando pra você</h4>');


            var formData = {
                datasDaUnidade: 1,
                idUnidade: $('#selectUnidade').val()

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

                    // <label>Selecione a data de seu agendamento


                    $('#aparecerDatas').html(' <label>Selecione a data de seu agendamento' + data + "</label>");

                });
        }
    </script>
</body>

</html>