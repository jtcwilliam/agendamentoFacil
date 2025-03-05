<?php



class DatasAgendamento
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;


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

    public function  trazerHorarios($data)
    {
        try {





            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd());

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $stmt = $pdo->prepare("SELECT * FROM agendamento WHERE dia=:id   and  idPessoa is null   and idStatus in (0 ,6)
            and (select count(idAgendamento) from agendamento where idstatus=3) <2 order by hora asc ");
            $stmt->execute(array('id' => $data));
            $user = $stmt->fetchAll();





            return $user;
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
}
