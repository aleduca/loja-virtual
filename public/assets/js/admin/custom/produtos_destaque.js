$(document).ready(function(){

    $('.row-produto').on('click','.produto-destaque', function(event){
        event.preventDefault();

        var id = $(this).attr('data-id');

        $.ajax({
            url:'/adminProdutosDestaque',
            type:'post',
            data:"id="+id,
            success: function(retorno){

                if(retorno == 'updated'){
                    swal('Atualizado','Status do destaque atualizado','success');
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });

    });

});