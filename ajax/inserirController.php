<?php

include_once '../classes/Pessoa.php';

$objPessoaMovimentar = new Pessoa();

//getNomePessoa() ."', '".$this->getTipoPessoa() ."', '".$this->getStatusPessoa() ."', '".$this->getDocumentoPessoa(


 

$objPessoaMovimentar->setNomePessoa($_POST['nomeUsuario']);
$objPessoaMovimentar->setTipoPessoa('1');
$objPessoaMovimentar->setStatusPessoa('1');
$objPessoaMovimentar->setDocumentoPessoa($_POST['cpf']);


if ($objPessoaMovimentar->inserirPessoasAgendamento()) {
    echo json_encode(array('retorno' => true));
}
