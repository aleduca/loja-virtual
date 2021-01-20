function alertDefault(tipo,titulo, mensagem){
	swal({
		  title: titulo,
		  text: mensagem,
		  type: tipo,
		  confirmButtonColor: "#DD6B55",
		  closeOnConfirm: false
	});
}

function alertNotLoggedIn(titulo, mensagem){
	swal({
		  title: titulo,
		  text: mensagem,
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sim, ir para página de Login",
		  closeOnConfirm: false
	},
	function(){
	  	window.location.href = '/login';
	});
}

function alertHtml(titulo, mensagem, classe){
	swal({
	  title: titulo,
	  text: mensagem,
	  html: true,
	  customClass: classe,
	});
}