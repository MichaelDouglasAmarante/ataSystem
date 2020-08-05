<?php
    namespace App\Model;
    
    class Conexao{
        private static $conexao;
        
        public static function getConn(){
            if(!isset(self::$conexao)):
                try{
                    self::$conexao = new \PDO('mysql:host=localhost;dbname=db_atasystem;charset=utf8','root','');
                    self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    echo "Database error: ".$e->getMessage();
                }catch(Exception $e){
                    echo "Generic error: ".$e->getMessage();
                }
            endif;
            
            return self::$conexao;
        }
    }
?>