<?php
    class Usuario {
        public $cod_user;
        public $nome;
        public $login;
        public $senha;

        function __construct($cod_user, $nome, $login, $senha){
            $this->cod_user = $cod_user;
            $this->nome = $nome;
            $this->login = $login;
            $this->senha = $senha;
        }
    }
?>