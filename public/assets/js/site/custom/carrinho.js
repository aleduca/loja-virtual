$(document).ready(function () {

// divs do carrinho no top
    var top = $("#top");
    var header = top.find('#header');
    var items = header.find('.items');
    var price = header.find('.price');

//    divs do botao para adicionar no carrinho
    var btn_add_carrinho = $(".addcart");

//    divs da pagina carrinho
    var content = $('#content');
    var btn_deletar_produto = content.find('.btn-deletar-produto');
    var btn_alterar_quantidade = content.find('.btn-alterar-quantidade');

    function totalProdutosCarrinho() {

        return $.ajax({
            url: '/carrinho/getCart',
            dataType: 'json',
            success: function (retorno) {
                items.html(retorno.numeroProdutosCarrinho + ' items');
                price.html('R$ ' + retorno.valorProdutosCarrinho);
            }

        });
    }

    btn_add_carrinho.on('click', function (event) {
        event.preventDefault();
        var idProduto = $(this).attr('data-id');

        var esta_no_carrinho = $(this).closest('.product-price').prev().find('.esta-no-carrinho');

        $.ajax({
            url: '/carrinho/add/' + idProduto,
            type: 'POST',
            success: function (retorno) {
                totalProdutosCarrinho();
                if (retorno == 'adicionado') {
                    esta_no_carrinho.html(`<p class="esta-no-carrinho">  <i class="fa fa-shopping-cart"></i> produto está no carrinho</p>`);
                }
            }
        });
    });


//    deletar produto do carrinho
    btn_deletar_produto.on('click', function (event) {
        event.preventDefault();

        var idProduto = $(this).attr('data-id');

        $.ajax({
            url: '/carrinho/excluir',
            type: 'POST',
            data: 'id=' + idProduto,
            success: function (retorno) {
                if (retorno == 'excluido') {
                    location.reload();
                }
            }
        });
    });

//    alterar quantidade do produto no carrinho
    btn_alterar_quantidade.on('click', function (event) {
        event.preventDefault();

        var idProduto = $(this).attr('data-id');
        var qtd = $(this).prev('.qtd').val();

        $.ajax({
            url: '/carrinho/update',
            type: 'POST',
            data: 'id=' + idProduto + '&qtd=' + qtd,
            success: function (retorno) {
                if (retorno == 'atualizado') {
                    location.reload();
                }

                if (retorno == 'semestoque') {
                    alert('Não temos essa quantidade do produto no estoque');
                    setTimeout(function () {
                        location.reload();
                    }, 100)
                }
            }
        });
    });

});

