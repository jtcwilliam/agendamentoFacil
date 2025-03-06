<?php



class Unidade
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;


    private $idUnidade;
    private $nomeUnidade;
    private $statusUnidade;
    private $responsavelUnidade;


    //mexer na conexão para retornar os dados conexao, usuario e senha


    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();



        //  $dsn = 'mysql:dbname=dbagenddev;host=dbagenddev.mysql.dbaas.com.br';



        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        $dns = 'mysql:dbname=' . $objConectar->getDb() . ';host=' . $objConectar->getHost();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);

        $this->setDns($dns);

        $this->setUser($objConectar->getUser());

        $this->setPwd($objConectar->getPwd());
    }

    public function  carregarTodasUnidades()
    {
        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
              ));

             


            $stmt = $pdo->prepare("SELECT * FROM  unidade");
            $stmt->execute();

            //$user = $stmt->fetchAll();
        


            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }

 
            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }


                 

            return $dados;
 
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
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
     * Get the value of dns
     */
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * Set the value of dns
     *
     * @return  self
     */
    public function setDns($dns)
    {
        $this->dns = $dns;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the value of idUnidade
     */
    public function getIdUnidade()
    {
        return $this->idUnidade;
    }

    /**
     * Set the value of idUnidade
     *
     * @return  self
     */
    public function setIdUnidade($idUnidade)
    {
        $this->idUnidade = $idUnidade;

        return $this;
    }

    /**
     * Get the value of nomeUnidade
     */
    public function getNomeUnidade()
    {
        return $this->nomeUnidade;
    }

    /**
     * Set the value of nomeUnidade
     *
     * @return  self
     */
    public function setNomeUnidade($nomeUnidade)
    {
        $this->nomeUnidade = $nomeUnidade;

        return $this;
    }

    /**
     * Get the value of statusUnidade
     */
    public function getStatusUnidade()
    {
        return $this->statusUnidade;
    }

    /**
     * Set the value of statusUnidade
     *
     * @return  self
     */
    public function setStatusUnidade($statusUnidade)
    {
        $this->statusUnidade = $statusUnidade;

        return $this;
    }

    /**
     * Get the value of responsavelUnidade
     */
    public function getResponsavelUnidade()
    {
        return $this->responsavelUnidade;
    }

    /**
     * Set the value of responsavelUnidade
     *
     * @return  self
     */
    public function setResponsavelUnidade($responsavelUnidade)
    {
        $this->responsavelUnidade = $responsavelUnidade;

        return $this;
    }
}
