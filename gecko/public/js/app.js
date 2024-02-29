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
        success: function(response){
            $.loading().close();
            modal.modal('toggle');
            $('.main-content').append('<div class="element" id="Task-'+response.task_id+'"><button class="delete-task" id="deleteTask-'+response.task_id+'" onclick="return confirm(\'¿Eliminar esta tarea?\')"><i class="fa-solid fa-square-xmark"></i></button><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#desc').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="taskDetails-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#commentsModal-'+response.task_id+'">Mostrar detalles</button><button class="edit-task" id="taskDetails-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#editModal-'+response.task_id+'">Editar</button></div></div>');
        },
    })
})
$('body').on('click', '.submitTask', function(e){
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
        success: function(response){
            $.loading().close();
            modal.modal('toggle');
            $("#Task-"+id).html('<h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="task-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button><button class="delete-task" id="task-'+response.task_id+'">Eliminar</button></div>');
            // $('.main-content').append('<div class="element" id="Task-"><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="task-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button><button class="delete-task" id="task-'+response.task_id+'">Eliminar</button><button class="show-task-details" id="taskDetails-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#editModal-'+response.task_id+'">Editar</button></div>');
        },
    })
})
// $('body').on('click', '.show-task-details' , function(){
//     // let modal = $( "#commentsModal" );
//     try {
//         $.ajax({
//             url:'api/comments/' + $(this).attr('id').split('-')[1],
//             type:'GET',
//             success: function(){
//                 // modal.modal('open');
//             },
//             error: function(){
//                 return ;
//             }
//         });
//     } catch (error) {
//         return ;
//     }
    
// });
$('body').on('click', '.delete-task' , function(e){
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