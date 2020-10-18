<?php 

include_once('Locacao.php');
include_once('LocacaoDAO.php');

class LocacaoController 
{
    public function listar($request, $response, $args)
    {
        $dao= new LocacaoDAO;    
        $locacoes = $dao->listar();

        $payload = json_encode($locacoes);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function buscarPorId($request, $response, $args)
    {
        $id = $args['id'];
        $dao= new LocacaoDAO;    
        $livros = $dao->buscarPorId($id);

        $payload = json_encode($livros);
        
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json');
    }

    public function inserir($request, $response, $args)
    {
        $data = $request->getParsedBody();
        
        $locacao = new Locacao(0,$data['cod_livro'],$data['matricula'],$data['data_retirada'],$data['data_programada_devolucao'],$data['data_devolvida']);
    
        $dao = new LocacaoDAO;
        $locacao = $dao->inserir($locacao);
        $payload = json_encode($locacao);
            
        $response->getBody()->write($payload);
        return $response
                  ->withHeader('Content-Type', 'application/json')
                  ->withStatus(201);
    }

    public function atualizar($request, $response, $args)
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $locacao = new Locacao($id,$data['cod_livro'],$data['matricula'],$data['data_retirada'],$data['data_programada_devolucao'],$data['data_devolvida']);
    
        $dao = new LocacaoDAO;
        $locacao = $dao->atualizar($locacao);
        $payload = json_encode($locacao);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }

    public function deletar($request, $response, $args)
    {
        $id = $args['id'];
        $dao = new LocacaoDAO;
        $livro = $dao->deletar($id);
        $payload = json_encode($livro);
        
        $response->getBody()->write($payload);
        return $response
              ->withHeader('Content-Type', 'application/json');
    }

}