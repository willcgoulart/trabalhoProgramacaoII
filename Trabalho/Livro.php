<?php
    class Livro {
        public $cod_livro;
        public $descri;
        public $cod_autor;
        public $status;

        function __construct($cod_livro, $descri, $cod_autor, $status){
            $this->cod_livro = $cod_livro;
            $this->descri = $descri;
            $this->cod_autor = $cod_autor;
            $this->status = $status;
        }
    }
?>