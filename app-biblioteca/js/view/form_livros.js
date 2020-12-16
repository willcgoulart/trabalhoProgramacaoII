class FormLivros {

    constructor(controller, seletor){
        this.livroController = controller;
        this.seletor = seletor;
    }

    montarForm(autores,livro){
        if(!livro){
            livro = new Livro();
        }
        var str = `
        <h2>Formulario de Livros</h2>
        <form id="formulario">
            <input type="hidden" id="cod_livro" value="${livro.cod_livro}" />
            <label for="descri">Nome:</label>
            <input type="text" id="descri" value="${livro.descri ?livro.descri :''}">
            <input type="hidden" id="status" value="Livre">
            <br />
            <label for="valautor">Autor:</label>
            <select id="valautor">
        `;

        for(const autor of autores){
            str+=`<option id="${autor.cod_autor}">${autor.nome}</option>`;
        }

        str+= `
            </select>
            <br />
            <br />
            <input type="submit" id="btnsalvar" value="Salvar">
            <input type="reset" value="Cancelar">
            <br />
        </form>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        if(livro.autor && livro.autor.cod_livro){
            document.getElementById(livro.autor.cod_livro.toString()).selected = true;    
        }

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!livro.cod_livro){
                self.livroController.salvar(event);
            }
            else{
                self.livroController.editar(livro.cod_livro,event);
            }
        }

        form.onreset = function(event){
            self.livroController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#descri").value="";
    }

    getDataLivro(){
        let livro = new Livro();
        if(!document.querySelector("#cod_livro").value)
            livro.cod_livro = document.querySelector("#cod_livro").value;
            livro.descri = document.querySelector("#descri").value;
            livro.status = document.querySelector("#status").value;
        
        const sel = document.querySelector("#valautor");
        const opt = sel.options[sel.selectedIndex];
        livro.cod_autor = new Livro(opt.value);
        livro.cod_autor.id = opt.id;
        return livro;        
    }

}