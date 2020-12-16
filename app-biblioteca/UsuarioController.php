<?php 

use \Firebase\JWT\JWT;
use Slim\Psr7\Response;

include_once('Usuario.php');
include_once('UsuarioDAO.php');

class UsuarioController 
{
    private $secretKey = "teste@";

    public function inserir($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $usuario = new Usuario(0,$data['nome'],$data['login'],$data['senha']);
        $dao = new UsuarioDAO;
        $usuario = $dao->inserir($usuario);
        $payload = json_encode($usuario);
            
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
    }

    public function autenticar($request, $response, $args)
    {
        $user = $request->getParsedBody();
        
        $dao= new UsuarioDAO;    
        $usuario = $dao->buscarPorLogin($user['login']);
        if($usuario->senha == $user['senha'])
        {
            $token = array(
                'user' => strval($usuario->cod_user),
                'nome' => $usuario->nome
            );
            $jwt = JWT::encode($token, $this->secretKey);
            $payload = json_encode(["token" => $jwt],201);
            $response->getBody()->write($payload);
            return $response
                  ->withHeader('Content-Type', 'application/json');
        }
        else
            return $response->withStatus(401);
    }

    public function validarToken($request, $handler)
    {
        $response = new Response();
        $token = $request->getHeader('Authorization');
        
        if($token && $token[0])
        {
            try {
                $decoded = JWT::decode($token[0], $this->secretKey, array('HS256'));

                if($decoded){
                    $response = $handler->handle($request);
                    return($response);
                }
            } catch(Exception $error) {

                return $response->withStatus(401);
            }
        }
        
        return $response->withStatus(401);
    }



}