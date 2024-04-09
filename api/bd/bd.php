<?php


class BD{

    public function mysql(){
        $host = "localhost"; // Mudar para localhost
        $usuario = "root";
        $senha = 'senha'; // Mudar para sua senha
        $banco = "banco";

        try {
            $MySQL = new \PDO('mysql:host=' . $host . ';dbname=' . $banco, $usuario, $senha);
            $MySQL->exec("set names utf8");
            $MySQL->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); //habilitando erros do PDO
            return $MySQL;
        } catch (\PDOException $e) {
            echo json_encode(array(
                "status" => "ERRO: Não foi possível conectar no banco de dados! ".($e->getMessage())
            ));
            exit;
        }
        
    }
    
    public function oracle(){
            
        $host = 'loclahost';
        $porta = 'porta';
        $sid = 'sid';
        $usuario = 'usuario';
        $senha = 'senha';

        $tns = "(DESCRIPTION =
                        (ADDRESS_LIST =
                        (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $porta))
                        )
                        (CONNECT_DATA =
                        (SERVICE_NAME = $sid)
                        )
                    ); charset=AL32UTF8;";

        try{
            $oracle = new PDO("oci:dbname=".$tns, $usuario, $senha);
            return $oracle;
        }catch(PDOException $e){
            echo json_encode(array(
                "status" => "ERRO: Não foi possível conectar no banco de dados! ".($e->getMessage())
            ));
            exit;
        }
    }


}