$(document).ready(function(){

    //when user clicks video play button

    $('.like-btn').on('click',function(){
        var post_id = $(this).data('id');
        $clicked_btn = $(this);
        alert(post_id);
        //ajax code

        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id,
            }
        })
    })
})