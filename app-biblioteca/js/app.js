const livroController =  new LivroController();
const autorController =  new AutorController();

var body = document.querySelector("body");
body.onload = function () {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}

document.querySelector("#home").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}


document.querySelector("#livros").onclick = function() {
    livroController.inicializa();
}

document.querySelector("#autores").onclick = function() {
    autorController.inicializa();
}

document.querySelector("#sobre").onclick = function() {
    document.querySelector("main").innerHTML = "<h2 id='sobreText'>App desenvolvido por William Goulart</h2>";
}
