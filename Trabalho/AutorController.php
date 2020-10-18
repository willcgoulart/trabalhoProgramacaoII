<?php 

include_once('Autor.php');
include_once('AutorDAO.php');

class AutorController 
{

    public function listar($request, $response, $args)
    {
        $dao= new AutorDAO;    
        $autores = $dao->listar();

        $payload = json_encode($autores);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function buscarPorId($request, $response, $args)
    {
        $id = $args['id'];
        $dao= new AutorDAO;    
        $autores = $dao->buscarPorId($id);

        $payload = json_encode($autores);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function inserir($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $autor = new Autor(0,$data['nome'],$data['dt_nasc']);
    
        $dao = new AutorDAO;
        $autor = $dao->inserir($autor);
        $payload = json_encode($autor);
            
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
    }

    public function atualizar($request, $response, $args)
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $autor = new Autor($id,$data['nome'],$data['dt_nasc']);
    
        $dao = new AutorDAO;
        $autor = $dao->atualizar($autor);
        $payload = json_encode($autor);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }

    public function deletar($request, $response, $args)
    {
        $id = $args['id'];
        $dao = new AutorDAO;
        $autor = $dao->deletar($id);
        $payload = json_encode($autor);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }
    

}


?>