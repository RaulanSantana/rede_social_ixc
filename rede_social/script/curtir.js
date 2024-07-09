$(document).ready(function(){
    $('.curtir-btn').click(function(event){
        event.preventDefault();
        var post_id = $(this).data('id');
        var action = $(this).data('action');
        var button = $(this);
        var user_id = button.data('user-id');

        $.ajax({
            url: 'func/' + action + '.php',
            type: 'GET',
            data: { id: post_id, id_usuario: user_id },
            success: function(response){
                var likeCount = $('.like-count[data-id="' + post_id + '"]');
                if(action == 'curtir'){
                    button.text('Descurtir');
                    button.data('action', 'descurtir');
                    button.removeClass('btn-primary').addClass('btn-secondary');
                    likeCount.text(parseInt(likeCount.text()) + 1);
                } else {
                    button.text('Curtir');
                    button.data('action', 'curtir');
                    button.removeClass('btn-secondary').addClass('btn-primary');
                    likeCount.text(parseInt(likeCount.text()) - 1);
                }
            },
            error: function() {
                console.error('Erro ao curtir/descurtir a postagem');
            }
        });
    });
});
