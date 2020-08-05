<?php
    namespace App\Model;
    require_once './../../vendor/autoload.php';
    
    use \GUMP;
    ##Insert::registerUser('user','email@gmail.com','1234');
    
    class Insert{

        
        public static function registerUser($name,$email,$passwd){
            $rules = [
                'name' => 'required|max_len,100|min_len,3',
                'email' => 'required|max_len,150|valid_email',
                'passwd' => 'required|max_len,20|min_len,4'
            ];
            $user_data = [
                'name' => $name,
                'email' => $email,
                'passwd' => $passwd
            ];
            $is_valid = GUMP::is_valid($user_data,$rules);

            if($is_valid === true):
                    $sql = 'INSERT INTO usuario(nome,email,senha) VALUES(?,?,?)';
                    $insert = Conexao::getConn()->prepare($sql);
                    $insert->bindValue(1,$user_data['name']);
                    $insert->bindValue(2,$user_data['email']);
                    $insert->bindValue(3,$user_data['passwd']);
                    
                
                    $insert->execute();
            else:
                print_r($is_valid);
            endif;
        }
        
        public static function insertCompany($name,$description){
            $rules = [
                'name' => 'required|max_len,100|min_len,2',
                'description' => 'required|max_len,150|min_len,2'
            ];
            $company_date = [
                'name' => $name,
                'description' => $description
            ];

            $is_valid = GUMP::is_valid($company_date,$rules);

            if($is_valid === true):
                $sql = 'INSERT INTO empresa(nome,descricao) VALUES(?,?)';
                $insert = Conexao::getConn()->prepare($sql);
                $insert->bindValue(1,$company_date['name']);
                $insert->bindValue(2,$company_date['description']);

                $insert->execute();
            else:
                print_r($is_valid);
            endif;    
        }

        public static function insertEmployee($idUser, $idCompany, $position){
            $rules = [
                'idUser' => 'required|min_len,1|integer',
                'idCompany' => 'required|min_len,1|integer',
                'position' => 'required|min_len,2|alpha'
            ];
            $employee_date = [
                'idUser' => $idUser,
                'idCompany' => $idCompany,
                'position' => $position
            ];

            $is_valid = GUMP::is_valid($employee_date,$rules);

            if($is_valid === true):
                $sql = 'INSERT INTO funcionario(id_usuario_fk,id_empresa_fk,cargo) VALUES (?,?,?)';
                $insert = Conexao::getConn()->prepare($sql);
                $insert->bindValue(1,$employee_date['idUser']);
                $insert->bindValue(2,$employee_date['idCompany']);
                $insert->bindValue(3,$employee_date['position']);

                $insert->execute();
            else:
                print_r($is_valid);
            endif;
        }
        
       
    } 
    
    
?>