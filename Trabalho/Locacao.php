<?php
    class Locacao {
        public $cod_locacao;
        public $cod_livro;
        public $matricula;
        public $data_retirada;
        public $data_programada_devolucao;
        public $data_devolvida;  

        function __construct($cod_locacao, $cod_livro, $matricula, $data_retirada,$data_programada_devolucao,$data_devolvida){
            $this->cod_locacao = $cod_locacao;
            $this->cod_livro = $cod_livro;
            $this->matricula = $matricula;
            $this->data_retirada = $data_retirada;
            $this->data_programada_devolucao = $data_programada_devolucao;
            $this->data_devolvida = $data_devolvida;
        }
    }
?>