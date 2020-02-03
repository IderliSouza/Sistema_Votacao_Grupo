$(document).ready(function () {
	$(document.getElementById('simples')).click(function () {
		$("#bloco_customizado").hide(500);
		$("#bloco_simples").show(500);
		var valor = document.getElementById('nItem').value;
		document.getElementById('parametro').value = valor;
		document.getElementById('nItem').remove();
	});

	$(document.getElementById('customizado')).click(function () {
		$("#bloco_customizado").show(500);
		$("#bloco_simples").hide(500);
		var valor = document.getElementById('nItem').value;
		document.getElementById('parametro').value = valor;
		document.getElementById('nItem').remove();
	});
});


$(document).ready(function () {
	var lista = $("#lista_campos");
	var addCampo = $("#add_campo");

	$(addCampo).click(function (e) {
		$(lista).append('<li><input type="text" required="true" class="campo" /> <button class="bt_remover_campo">x</button></li>');
	});

	$(lista).on("click", ".bt_remover_campo", function (e) {
		e.preventDefault();
		$(this).parent('li').remove();
	})
});


function addCampoComEnter() {
	if (event.keyCode == 13) {
		document.getElementById('add_campo').click();
		document.getElementByNameClass('campo').focus();
		return false;
	}
}

function myFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav") {
		x.className += " responsive";
	} else {
		x.className = "topnav";
	}
}
