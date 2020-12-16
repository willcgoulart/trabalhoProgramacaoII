class AutorController{  
    constructor() {
        this.autorService = new AutorAPIService(); 
        this.tabelaAutores = new TabelaAutores(this,"main");
        this.formAutores = new FormAutores(this,"main");
    } 

    inicializa(){
        this.carregarAutores();
    }

    carregarAutores(){   
        const self = this;
        //definição da função que trata o buscar produtos com sucesso
        const sucesso = function(autores){
            self.tabelaAutores.montarTabela(autores);
        }

        //definição da função que trata o erro ao buscar os livros
        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
        this.autorService.buscarAutores(sucesso, trataErro);
    }

    carregarFormulario(){
        event.preventDefault();
        this.formAutores.montarForm();
    }

    limpar(event){
        event.preventDefault();
        this.formAutores.limparFormulario();
        this.carregarAutores();
    }

    salvar(event){        
        event.preventDefault();
        var autor = this.formAutores.getDataAutor();        
        console.log("Autor", autor);

        this.salvarAutor(autor);
    }

    salvarAutor(autor){
        const self = this;

        const sucesso = function(autorCriado) {
            console.log("Autor Criado",autorCriado);
            self.carregarAutores();
            self.formAutores.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.autorService.enviarAutor(autor, sucesso, trataErro);    

    }

    deletarAutor(id, event){
        const self = this;
        this.autorService.deletarAutor(id, 
            //colocar direto a funcao no parametro
            //nao precisa criar a variavel ok e erro
            function() {
                self.carregarAutores();
            },
            function(status) { 
                console.log(status);
            }
        );
    }

    carregaFormularioComAutor(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(autor){
            self.formAutores.montarForm(autor);
        }
        const erro = function(status){
            console.log(status);
        }

        this.autorService.buscarAutor(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();
    
        let autor = this.formAutores.getDataAutor();
        
        const self = this;

        this.autorService.atualizarAutor(id,autor, 
            function() {
                self.formAutores.limparFormulario();
                self.carregarAutores();
            },
            function(status) {
                console.log(status);
            } 
        );

    }

    


}