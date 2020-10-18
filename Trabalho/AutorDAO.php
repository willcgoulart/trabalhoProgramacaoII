<?php
    include_once 'Autor.php';
	include_once 'PDOFactory.php';

    class AutorDAO
    {
        public function listar()
        {
            try
            {
                $query = 'SELECT * FROM autores';
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($query);
                $comando->execute();
                $autores=array();
                
                while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                    $autores[] = new Autor($row->cod_autor,$row->nome,$row->dt_nasc);
                }
                return $autores;
            }
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
            }
        }
        
        public function buscarPorId($id)
        {
            try
            {
                $query = "SELECT * FROM autores WHERE cod_autor=:id";
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($query);
                $comando->bindParam(":id", $id);
                $comando->execute();
                $autores=array();
            
                while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                    $autores[] = new Autor($row->cod_autor,$row->nome,$row->dt_nasc);
                }
                return $autores;
            }
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
            }
        }

        public function inserir(Autor $autor)
        {
            try{
                $query = "INSERT INTO autores (nome, dt_nasc) VALUES (:nome, :dt_nasc)";
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($query);
                $comando->bindParam(":nome", $autor->nome);
                $comando->bindParam(":dt_nasc", $autor->dt_nasc);
                $comando->execute();
                $autor->id = $pdo->lastInsertId();
                return $autor;
            } 
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
            }
        }

        function atualizar(Autor $autor)
        {  
            try
            {
                $query = "UPDATE autores SET nome=:nome, dt_nasc=:dt_nasc WHERE cod_autor=:id";
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($query);
                $comando->bindParam(":id", $autor->cod_autor);
                $comando->bindParam(":nome", $autor->nome);
                $comando->bindParam(":dt_nasc", $autor->dt_nasc);
                $comando->execute();
            } 
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
            }
        }

        public function deletar($id)
        {
            try
            {
                $query = "DELETE FROM autores WHERE cod_autor=:id";
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($query);
                $comando->bindParam(":id", $id);
                $comando->execute();
            } 
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
            }
        }



        
    }

?>