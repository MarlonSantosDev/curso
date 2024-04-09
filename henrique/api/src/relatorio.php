<?php
include_once 'bd/bd.php';

class Relatorio {

    private $banco;

    public function __construct(){
        $this->banco = new BD();
    }

    public function relatorioFuncionario(){
        try {
            $conexao = $this->banco->mysql();
            $query = $conexao->prepare("SELECT f.matricula, f.nome AS nome_funcionario, f.bloqueado, s.id AS id_setor, s.setor AS nome_setor
                                        FROM funcionario f
                                        INNER JOIN setor s ON f.id_setor = s.id
                                        ORDER BY f.matricula DESC");
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);

            echo json_encode($result);

        } catch (PDOException $e) {
            http_response_code(500);
            print "Error!: " . $e->getMessage();
            exit;
        } finally {
            $conexao = null;
        }
    }
}

$relatorio = new Relatorio();
$relatorio->relatorioFuncionario();
?>
