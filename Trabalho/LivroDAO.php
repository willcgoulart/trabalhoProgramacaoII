<?php

include_once 'Livro.php';
include_once 'PDOFactory.php';

class LivroDAO
{
    public function listar()
    {
        try
        {
            $query = 'SELECT * FROM livros';
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $livros=array();
            
            while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                $livros[] = new Livro($row->cod_livro,$row->descri,$row->cod_autor,$row->status);
            }
            return $livros;
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
            $query = "SELECT * FROM livros WHERE cod_livro=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":id", $id);
            $comando->execute();
            $livros=array();
        
            while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                $livros[] = new Livro($row->cod_livro,$row->descri,$row->cod_autor,$row->status);
            }
            return $livros;
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function inserir(Livro $livro)
    {
        try{
            $query = "INSERT INTO livros (descri, cod_autor, status) VALUES (:descri, :cod_autor, :status)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":descri", $livro->descri);
            $comando->bindParam(":cod_autor", $livro->cod_autor);
            $comando->bindParam(":status", $livro->status);
            $comando->execute();
            $livro->id = $pdo->lastInsertId();
            return $livro;
        } 
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    function atualizar(Livro $livro)
    {  
        try
        {
            $query = "UPDATE livros SET descri=:descri, cod_autor=:cod_autor, status=:status WHERE cod_livro=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":id", $livro->cod_livro);
            $comando->bindParam(":descri", $livro->descri);
            $comando->bindParam(":cod_autor", $livro->cod_autor);
            $comando->bindParam(":status", $livro->status);
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
            $query = "DELETE FROM livros WHERE cod_livro=:id";
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