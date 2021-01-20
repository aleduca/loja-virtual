$(document).ready(function(){

    $('.row-produto').on('click','.produto-presente', function(event){
        event.preventDefault();

        var id = $(this).attr('data-id');

        $.ajax({
            url:'/adminProdutosPresente',
            type:'post',
            data:"id="+id,
            success: function(retorno){

                if(retorno == 'updated'){
                    swal('Atualizado','Status do produto como presente atualizado','success');
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });

    });

});