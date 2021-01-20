$(document).ready(function () {

    var main_content = $("#main_content");
    var btn_calcular_frete = main_content.find('#btn-calcular-frete');
    var input_frete = main_content.find('#input-frete');
    var mensagem_frete = main_content.find('#mensagem-frete');

    btn_calcular_frete.on('click', function (event) {
        event.preventDefault();

        var frete = input_frete.val();
        $.ajax({
            url: '/frete/calcular',
            type: 'post',
            data: 'frete=' + frete,
            dataType: 'json',
            beforeSend: function () {
                mensagem_frete.html('Calculando o frete');
            },
            success: function (retorno) {
                
                if (retorno == 'login') {
                    alertNotLoggedIn('Não está logado !','Você precisa estar logado para calcular o frete');
                    // $.Zebra_Dialog('Você precisa estar logado para calcular o frete.', 
                    // {
                    //     'type':     'information',
                    //     'title':    'Login'
                    // });
                    mensagem_frete.html('');
                }

                if (retorno == 'produto') {
                    alertDefault('warning','Nenhum produto no carrinho !','Você precisa ter produtos no carrinho para calcular o frete.');
                    mensagem_frete.html('');
                    // $.Zebra_Dialog('Você precisa ter produtos no carrinho para calcular o frete.', 
                    // {
                    //     'type':     'information',
                    //     'title':    'Produtos no Carrinho'
                    // });
                }

                if (retorno.erro == 'sim') {
                    alertDefault('warning',retorno.mensagem);
                    mensagem_frete.html('');
                    // $.Zebra_Dialog(retorno.mensagem, 
                    // {
                    //     'type':     'information',
                    //     'title':    'Calcular frete'
                    // });
                }

                if (retorno.erro == 'nao') {
                    location.reload();
                }
            }
        });
    });
});