<?php
include_once 'bd/bd.php';

class Rel{


        function funcionarioPorSetor(){
            
        }

        function funcionarioAtipo(){
            try {
                $conexao = $this->banco->mysql();
                $query = $conexao->prepare("select * from funcionario where bloqueado = 'S'");
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