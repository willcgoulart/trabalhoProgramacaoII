class LivroAPIService {
    constructor(){
        this.uri = "http://localhost:8080/api/livros";
    }

    buscarLivros(ok, erro) {  
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if(this.status === 200) {
                    //Chama o método sucesso definido no carregarLivros() do controller
                    ok(JSON.parse(this.responseText));
                }
                else {
                    //Chama o método trataErro definido no carregarLivros() do controller
                    erro(this.status);
                }
            }
        };
        xhttp.open("GET", this.uri, true);
        xhttp.send();
    }

    enviarLivro(livro, ok, erro){
        console.log( livro );
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4){ 
                if(this.status === 201) {    
                    ok(JSON.parse(this.responseText))
                }
                else {
                    erro(this.status);
                }
            }
        };
        xhttp.open("POST", this.uri, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(livro));
        
    }

    deletarLivro(id,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("DELETE", this.uri+'/'+id, true);
        xhttp.send();
    }

}