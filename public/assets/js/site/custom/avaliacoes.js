$(document).ready(function () {

    var content = $("#content");
    var btn_avaliacao_estrelas = content.find('.btn-avaliacao-estrelas');

    btn_avaliacao_estrelas.on('click', function (event) {
        event.preventDefault();
        var data = $(this).attr('data-id');

        $.ajax({
            url: '/avaliacoes/avaliarComEstrelas',
            type: 'POST',
            dataType: 'json',
            data: 'data=' + JSON.parse(data),
            success: function (retorno) {
                console.log(retorno);
                if (retorno == 'NaoLogado') {
                    alert('Você precisa estar logado para avaliar esse produto');
                    return false;
                }

                if (retorno == 'atualizou') {
                    toastr.info('Você atualizou sua nota do produto');
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }

                if (retorno == 'avaliou') {
                    toastr.success('Você avaliou o produto');
                    setTimeout(function () {
                        location.reload();
                    }, 3000)
                }

                console.log(retorno);
            }
        });

    });

});