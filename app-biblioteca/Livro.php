<?php
    class Livro {
        public $cod_livro;
        public $descri;
        public $cod_autor;
        public $status;
        public $nome;
        public $dt_nasc;

        function __construct($cod_livro, $descri, $cod_autor, $status, $nome, $dt_nasc){
            $this->cod_livro = $cod_livro;
            $this->descri = $descri;
            $this->cod_autor = $cod_autor;
            $this->status = $status;
            $this->nome = $nome;
            $this->dt_nasc = $dt_nasc;
        }
    }
?>