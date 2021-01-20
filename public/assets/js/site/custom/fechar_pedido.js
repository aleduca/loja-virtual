$(document).ready(function(){

	var main_content = $("#main_content");
	var center_content = main_content.find('.center_content');
	var btn_fechar_pedido = center_content.find('#btn-fechar-pedido');
	var input_frete = center_content.find('#input-frete');

	btn_fechar_pedido.on('click', function(event){
		event.preventDefault();

		$.ajax({
			url:'/checkout',
			dataType:'json',
			beforeSend: function(){
				$(btn_fechar_pedido).text('Fechando pedido...');
			},
			success: function(retorno){
				if(retorno == 'empty'){
					$(btn_fechar_pedido).text('Fechar pedido');
					alertDefault('warning','Carrinho Vazio', 'Você precisa ter produtos no carrinho para fechar o pedido');

					// $.Zebra_Dialog('Você precisa ter produtos no carrinho para fechar o pedido.', 
					// {
					//     'type':     'information',
					//     'title':    'Produtos no carrinho'
					// });
				}

				if(retorno == 'notLoggedIn'){
					$(btn_fechar_pedido).text('Fechar pedido');
					alertNotLoggedIn('Não está logado','Você precisa estar logado para fechar o pedido');

					// $.Zebra_Dialog('Você precisa estar logado para fechar o pedido.', 
					// {
					//     'type':     'information',
					//     'title':    'Login',
					//     'buttons':  [
					//     	{caption: 'Ir para login', callback: function() { window.location.href = '/login' }}
					//     ]
					// });
				}

				if(retorno == 'frete'){
					$(btn_fechar_pedido).text('Fechar pedido');
					$(input_frete).focus();
					alertDefault('warning','Problema no Frete', 'Antes de fechar o pedido você deve calcular o frete');
					// $.Zebra_Dialog('Você precisa calcular o frete antes de fechar o pedido', 
					// {
					//     'type':     'information',
					//     'title':    'Calcular o frete',
					//     'buttons':  [
					//     	{caption: 'Fechar', callback: function() { $(input_frete).focus(); }}
					//     ]
					// });
				}

				if(retorno.redirecionar == 'sim'){
					alertDefault('success','Pedido Fechado !','Em 5 segundos você será redirecionado para finalizar a sua compra');
					setTimeout(function(){
						window.location.href = retorno.url;
					},3000);
				}

				if(retorno.redirecionar == 'erroCadastro'){
					alertDefault('error','Ocorreu um erro !','Ocorreu um erro ao tentar fechar o pedido, tente novamente, caso não consiga fechar o pedido, entre em contato conosco');
					// $.Zebra_Dialog('', 
					// {
					//     'type':     'error',
					//     'title':    'Erro'
					// });
				}

			}
		});
	});
});