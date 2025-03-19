<?php

include_once '../classes/Pessoa.php';

$objPessoaMovimentar = new Pessoa();

//esse script apenas grava a pessoa



$objPessoaMovimentar->setDocumentoPessoa($_POST['cpf']);

$objPessoaMovimentar->setPwd(md5($_POST['pwd']));

if ($dadosPessoa = $objPessoaMovimentar->logarPessoa()) {


 




    //se condição true, pode logar

    if ($dadosPessoa['condicao']) {
        session_start();
        $_SESSION['usuarioLogado'] = $dadosPessoa;
        echo json_encode(array('retorno' => true, 'dadosUsuario' => $dadosPessoa));
    } else {
        echo json_encode(array('retorno' => false));
    }



    //se condição false, retorna erro

}
