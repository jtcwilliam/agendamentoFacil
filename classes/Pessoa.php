<?php



class Pessoa
{




    private $sqlQuery;

    private $idPessoas;
    private $nomePessoa;
    private $tipoPessoa;
    private $statusPessoa;
    private $documentoPessoa;
    private $senha;




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



    public function  pesquisarCPF($cpf)
    {

        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            $stmt = $pdo->prepare("select * from pessoas where documentoPessoa =:cpf   ");

            $stmt->execute(array(':cpf' => $cpf));

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i=0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;

            }
             

            if (empty($dados)) {
                $retorno['condicao'] = 'false';
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    ///fazer essa classe igual a da backup pessoa

    /*
        $sql = "   INSERT INTO  pessoas ( `nomePessoa`, `tipoPessoa`,`statusPessoa`, `documentoPessoa`) 
            VALUES ('" . $this->getNomePessoa() . "',  '" . $this->getTipoPessoa() . "', '" . $this->getStatusPessoa() . "', '" . $this->getDocumentoPessoa() . "');";
*/
    public function  inserirPessoasAgendamento()
    {
        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd());

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("  INSERT INTO  pessoas ( nomePessoa, tipoPessoa,statusPessoa, documentoPessoa) 
            values (:nomePessoa, :tipoPessoa, :statusPessoa, :documentoPessoa) ");



            $stmt->bindValue(':nomePessoa',  $this->getNomePessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':tipoPessoa', $this->getTipoPessoa() , PDO::PARAM_STR );
            $stmt->bindValue(':documentoPessoa', $this->getDocumentoPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':statusPessoa', $this->getStatusPessoa(), PDO::PARAM_STR);

        

            if ($stmt->execute()) {
                return true;
            }


          
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  logarPessoa()
    {


       

        try {

            $pdo = new PDO($this->getDns(), $this->getUser(), $this->getPwd(), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

        

          

            $stmt = $pdo->prepare("select  ps.nomePessoa as 'nome', un.nomeUnidade as 'nomeUnidade', st.descricaoStatus as 'descricaoStatus' , 
            tp.descricaoTipoPessoa as 'tipoPessoa', ps.pwd, ps.documentoPessoa  as 'documentoPessoa',  
            ps.*, st.*, tp.*, un.* from pessoas ps 
            inner join unidade un on un.responsavelUnidade = ps.idPessoas 
            inner join status st on st.idStatus = ps.statusPessoa  
            inner join tipoPessoa tp on tp.idTipoPessoa = ps.tipoPessoa 
            where documentoPessoa = '" . $this->getDocumentoPessoa() . "'  and pwd= '" . $this->getSenha() . "'");

          

            $stmt->execute();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
            }

            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
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
    
    /**
     * Get the value of sqlQuery
     */
    public function getSqlQuery()
    {
        return $this->sqlQuery;
    }

    /**
     * Set the value of sqlQuery
     *
     * @return  self
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;

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
     * Get the value of nomePessoa
     */
    public function getNomePessoa()
    {
        return $this->nomePessoa;
    }

    /**
     * Set the value of nomePessoa
     *
     * @return  self
     */
    public function setNomePessoa($nomePessoa)
    {
        $this->nomePessoa = $nomePessoa;

        return $this;
    }

    /**
     * Get the value of tipoPessoa
     */
    public function getTipoPessoa()
    {
        return $this->tipoPessoa;
    }

    /**
     * Set the value of tipoPessoa
     *
     * @return  self
     */
    public function setTipoPessoa($tipoPessoa)
    {
        $this->tipoPessoa = $tipoPessoa;

        return $this;
    }

    /**
     * Get the value of statusPessoa
     */
    public function getStatusPessoa()
    {
        return $this->statusPessoa;
    }

    /**
     * Set the value of statusPessoa
     *
     * @return  self
     */
    public function setStatusPessoa($statusPessoa)
    {
        $this->statusPessoa = $statusPessoa;

        return $this;
    }

    /**
     * Get the value of documentoPessoa
     */
    public function getDocumentoPessoa()
    {
        return $this->documentoPessoa;
    }

    /**
     * Set the value of documentoPessoa
     *
     * @return  self
     */
    public function setDocumentoPessoa($documentoPessoa)
    {
        $this->documentoPessoa = $documentoPessoa;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
