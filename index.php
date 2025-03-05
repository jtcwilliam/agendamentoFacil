<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php'

?>

<body>

    <div class="grid-container" style="display: grid; align-items: center; height: 100vh;">
        <div class="grid-x grid-padding-x">
            <div class="auto cell">

            </div>



            <div class="small-12 large-6 cell" id="exibiAgendamento">

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

                <!-- aqui faz o agendamento -->

                <div class="grid-x grid-padding-x" id="formularioAgendamento">
                    <div class="small-12 cell large-12">
                        <br>
                        <label>
                            CPF
                            <input type="text" name="txtCPF" id="txtCPF" readonly />
                        </label>
                    </div>

                    <div class="small-12 cell large-12">
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
                            <select>
                                <option>Fácil São João</option>
                            </select>
                        </label>
                    </div>

                    <div class="small-12 cell large-12">
                        <label>
                            Escolha o tipo de Atendimento
                            <select>
                                <option>PMG</option>
                            </select>
                        </label>
                    </div>



                    <div class="small-12 medium-12  large-7 cell">
                        <label>Data
                            <input type="text" id="txtDataAtendimento" onchange="procuraHoras($('#txtDataAtendimento').val())" class="datepicker textoEntradas"></p>

                        </label>
                    </div>

                    <div class="small-12 medium-12  large-5 cell">
                        Hora
                        <select id="comboHorarios">
                            
                        </select>
                    </div>


                    <div class="small-12 cell large-12">
                        <Br>

                        <a class="button  " style="width: 100%; background-color: #28536b; color: white;">
                            Concluir Agendamento
                        </a>

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
        })


        //carregar combo das unidades
        function procuraHoras(dia) {

            console.log(dia);
            
            var formData = {
                dia: dia
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
                        $('#formularioAgendamento').delay('fast').fadeIn();

                        $('#txtNome').val(data.retornoCondicao.dados[0].nomePessoa);
                        $('#txtCPF').val(data.retornoCondicao.dados[0].documentoPessoa);
                        $('#txtIdUsuario').val(data.retornoCondicao.dados[0].idPessoas);



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
    </script>
</body>

</html>