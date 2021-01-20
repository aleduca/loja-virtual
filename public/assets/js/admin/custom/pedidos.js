$(document).ready(function(){

    var content = $('.content');
    var btn_ver_produtos_pedido = content.find('.btn-ver-produtos-pedido');

    btn_ver_produtos_pedido.on('click', function(event){
        event.preventDefault();

        var id = $(this).attr('data-id');

        $.ajax({
            url:'/AdminPedidosProdutos',
            data:'id='+id,
            type:'post',
            dataType:'json',
            success:function(retorno){
                var produtos = '<table class="table table-striped">';
                produtos += '<thead>';
                produtos += '<thead>';
                    produtos += '<tr>';
                        produtos += '<td>Produto</td>';
                        produtos += '<td>Quantidade</td>';
                        produtos += '<td>Valor</td>';
                    produtos +='</tr>';    
                produtos += '</thead>';

                produtos += '<tbody>';
                
                $.each(retorno.produtos, function(key,value){
                    var valor = value.produto_valor;
                    produtos += '<tr>';
                        produtos += '<td>'+value.produto_nome+'</td>';
                        produtos += '<td>'+retorno.quantidade[value.id]+'</td>';
                        produtos += '<td>'+numeral(value.produto_valor).format('$0,0.00')+'</td>';
                    produtos += '</tr>';
                });
                produtos += '</tbody>';
                produtos += '</table>';

                swal({
                  title: "Produtos de Pedido",
                  text: produtos,
                  html: true
                });
            }
        });

    });

});