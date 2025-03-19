<div class="grid-x grid-padding-x">

        <div class="expanded button-group">
            <a class="button fundoBotoesTopo"><?php  echo 'Usuario: '. $_SESSION['usuarioLogado']['dados'][0]['nome']     ?></a>
            <a class="button fundoBotoesTopo" href="areaAdm.php"> Criar Agendas para o <b> <?=$_SESSION['usuarioLogado']['dados'][0]['nomeUnidade']?></b></a>
            <a class="button fundoBotoesTopo" href="baixarSenhas.php">Check in Atendimento</a>
          
        </div>


    </div>