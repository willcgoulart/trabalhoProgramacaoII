class TabelaAutores {
    constructor(controller, seletor){
        this.autorController = controller;
        this.seletor = seletor;
    }

    montarTabela(autores){

        var str=`
        <section>
            <h1 class="text-center fonte-titulo cor-especial pt-5">Lista de Autores</h1>
            <button type="button" id='novo' class="btn btn-primary btn-sm">Novo</button>
        </section>
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento Autor</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>
            </tr>
        </thead>
        <tbody>`;

        for(var i in autores){
            str+=`<tr id=${autores[i].cod_autor}>
                    <td>${autores[i].nome}</td>
                    <td>${autores[i].dt_nasc}</td>
                    <td><a class="edit" href="#"><i class="fa fa-edit"></i></a></td>
                    <td><a class="delete" href="#"><i class="fa fa-bitbucket"></i></a></td>    
                </tr>`;     
        } 
        str+= `
        </table>
        </div>`;
    
        var tabela = document.querySelector(this.seletor);
        tabela.innerHTML = str;
       
        
        const self = this;
        const linkNovo = document.querySelector("#novo");
        linkNovo.onclick = function(event) {
            self.autorController.carregarFormulario(event);
        }
         
        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.autorController.deletarAutor(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.autorController.carregaFormularioComAutor.bind(this.autorController,id));
        }

    }
}