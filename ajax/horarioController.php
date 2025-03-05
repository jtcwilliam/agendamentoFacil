<?php



include_once '../classes/Adm.php';

$objAdm = new Adm();
//todas as variasveis vinda do post
$ultimoHorario = $_POST['ultimoHorario'];
$qtdeMesas = $_POST['qtdeMesas'];
$dataAgendamento = $_POST['dataAgendamento'];
$unidade = $_POST['selectUnidade'];
$i = 1;
$selectTipoAgendamento = $_POST['selectTipoAgendamento'];

//array que sera enviado para o banco
$envio = array();


//para cada mesa disponivel
while ($i <= $qtdeMesas) {
    $primeiroHorario = $_POST['primeiroHorario'];


    //o sistema cria o horário e insere no array
    while ($primeiroHorario <= $ultimoHorario) {

        $todos = array();

        $todos['data'] =  $dataAgendamento;
        $todos['hora'] = $primeiroHorario;
        $todos['unidade'] = $unidade;

        $todos['status'] = 1;
        $todos['protocolo'] = rand(1, 1907367) . '/2025';
        $todos['agendamento'] = $selectTipoAgendamento;

        array_push($envio, $todos);

        $primeiroHorario++;
    }


    $i++;
}


//aqui manda para a classe do banco inserir
$objAdm->inserirAgendamento($envio);
