(function(){

	var main_content = $("#main_content");
	var center_content = main_content.find(".center_content");
	var message = center_content.find("#message");
	var email = center_content.find("#email_esqueci_senha");
	var btn_esqueci_senha = center_content.find("#btn-esqueci-senha");

	btn_esqueci_senha.on('click', function(event){

		event.preventDefault();

		var emailEsqueciSenha = email.val();

		$.ajax({
			url:'/esqueci/send',
			data:'email='+emailEsqueciSenha,
			type:'post',
			beforeSend: function(){
				message.html('Recuperando dados, aguarde');
			},
			success: function(retorno){

				message.html('');

				if(retorno == 'erro'){
					location.reload();
					email.val('');
				}

				if(retorno == 'user'){
					alertDefault('warning','Usuário não encontrado','Não encontramos seu email em nossa base de dados.');
					email.val('');
				}

				if(retorno == 'enviado'){
					alertDefault('success','Email enviado','Enviamos um email para o email digitado, clique no link e atualize sua senha');
					email.val('');
				}

			}
		});
	});

})();