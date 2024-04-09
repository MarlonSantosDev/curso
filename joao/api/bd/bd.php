<?php


class BD{

    public function mysql(){
        $host = "127.0.0.1"; 
        $usuario = "root";
        $senha = '123456'
        $banco = "curso";

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

        
        // $MySQL = mysqli_connect($host, $usuario, $senha, $banco);
        // return $MySQL;
        // if (!$conn) {
        //     echo json_encode(array(
        //         "status" => "ERRO: Não foi possível conectar no banco de dados! ".($e->getMessage())
        //     ));
        //     exit;
        // }
    }
    
    public function oracle(){
            
        $host = '127.0.0.1';
        $porta = '3306';
        $sid = 'wint';
        $usuario = 'root';
        $senha = '123456';

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