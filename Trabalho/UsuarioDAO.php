<?php

include_once 'Usuario.php';
include_once 'PDOFactory.php';

class UsuarioDAO
{
    public function inserir(Usuario $usuario)
    {
        try{
            $query = "INSERT INTO usuarios (nome, login, senha) VALUES (:nome, :login, :senha)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":nome", $usuario->nome);
            $comando->bindParam(":login", $usuario->login);
            $comando->bindParam(":senha", $usuario->senha);
            $comando->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        } 
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }

    public function buscarPorLogin($login)
    {
        try{
            $query = "SELECT * FROM usuarios WHERE login = :login";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(":login", $login);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new Usuario($result->cod_user,$result->nome,$result->login,$result->senha);
        } 
        catch(PDOException $e)
        {
            echo "Statement failed: " . $e->getMessage();
        }
    }
}