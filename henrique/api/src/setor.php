<?php
include_once 'bd/bd.php';

class Setor {

    private $banco;

    public function __construct(){
        $this->banco = new BD();
    }

    public function listarSetores(){
        try {
            $conexao = $this->banco->mysql();
            $query = $conexao->prepare("SELECT s.id,
                                               s.setor
                                               FROM setor s 
                                               ORDER BY id DESC
                                    ");
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

    public function cadastrarSetor(){
        try {
            $conexao = $this->banco->mysql();
            $query = $conexao->prepare("INSERT INTO setor (setor) 
                                        VALUES ('".$_POST['setor']."')");
            $query->execute();
            echo json_encode($conexao->lastInsertId());

        } catch (PDOException $e) {
            http_response_code(500);
            print "Error!: " . $e->getMessage();
            exit;
        } finally {
            $conexao = null;
        }
    }

    public function atualizarSetor(){
        try {
            $conexao = $this->banco->mysql();

            $query = $conexao->prepare("UPDATE setor SET setor = '".$_POST['setor']."' WHERE id = ".$_POST['id']);
            $query->execute();
            echo json_encode($query->rowCount());

        } catch (PDOException $e) {
            http_response_code(500);
            print "Error!: " . $e->getMessage();
            exit;
        } finally {
            $conexao = null;
        }
    }

}
?>
