<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


include_once('AutorController.php');
include_once('LivroController.php');
include_once('LocacaoController.php');
include_once('UsuarioController.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->group('/api/autores', function($app){
    $app->get('', 'AutorController:listar');
    $app->post('', 'AutorController:inserir');
    $app->get('/{id}', 'AutorController:buscarPorId');    
    $app->put('/{id}', 'AutorController:atualizar');
    $app->delete('/{id}', 'AutorController:deletar');
})->add('UsuarioController:validarToken');

$app->group('/api/livros', function($app){
    $app->get('', 'LivroController:listar');
    $app->post('', 'LivroController:inserir');
    $app->get('/{id}', 'LivroController:buscarPorId');    
    $app->put('/{id}', 'LivroController:atualizar');
    $app->delete('/{id}', 'LivroController:deletar');
})->add('UsuarioController:validarToken');

$app->group('/api/locacoes', function($app){
    $app->get('', 'LocacaoController:listar');
    $app->post('', 'LocacaoController:inserir');
    $app->get('/{id}', 'LocacaoController:buscarPorId');    
    $app->put('/{id}', 'LocacaoController:atualizar');
    $app->delete('/{id}', 'LocacaoController:deletar');
})->add('UsuarioController:validarToken');

$app->post('/api/usuarios', 'UsuarioController:inserir')->add('UsuarioController:validarToken');
$app->post('/api/login', 'UsuarioController:autenticar');


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("<h1>Olaaa!</h1> 
                                <p>http://localhost:8080/api/autores</p>
                                <p>http://localhost:8080/api/livros</p>
                                <p>http://localhost:8080/api/locacoes</p>");
    return $response;
});

$app->run();