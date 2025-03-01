<?php

include_once '../classes/Pessoa.php';

$objConsultar = new Pessoa();



$cpf = $_POST['cpf'];
 
 


 
    $dadoUsuario = $objConsultar->pesquisarCPF($cpf);




    echo json_encode(array('retornoCondicao' => $dadoUsuario));
 
 




