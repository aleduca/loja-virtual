$(document).ready(function(){

    var btn_promocao = $(".btn-promocao");
    
    var btn_tirar_promocao = $(".btn-tirar-promocao");

    $(".row-produto").on('click','.btn-promocao',function(event){
        event.preventDefault();

        var id = $(this).attr('data-id');

        var td = $(this).closest('td');

        td.html('<input type="text" data-id="'+id+'" name="promocao" class="input-promocao"><button type="button" class="btn btn-xs btn-danger btn-colocar-promocao">Colocar em promoção</button>');

    });

    $(".row-produto").on('click','.btn-colocar-promocao' ,function(event){
        event.preventDefault();

        var td = $(this).closest("td");
        var input_promocao = td.find('.input-promocao').val();
        var id = td.find('.input-promocao').attr('data-id');

        if(input_promocao.length <= 0){
            swal('Alerta !', 'Você precisa colocar um valor para a promoção','warning');
            td.html('<button type="button" class="btn btn-xs btn-success btn-promocao" data-id="'+id+'">Promoção</button>');
            return false;
        }

        $.ajax({
            url:'/adminProdutosPromocao',
            type:'post',
            data:"id="+id+"&promocao="+input_promocao,
            success: function(retorno){
                if(retorno == 'updated'){
                    swal('Atualizado','Produto está em promoção pelo valor de '+input_promocao,'success');
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });
    });

    btn_tirar_promocao.on('click',function(event){
        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url:'/adminProdutosPromocao/promocao',
            type:'post',
            data:"id="+id,
            success: function(retorno){
                if(retorno == 'updated'){
                    swal('Atualizado','Produto foi tirado da promoção','success');
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });
    });
});