<?php
include_once 'bd/bd.php';

class Setor{

    private $banco;

    public function __construct(){
        $this->banco = new BD();
    }

    public function listarSetor(){
        try {
            $conexao = $this->banco->mysql();
            $query = $conexao->prepare("select * from setor");
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

    public function cadastro_setor(){
        try {
            $conexao = $this->banco->mysql();
            $query = $conexao->prepare("INSERT INTO setor (setor) VALUES ('".$_POST['nome']."')");
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

}