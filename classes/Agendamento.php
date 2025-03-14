<?php



class Agendamento
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $idPessoas;
    private $idStatus;
    private $idAgendamento;
    private $idUnidade;
    private $idTipoAgendamento;


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



    public function  verificarAgendamentosUnidadeData($idUnidade, $datas)
    {
        try {
            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $stmt = $pdo->prepare(" SELECT  count(ag.idstatus) as qtde, ag.idstatus, st.descricaoStatus from agendamento  ag inner join status st on ag.idstatus = st.idstatus  
            where   date_format(dia, '%d/%m/%Y')  = :diaAgendamento  and  idunidade = :idUnidade  and ag.idstatus in(7,3)  group by idstatus order by ag.idstatus asc  ");

            $stmt->execute(array('idUnidade' => $idUnidade, ':diaAgendamento' => $datas));


            $datasDisponiveis = $stmt->fetchAll();
 

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }







    public function  verificarAgendamentosAtivos($idPessoa, $idStatus)
    {
        try {
            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $stmt = $pdo->prepare(" SELECT *, date_format(dia, '%d/%m/%Y')   as dia from agendamento ag inner join pessoas ps on ps.idpessoas = ag.idpessoa inner join
             unidade un on un.idUnidade = ag.idUnidade  where idpessoa = :idPessoa and ag.idStatus = :idStatus order by ag.dia asc  ");
            $stmt->execute(array('idPessoa' => $idPessoa, 'idStatus' => $idStatus));
            $datasDisponiveis = $stmt->fetchAll();
            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  registrarAgendamentoUsuario()
    {
        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd());

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE agendamento SET idPessoa = :idPessoa , idStatus = :idStatus ,  idUnidade= :idUnidade, idTipoAgendamento= :idTipoAgendamento    where idAgendamento= :idAgendamento  ";


            $data = [
                ':idPessoa' =>      $this->getIdPessoas(),
                ':idStatus' =>       $this->getIdStatus(),
                ':idAgendamento' =>  $this->getIdAgendamento(),
                ':idUnidade' => $this->getIdUnidade(),
                ':idTipoAgendamento' => $this->getIdTipoAgendamento()

            ];

            $stmt = $pdo->prepare($sql);



            if ($stmt->execute($data)) {
                return true;
            }
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
     * Get the value of idPessoas
     */
    public function getIdPessoas()
    {
        return $this->idPessoas;
    }

    /**
     * Set the value of idPessoas
     *
     * @return  self
     */
    public function setIdPessoas($idPessoas)
    {
        $this->idPessoas = $idPessoas;

        return $this;
    }

    /**
     * Get the value of idStatus
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Set the value of idStatus
     *
     * @return  self
     */
    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    /**
     * Get the value of idAgendamento
     */
    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }

    /**
     * Set the value of idAgendamento
     *
     * @return  self
     */
    public function setIdAgendamento($idAgendamento)
    {
        $this->idAgendamento = $idAgendamento;

        return $this;
    }

    /**
     * Get the value of unidade
     */


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
}
