<?php
    class Autor {
        public $cod_autor;
        public $nome;
        public $dt_nasc;

        function __construct($cod_autor, $nome, $dt_nasc){
            $this->cod_autor = $cod_autor;
            $this->nome = $nome;
            $this->dt_nasc = $dt_nasc;
        }
    }
?>