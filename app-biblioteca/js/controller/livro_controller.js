class LivroController{  
    constructor() {
        this.autorService = new AutorAPIService(); 
        this.livroService = new LivroAPIService(); 
        this.tabelalivros = new TabelaLivros(this,"main");
        this.formLivros = new FormLivros(this,"main");

    } 

    inicializa(){
        this.carregarLivros();
    }

    carregarLivros(){   
        const self = this;
        //definição da função que trata o buscar produtos com sucesso
        const sucesso = function(livros){
            self.tabelalivros.montarTabela(livros);
        }

        //definição da função que trata o erro ao buscar os livros
        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
        this.livroService.buscarLivros(sucesso, trataErro);
    }

    carregarFormulario(){
        event.preventDefault();

        const self = this;
        this.autorService.buscarAutores(
            function(autores) 
            { 
                self.formLivros.montarForm(autores); 
            },
            function(statusCode) {
                console.log("Erro - status:",statusCode);
            }
        )
        
    }

    limpar(event){
        event.preventDefault();
        this.formLivros.limparFormulario();
        this.carregarLivros();
    }
    
    salvar(event){        
        event.preventDefault();
        var livro = this.formLivros.getDataLivro();        
        console.log("Livro", livro);

        this.salvarLivro(livro);

    }

    salvarLivro(livro){
        const self = this;

        const sucesso = function(livroCriado) {
            console.log("Livro Criado",livroCriado);
            self.carregarLivros();
            self.formProdutos.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.livroService.enviarLivro(livro, sucesso, trataErro);    
    }

    deletarLivro(id, event){
        const self = this;
        this.livroService.deletarLivro(id, 
            //colocar direto a funcao no parametro
            //nao precisa criar a variavel ok e erro
            function() {
                self.carregarLivros();
            },
            function(status) { 
                console.log(status);
            }
        );
    }


    

    


}