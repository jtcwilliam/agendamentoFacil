<?php



class Adm
{



    private $conexao;


    //mexer na conexão para retornar os dados conexao, usuario e senha


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





    public function  inserirAgendamento($todos)
    {
        try {




            $dsn = 'mysql:dbname=dbagenddev;host=dbagenddev.mysql.dbaas.com.br';
            $user = 'dbagenddev';
            $password = 'Sge@4@5';

            $pdo = new PDO($dsn, $user, $password);

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $sql = ('INSERT INTO   agendamento  ( dia ,  hora ,  idUnidade ,    idStatus ,  protocolo ,   idTipoAgendamento ) 
                                                        VALUES(:dia, :hora, :idUnidade,  :idStatus, :protocolo, :idTipoAgendamento )');

            $stmt = $pdo->prepare($sql);





            foreach ($todos as $key => $value) {
                $stmt->bindValue(':dia', $value['data'], PDO::PARAM_STR);
                $stmt->bindValue(':hora', $value['hora'], PDO::PARAM_STR);
                $stmt->bindValue(':idUnidade', $value['unidade'], PDO::PARAM_STR);

                $stmt->bindValue(':idStatus', $value['status'], PDO::PARAM_STR);
                $stmt->bindValue(':protocolo', $value['protocolo'], PDO::PARAM_STR);
                $stmt->bindValue(':idTipoAgendamento', $value['agendamento'], PDO::PARAM_STR);
                if ($stmt->execute()) {
                    echo "Sucesso";
                    echo $stmt->rowCount();
                } else {
                    echo "Falha";
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
