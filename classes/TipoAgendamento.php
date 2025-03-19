<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class TipoAgendamento
{



    private $conexao;
    private $idTipoAgendamento;
    private $tipoAtendamentocol;




    function __construct()
    {
        include_once 'Conexao.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);
    }



    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }

        /**
     * Get the value of idTipoAgendamento
     */ 
    public function getIdTipoAgendamento()
    {
        return $this->idTipoAgendamento;
    }

    /**
     * Set the value of idTipoAgendamento
     *
     * @return  self
     */ 
    public function setIdTipoAgendamento($idTipoAgendamento)
    {
        $this->idTipoAgendamento = $idTipoAgendamento;

        return $this;
    }

    /**
     * Get the value of tipoAtendamentocol
     */ 
    public function getTipoAtendamentocol()
    {
        return $this->tipoAtendamentocol;
    }

    /**
     * Set the value of tipoAtendamentocol
     *
     * @return  self
     */ 
    public function setTipoAtendamentocol($tipoAtendamentocol)
    {
        $this->tipoAtendamentocol = $tipoAtendamentocol;

        return $this;
    }
    



    public function  carregartipoAgendamento()
    {
        $sql = "SELECT * FROM  tipoAgendamento where idTipoAgendamento in (1,2,4)";

 


        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        $dados = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $dados;
    }


}
