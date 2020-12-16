<?php 

include_once('Livro.php');
include_once('LivroDAO.php');

class LivroController 
{

    public function listar($request, $response, $args)
    {
        $dao= new LivroDAO;    
        $livros = $dao->listar();

        $payload = json_encode($livros);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function buscarPorId($request, $response, $args)
    {
        $id = $args['id'];
        $dao= new LivroDAO;    
        $livros = $dao->buscarPorId($id);

        $payload = json_encode($livros);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function inserir($request, $response, $args)
    {
        $data = $request->getParsedBody();
        
        $livro = new Livro(0,$data['descri'],$data['cod_autor'],$data['status'],'','');
    
        $dao = new LivroDAO;
        $livro = $dao->inserir($livro);
        $payload = json_encode($livro);
            
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
    }

    public function atualizar($request, $response, $args)
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $livro = new Livro($id,$data['descri'],$data['cod_autor'],$data['status'],'','');
    
        $dao = new LivroDAO;
        $livro = $dao->atualizar($livro);
        $payload = json_encode($livro);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }

    public function deletar($request, $response, $args)
    {
        $id = $args['id'];
        $dao = new LivroDAO;
        $livro = $dao->deletar($id);
        $payload = json_encode($livro);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }
    

}


?>