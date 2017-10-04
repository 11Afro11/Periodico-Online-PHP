

var nombre; //nombre del usuario
var forbidden = ["tonto", "imbecil", "gili", "noob", "rekt"]; //palabras baneadas
var correos = ["gmail", "yahoo", "hotmail"];	//dominios permitidos
var extensions = [".com", ".es", ".uk"];	//extensiones permitidas
var cens = ["&", "@", "%", "Ç", "*", "#"];	//caracteres de censura
var display = 0;

//función que crea un nuevo cuadro de textto par el comentario con el estilo predefinido
function Coment() {
	//recogemos el texto y calculamos su longitud
	SetName();
	var texto = document.getElementById("entrada").value;
	var lengt = texto.length;
	//si hay texto escrito
	if(nombre.length >0 && lengt > 0){
		// texto = Date() + "\n" + document.getElementById("entrada").value;
		//creamos el chat
		var chat = document.createElement("div");
		chat.id = "chat";

		//creamos la foto, genérica de momento
		var img = document.createElement("div")
		img.id = "user-photo";
		var imagen = document.createElement("img");
		imagen.src = "../Imagenes/icono.png";
		// añadimos la imagen a la clase img y luego añadimos esta al chat
		img.appendChild(imagen);
		chat.appendChild(img);

		//creamos el nombre
		var name = document.createElement("h4");
		name.id = "nomenclatura";
		var named = document.createTextNode(nombre);
		//añadimos el nombre al chat
		name.appendChild(named);
		chat.appendChild(name);

		// creamos la fecha
		var fecha = Date() + "";
		var dat = document.createElement("p");
		dat.id = "fecha";
		// Añadimos el nodo de la fecha al chat
		dat.appendChild(document.createTextNode(fecha));
		chat.appendChild(dat);

	    //creamos el mensaje a partir del texto introducido
	    var para = document.createElement("p");
	    para.id = "chat-message";
	    var node = document.createTextNode(texto);
	    //añadimos el texto al chat
	    para.appendChild(node);
	    chat.appendChild(para);

	    //insertamos el nuevo chat al principio de nuestro marco de comentario
	    var element = document.getElementById("chatlog");
		var child = document.getElementById("chat");
		element.insertBefore(chat, child);

	    document.getElementById("entrada").value = '';
	}
	else if(nombre.length == 0){
		alert("Debes indicar tu nombre");
	}
}

//función que asigna el nombre
function SetName(){
	nombre = document.getElementById("nombre").value;
}


function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        alert("Error: La dirección de correo " + email + " es incorrecta.");
        return false;
    }
    return true;

}


//función encargada de comprobar la correcta introducción del nombre y el correo
function Show(){
	if (display == 0){
		document.getElementById('chatbox').style.display = 'block';
		display = 1;
	}
	else{
		document.getElementById('chatbox').style.display = 'none';
		display = 0;
	}
}

//funcion censurador que se encarga de comprobar el texto escrito en busca de palabras baneadas para posteriormente cambiarlas
function Censurador(){
	var str = document.getElementById("entrada").value;
	if(str.includes("Ubisoft")){
		document.getElementById("entrada").value = str.replace("Ubisoft", "Bugisoft");
	}

	if(str.includes("gg izi")){
		document.getElementById("entrada").value = str.replace("gg izi", "Nice Game My Dear Friend");
	}
	var censurada = "";
	for(i = 0; i < forbidden.length; i++){
		if(str.includes(forbidden[i])){
			var censure = forbidden[i];
			var censure_time = censure.length;
			var tam = cens.length;
			
			for(j = 0; j < censure_time; j++){
				censurada = censurada + cens[j%tam];
			}
			// alert(censurada);
			document.getElementById("entrada").value = str.replace(censure, censurada); 
		}

	}
}

//función que añadirá un event listener para que compruebe el cuadro de texto
function Censura(){
	document.getElementById("entrada").addEventListener('onkeyup', Censurador());
}


$(document).ready(function () {
    $('#btnTweet').click(function (e) {
        alert('hello11');
        var textToTweet = "Hi I am tweeting from here";
        if (textToTweet.length > 140) {
            alert('Tweet should be less than 140 Chars');
        }
        else {
            var twtLink = 'http://twitter.com/home?status=' +encodeURIComponent(textToTweet);
            window.open(twtLink,'_blank');
        }
    });
});



function equalHeight(group1, group2){
	tallest = 0;
	if(group1.height() > group2.height()){
		tallest = group1.height();
	}
	else{
		tallest = group2.height();
	}
	group1.height(tallest);
	group2.height(tallest);
}

$(window).load(function(){
    equalHeight($(".mainfirst", ".lateral"));
});



function myFunction() {
    var txt;
    var person = prompt("Please enter your name:", "Harry Potter");
    if (person == null || person == "") {
        txt = "User cancelled the prompt.";
    } else {
        txt = "Hello " + person + "! How are you today?";
    }
    document.getElementById("demo").innerHTML = txt;
}


function redimensionar()
{
    alto = document.getElementsByClassName('.mainbox').offsetHeight;
    document.getElementsByClassName('.lateral').style.height = alto + 'px'
}

// var fragment = create('<div>Hello!</div><p>...</p>');
// // You can use native DOM methods to insert the fragment:
// document.body.insertBefore(fragment, document.body.childNodes[0]);