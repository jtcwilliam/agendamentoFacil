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


    public function  trazerHorariosAdmPorUnidade($data)
    {
        try {
            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            $stmt = $pdo->prepare("SELECT date_format(dia, '%d/%m/%Y')   as dia  FROM agendamento 
            where idStatus in (7 ,6, 3)  and dia >= CURDATE()   and idUnidade= :idUnidade group by dia  ");
            $stmt->execute(array('idUnidade' => $data));

             

            $user = $stmt->fetchAll();

            return $user;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    


    public function  trazerHorarios($data)
    {
        try {
            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            $stmt = $pdo->prepare("SELECT *,  date_format(dia, '%d/%m/%Y')   as dia  FROM agendamento WHERE date_format(dia, '%d/%m/%Y') = :diaAgendamento    
              and idStatus in (7 ,6, 3)   order by hora asc ");
            $stmt->execute(array('diaAgendamento' => $data));

            $user = $stmt->fetchAll();

            print_r($stmt);

            return $user;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  verificarDatasNaUnidade($idUnidade)
    {
        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $stmt = $pdo->prepare("SELECT DATE_FORMAT(dia , '%d/%m/%Y') as dia,   idunidade  FROM agendamento where dia >= CURDATE()   and  idunidade = :idunidade and idPessoa is null  group by (dia) ");
            $stmt->execute(array('idunidade' => $idUnidade));
            $datasDisponiveis = $stmt->fetchAll();

            if (empty($datasDisponiveis)) {
                return array('retorno' => '0');
            } else {
                $datasDisponiveis['retorno'] = '1';
                return $datasDisponiveis;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    //consultas da area administrativa
    public function  trazerHorariosADM($data)
    {
        try {
            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            $stmt = $pdo->prepare("SELECT * FROM agendamento WHERE dia=:diaAgendamento      and idStatus in (0 ,6, 3)   order by hora asc ");
            $stmt->execute(array('diaAgendamento' => $data));

            $user = $stmt->fetchAll();

            return $user;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //consultas da area administrativa
    public function  verificarDatasNaUnidadeADM($idUnidade)
    {
        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $stmt = $pdo->prepare("SELECT dia,   idunidade  FROM agendamento where idunidade = :idunidade   group by (dia) ");
            $stmt->execute(array('idunidade' => $idUnidade));
            $datasDisponiveis = $stmt->fetchAll();



            return $datasDisponiveis;
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
