class FormAutores {

    constructor(controller, seletor){
        this.autorController = controller;
        this.seletor = seletor;
    }

    montarForm(autor){
        if(!autor){
            autor = new Autor();

            var cod_autor = autor.cod_autor;
            var nome = autor.nome;
            var dt_nasc = autor.dt_nasc;
        }else{
            var cod_autor = autor[0].cod_autor;
            var nome = autor[0].nome;
            var dt_nasc = autor[0].dt_nasc;
        }
       
        var str = `
        <h2>Formulario de Autores</h2>
        <form id="formulario">
            <input type="hidden" id="cod_autor" value="${cod_autor}" />

            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Nome" value="${nome ? nome :''}">

            <label for="dt_nasc">Data de Nascimento</label>
            <input type="date" class="form-control" id="dt_nasc" placeholder="Nome" value="${dt_nasc ? dt_nasc :''}">

            <button type="submit" class="btn btn-default" id="btnsalvar"><i class="fa fa-floppy-o"></i> Cadastrar</button>
            <input type="reset" class="btn btn-default" value="Cancelar">
            <br />
        </form>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!autor.cod_autor){
                self.autorController.salvar(event);
            }
            else{
                self.autorController.editar(autor.cod_autor,event);
            }
        }

        form.onreset = function(event){
            self.autorController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#nome").value="";
        document.querySelector("#dt_nasc").value="";
    }
    
    getDataAutor(){
        let autor = new Autor();
        if(!document.querySelector("#cod_autor").value)
            autor.id = document.querySelector("#cod_autor").value;
            autor.nome = document.querySelector("#nome").value;
            autor.dt_nasc = document.querySelector("#dt_nasc").value;
        return autor;        
    }
    

}