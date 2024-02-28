$('#submitTask').on('click', function(e){
    let form = $(e.target).parent();
    let modal = $( "#taskModal" );
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
            $('.main-content').append('<div class="element"><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="task-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button><button class="delete-task" id="task-{{ $task->id }}">Eliminar</button></div></div>');
        },
    })
})
$('.submitTask').on('click', function(e){
    let form = $(e.target).parent();
    let id = $(this).attr('id').split('-')[1];
    let modal = $( "#editModal-"+id);
    e.preventDefault();
    e.stopPropagation();
    $.ajax({
        url:'api/update_task/'+id,
        type:'PUT',
        data:{
            title: form.find('#title').val(),
            desc: form.find('#desc').val(),
            color: form.find('#color').val(),
            solved: form.find('#solved').val(),
            position: form.find('#position').val(),
        },
        beforeSend: function(){
            $.loading().open();
        },
        success: function(){
            $.loading().close();
            modal.modal('toggle');
            $("#Task-"+id).html('<h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="task-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button><button class="delete-task" id="task-{{ $task->id }}">Eliminar</button></div>');
            // $('.main-content').append('<div class="element" id="Task-"><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="task-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button><button class="delete-task" id="task-{{ $task->id }}">Eliminar</button><button class="show-task-details" id="taskDetails-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#editModal-{{ $task->id }}">Editar</button></div>');
        },
    })
})
$('.show-task-details').on('click', function(){
    // let modal = $( "#commentsModal" );
    $.ajax({
        url:'api/comments/' + $(this).attr('id').split('-')[1],
        type:'GET',
        // success: function(){
        //     modal.modal('open');
        // }
    });
});
$('.delete-task').on('click', function(e){
    $id=$(this).attr('id').split('-')[1];
    $.ajax({
        url:'api/delete_task/' + $(this).attr('id').split('-')[1],
        type:'DELETE',
        beforeSend: function(){
            $.loading().open();
        },
        success: function(){
            $.loading().close();
            $("#Task-"+$id).remove();
        },
    });
});