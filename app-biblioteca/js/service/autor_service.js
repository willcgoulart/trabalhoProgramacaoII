class AutorAPIService {
    constructor(){
        this.uri = "http://localhost:8080/api/autores";
    }

    buscarAutores(ok, erro) {  
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

    enviarAutor(autor, ok, erro){
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
        xhttp.send(JSON.stringify(autor));  
    }

    deletarAutor(id,ok,error) {

        console.log( this.uri+'/'+id );
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

    buscarAutor(id,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("GET", this.uri+'/'+id, true);
        xhttp.send();
    }

    atualizarAutor(id,autor,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("PUT", this.uri+'/'+id, true);
        xhttp.setRequestHeader("Content-Type","application/json")
        xhttp.send(JSON.stringify(autor));
    }

}