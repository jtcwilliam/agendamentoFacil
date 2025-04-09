<div class="grid-x grid-padding-x">
    <div class=" auto cell  ">
    </div>
    <div class="small-12 cell large-6">

    </div>
    <div class=" auto cell ">
    </div>

</div>

<script>
    $(function() {
        $(".datepicker").datepicker({
            showOn: "focus",
            dateFormat: "dd/mm/yy",
            dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        });
    });

    function mudarMascara(cpf) {


        var tamanho = cpf.length;
        if (tamanho >= 15) {
            $('.cpf').mask('00.000.000/0000-00');
        } else {
            $('.cpf').mask('000.000.000-000');
        }

    }

    //carregar combo das unidades
    function procuraHoras(dia, tipoExibicao, idUnidade) {

 

        var formData = {
            dia: dia,
            verificarHora: 1,
            tipoExibicao: tipoExibicao,
            idUnidade: idUnidade

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/agendamentoController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
              

                $('.comboHorarios').html(data);
                $('#horaDIV').show();
            });
    }

    function datasNaUnidade(tipoExibicao, idUnidade) {
        $('#aparecerDatas').html('<h4>Estamos consultando pra você</h4>');


        if (idUnidade == 0) {
            var idUnidade = $('#selectUnidade').val()
        } else {
            idUnidade = idUnidade
        }

        var formData = {
            datasDaUnidade: 1,
            tipoExibicao: tipoExibicao,
            idUnidade: idUnidade

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
                if (tipoExibicao == 0) {
                    $('#aparecerDatas').html(data);
                } else if (tipoExibicao == 1) {
                    $('#aparecerDatas').html(data);

                }

                

            });
    }

    function datasNaUnidadeAdm(tipoExibicao, idUnidade) {
        $('#aparecerDatas').html('<h4>Estamos consultando pra você</h4>');


        if (idUnidade == 0) {
            var idUnidade = $('#selectUnidade').val()
        } else {
            idUnidade = idUnidade
        }

        var formData = {
            datasDaUnidade: 1,
            tipoExibicao: tipoExibicao,
            idUnidade: idUnidade

        };

        $.ajax({
                type: 'POST',
                url: 'ajax/unidadeController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {


                // <label>Selecione a data de seu agendamento
                if (tipoExibicao == 0) {
                    $('#aparecerDatas').html(' <label>Selecione a data de seu agendamento' + data + "</label>");
                } else if (tipoExibicao == 1) {
                    $('#aparecerDatas').html(data);

                }

            });
    }

    function validaCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;




        strCPF = strCPF.replace('.', '');
        strCPF = strCPF.replace('.', '');

        strCPF = strCPF.replace('-', '');




        if (strCPF == "00000000000") return false;

        for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10))) return false;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11))) return false;
        return true;
    }

    function validaCNPJ(cnpj) {


        if (cnpj.length != 18) {
            return false;
        }

        var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
        var c = String(cnpj).replace(/[^\d]/g, '')

        if (c.length !== 14)
            return false

        if (/0{14}/.test(c))
            return false

        for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
        if (c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
            return false

        for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
        if (c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
            return false

        return true
    }

    function comboUnidadesComum() {

        var formData = {
            unidadesComum: 1
        };

        $.ajax({
                type: 'POST',
                url: 'ajax/unidadeController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {



                $('#selectUnidade').html('<option value="0">Selecione uma Unidade</option>' + data);

            });

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



                $('#selectUnidade').html(data);

            });

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



                //aqui muda as datas
                if (data.qtdeAgendamentos >= 2) {
                    $('#formularioAgendamento').hide();
                    $('#campoMensagemAgendamentosAtivos').show();

                }

                $('#agendamentosRealizadosAtivos').show();


                $('#valorAgendamentos').html('<b>' + data.qtdeAgendamentos + "</b>");

                $('#exibirAgendamentosAntigos').html(data.agendamentoAntigo);
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



                $('.selectTipoAgendamento').html(data);

            });

    }

    function listasDataUnidadeADM(unidadeUsuario) {
        var formData = {
            verificarDatasPorUnidade: 1,
            unidadeUsuario: unidadeUsuario
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/areaAdmController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);
                $('#analiseAgendas').html(data);
            });
    }


    function listasDataUnidadeSuperAdm(unidadeUsuario) {
        var formData = {
            trazerHorariosTodasUnidadesSuperAdm: 1,
            unidadeUsuario: unidadeUsuario
        };

        
        $.ajax({
                type: 'POST',
                url: 'ajax/areaSuperAdmController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);
                $('#analiseAgendas').html(data);
            });
    }

    function verificarDatasUnidadeADM(unidadeUsuario, dataDaUnidade) {
        var formData = {
            datasUnidadesADM: 1,
            unidadeUsuario: unidadeUsuario,
            dataDaUnidade: dataDaUnidade
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/areaAdmController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);
                $('#inforDatas').html(data);
            });
    }


    function verificarDatasUnidadeSuperAdm(unidadeUsuario, dataDaUnidade) {
        var formData = {
            datasUnidadesADM: 1,
            unidadeUsuario: unidadeUsuario,
            dataDaUnidade: dataDaUnidade
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/areaSuperAdmController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);
                $('#inforDatas').html(data);
            });
    }



    function verificarDatasAnaliticosDaUnidade(unidadeUsuario, dataDaUnidade) {

        //funciona melhor para o arquivo analitico dias
       
        var formData = {
            datasAnaliticoAdmSintetico: 1,
            unidadeUsuario: unidadeUsuario,
            dataDaUnidade: dataDaUnidade
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/analiticoDiasController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                
                $('#analiseAgendas').html(data);
            });
    }
</script>


<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>