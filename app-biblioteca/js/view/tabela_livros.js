class TabelaLivros {
    constructor(controller, seletor){
        this.livroController = controller;
        this.seletor = seletor;
    }

    montarTabela(livros){

        var str=`
        <section>
            <h1 class="text-center fonte-titulo cor-especial pt-5">Lista de Livros</h1>
            <button type="button" id='novo' class="btn btn-primary btn-sm">Novo</button>
        </section>
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Nome Autor</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>
            </tr>
        </thead>
        <tbody>`;

        for(var i in livros){
            str+=`<tr id=${livros[i].cod_livro}>
                    <td>${livros[i].descri}</td>
                    <td>${livros[i].nome}</td>
                    <td>${livros[i].status}</td>
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
            self.livroController.carregarFormulario(event);
        }
        
        
        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.livroController.deletarLivro(id);
            }
        }
         /*
        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.livroController.carregaFormularioComProduto.bind(this.livroController,id));
        },*/
        

    }


}