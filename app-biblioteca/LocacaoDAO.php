<?php

include_once 'Locacao.php';
include_once 'PDOFactory.php';

class LocacaoDAO
{
    public function listar()
    {
        try
        {
            $query = 'SELECT * FROM locacoes';
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $locacoes=array();
            
            while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                $locacoes[] = new Locacao($row->cod_locacao,$row->cod_livro,$row->matricula,$row->data_retirada,$row->data_programada_devolucao,$row->data_devolvida);
            }
            return $locacoes;
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
            $query = "SELECT * FROM locacoes WHERE cod_locacao=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":id", $id);
            $comando->execute();
            $locacoes=array();
        
            while($row = $comando->fetch(PDO::FETCH_OBJ)){ 
                $locacoes[] = new Locacao($row->cod_locacao,$row->cod_livro,$row->matricula,$row->data_retirada,$row->data_programada_devolucao,$row->data_devolvida);
            }
            return $locacoes;
        }
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function inserir(Locacao $locacao)
    {
        try{
            $query = "INSERT INTO locacoes (cod_livro, matricula, data_retirada, data_programada_devolucao, data_devolvida) 
            VALUES (:cod_livro, :matricula, :data_retirada, :data_programada_devolucao, :data_devolvida)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":cod_livro", $locacao->cod_livro);
            $comando->bindParam(":matricula", $locacao->matricula);
            $comando->bindParam(":data_retirada", $locacao->data_retirada);
            $comando->bindParam(":data_programada_devolucao", $locacao->data_programada_devolucao);
            $comando->bindParam(":data_devolvida", $locacao->data_devolvida);
            $comando->execute();
            $locacao->id = $pdo->lastInsertId();
            return $locacao;
        } 
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    function atualizar(Locacao $locacao)
    {  
        try
        {
            $query = "UPDATE locacoes SET cod_livro=:cod_livro, matricula=:matricula, data_retirada=:data_retirada, 
            data_programada_devolucao=:data_programada_devolucao, data_devolvida=:data_devolvida
            WHERE cod_locacao=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":id", $locacao->cod_locacao);
            $comando->bindParam(":cod_livro", $locacao->cod_livro);
            $comando->bindParam(":matricula", $locacao->matricula);
            $comando->bindParam(":data_retirada", $locacao->data_retirada);
            $comando->bindParam(":data_programada_devolucao", $locacao->data_programada_devolucao);
            $comando->bindParam(":data_devolvida", $locacao->data_devolvida);
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
            $query = "DELETE FROM locacoes WHERE cod_locacao=:id";
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