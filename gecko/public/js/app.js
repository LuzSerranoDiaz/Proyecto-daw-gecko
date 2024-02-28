$('#submitTask').on('click', function(e){
    let form = $(e.target).parent();
    let modal = $( "#exampleModal" );
    e.preventDefault();
    e.stopPropagation();
    $.ajax({
        url:'api/store_task',
        type:'POST',
        data:{
            title: form.find('#title').val(),
            desc: form.find('#desc').val(),
            color: form.find('#color').val(),
            solved: form.find('#solved').val(),
            position: form.find('#position').val(),
        },
        beforeSend: function(){
            // modal.attr('aria-hidden', 'true');
            $.loading().open();
        },
        success: function(){
            $.loading().close();
            modal.modal('toggle');
            $('.main-content').append('<div class="element"><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details">Show details</button></div></div>');
        },
    })
})
$('.show-task-details').on('click', function(e){
    let modal = $( "#commentsModal" );
    // let taskId = $(this).attr('id').split('-')[1];
    $.ajax({
        url:'api/comments/' + $(this).attr('id').split('-')[1],
        type:'GET',
        // data:{

        // },
        success: function(){
            modal.modal('open');
        }
    });
});