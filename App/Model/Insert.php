<?php
    namespace App\Model;
    require_once './../../vendor/autoload.php';
    
    use \GUMP;
    ##Insert::insertUser('user','email@gmail.com','1234');
    
    class Insert{

        
        public static function insertUser($name,$email,$passwd){
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
                'name' => 'required|max_len,50|min_len,2',
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
        
       
        public static function insertMeeting($date, $local, $startTime, $endTime, $topic, $status, $idCompany){
            $rules = [
                'date' => 'required|date,d/m/Y',
                'local' => 'required|min_len,2|max_len,20|alpha_numeric',
                'startTime' => 'required|',
                'endTime' => 'required|',
                'topic' => 'required|min_len,2|max_len,20|alpha_numeric',
                'status' => 'required|min_len,2|max_len,10|Alfa',
                'idCompany' => 'required|numeric|integer'
            ];

            $meeting_date = [
                'date' => $date,
                'local' => $local,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'topic' => $topic,
                'status' => $status,
                'idCompany' => $idCompany 
            ];

            $is_valid = GUMP::is_valid($meeting_date,$rules);

            if($is_valid === true):
                $sql = 'INSERT INTO reuniao(data,local,horario_inicio,previsao_termino,pauta,status,id_empresa_fk) VALUES (?,?,?,?,?,?,?)';
                $insert = Conexao::getConn()->prepare($sql);
                $insert->bindValue(1,$date);
                $insert->bindValue(2,$local);
                $insert->bindValue(3,$startTime);
                $insert->bindValue(4,$endTime);
                $insert->bindValue(5,$topic);
                $insert->bindValue(6,$status);
                $insert->bindValue(7,$idCompany);

                $insert->execute();
            else:
                print_r($is_valid);
            endif;
        }

        public static function insertEmployeeMeeting($idEmployee,$idMeeting,$status){
            $rules = [
                'idEmployee' => 'required|numeric|integer',
                'idMeeting' => 'required|numeric|integer',
                'status' => ''
            ];

            $EmployeeMeeting_data = [
                'idEmployee' => $idEmployee,
                'idMeeting' => $idMeeting,
                'status' => 'required|min_len,2|max_len,10|Alfa'
            ];

            $is_valid = GUMP::is_valid($EmployeeMeeting_data, $rules);

            if($is_valid === true):
                $sql = 'INSERT INTO funcionario_reuniao(id_funcionario_fk, id_reuniao_fk, status) VALUES (?,?,?)';
                $insert = Conexao::getConn()->prepare($sql);
                $insert->bindValue(1,$idEmployee);
                $insert->bindValue(2,$idMeeting);
                $insert->bindValue(3,$status);

                $insert->execute();

            else:
                print_r($is_valid);
            endif;
        }

        public static function insertAta($text, $idMeeting){
            $rules = [
                'text' => 'required|min_len,5|max_len,2000|alpha_numeric',
                'idMeeting' => 'required|numeric|integer'
            ];

            $ata_data = [
                'text' => $text,
                'idMeeting' => $idMeeting
            ];

            $is_valid = GUMP::is_valid($ata_data, $rules);

            if($is_valid === true):
                $sql = 'INSERT INTO ata(texto,id_reuniao_fk) VALUES (?,?)';
                $insert = Conexao::getConn()->prepare($sql);
                $insert->bindValue(1,$text);
                $insert->bindValue(2,$idMeeting);

                $insert->execute();

            else:
                print_r($is_valid);
            endif;
        }

    } 
    
    
?>