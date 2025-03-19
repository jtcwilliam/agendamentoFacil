<?php


$tipoPessoa = $_SESSION['usuarioLogado']['dados'][0]['tipoPessoa'];


switch ($tipoPessoa) {
    case '5':
        $link = 'areaSuperAdm.php';
        break;

    default:
        $link = 'areaSuperAdm.php';
        break;
}


?>



<div class="grid-x grid-padding-x">

    <div class="expanded button-group">
        <a class="button fundoBotoesTopo"><?php echo 'Usuario: ' . $_SESSION['usuarioLogado']['dados'][0]['nome']     ?></a>


        <a class="button fundoBotoesTopo" href="baixarSenhas.php">Check in Atendimento</a>
        <a class="button fundoBotoesTopo" href="agendaTelefonico.php">Agendamento Telefonico</a>

    </div>


</div>