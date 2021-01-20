$(document).ready(function() {

    var content = $('.content');
    var btn_alterar_estoque = content.find('.btn-alterar-estoque');

    btn_alterar_estoque.on('click', function(event) {
        event.preventDefault();

        var form_estoque = $(this).closest('#form-estoque');

        swal({
                title: "Tem certeza ?",
                text: "Ao alterar oe stoque o valor será afetado no site",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, pode alterar !",
                closeOnConfirm: false,
                timer: 4000, 
            },
            function() {
                $.post('/adminEstoque/update/',form_estoque.serialize()).done(function(response) {
                    if(response == 'atualizado'){
                        swal("Atualizado !", "O estoque foi atualizado", "success");
                    }

                    if(response == 'error'){
                        swal("Atualizado !", "ocorreu um erro ao atualizar o estoque, tente novamente !!", "danger");
                    }

                    if(response == 'required'){
                        location.reload();
                    }
                });
            });


       
    });

});