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
                        <label style="font-weight: bold;">
                            <input type="text" placeholder="Digite aqui seu CPF" class="cpf" id="cpf" />
                        </label>

                    </div>

                    <div class="small-12 large-12 cell">
                        <label style="font-weight: bold;">
                            <input type="text" placeholder="Digite sua Senha" id="pwd" />
                        </label>
                        <a class="button succes" href="#" onclick="consultarAcesso()" style="width: 100%;">Acessar Area Administrativa</a>
                        <br>
                    </div>
                </div>




                <!-- confirmacao  -->
                <div class="grid-x grid-padding-x" id="confirmacao">
                    <div class="small-12 large-12 cell">

                        <center>
                            <h4 id="mensagemConfirmacao"></h4>
                        </center>

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
            // $('#confirmacao').hide();

            $('.cpf').mask('000.000.000-00');
        })

        function consultarAcesso() {

            var formData = {
                cpf: $('#cpf').val(),
                pwd: $('#pwd').val()
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/loginPessoaController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                    console.log(data);


                    condicao = data.retorno;
                    tipoPessoa = data.dadosUsuario.dados[0]['idTipoPessoa'];


                    switch (tipoPessoa) {
                        case '5':
                            endereco = "areaSuperAdm.php";
                            break;
                        case '4':
                            endereco = "areaAdm.php";
                            break;
                            case '3':
                            endereco = "baixarSenhas.php";
                            break;

                        default:

                            endereco = "areaAdm.php";

                    }




                    if (condicao == false) {
                        //condição retornou false, a pessoa não ta cadastrada, abre o nome para gravar
                        $('#loginCPF').hide();
                        $('#confirmacao').delay('fast').fadeIn();
                        $('#mensagemConfirmacao').html('<b>Olá.</b> <br>Olá. Acesso negado!');

                    } else {
                        //condição retornou true, então pode seguir para o agendamento. ta fa

                        $('#loginCPF').hide();
                        $('#confirmacao').delay('fast').fadeIn();

                        $('#mensagemConfirmacao').html('<b>Olá.</b> <br>Vamos te redirecionar para<br> a Área Administrativa');

                        window.setTimeout(() => {
                            window.location = endereco;
                        }, 3600);



                    }


                });
            event.preventDefault();
        }
    </script>
</body>

</html>