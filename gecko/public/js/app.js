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
            $('.main-content').append('<div class="modal fade" id="commentsModal-'+response.task_id+'" tabindex="-1" aria-labelledby="commentsModal-'+response.task_id+'" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Comentarios</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div></div></div></div>')
            // $('.main-content').append('<div class="modal fade" id="editModal-'+response.task_id+'" tabindex="-1" aria-labelledby="editModal-'+response.task_id+'" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Modal title</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form method="post">@csrf<label for="title">Titulo</label><input name ="title" id="title" type="text" value="'+form.find('#title').val()+'"><label for="desc">Descripcion</label><input name ="desc" id="desc" type="text" value="'+form.find('#desc').val()+'"><label for="color">Color</label><input name="color" id="color" type="number" value="'+form.find('#color').val()+'"><label for="solved">Solved</label><input name="solved" id="solved" type="number" value="'+form.find('#solved').val()+'"><label for="position">Position</label><input name="position" id="position" type="number" value="'+form.find('#position').val()+'"><button type="submit" class="submitTask" id="submitTask-'+response.task_id+'">submit</button></form></div></div></div></div>');
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
            $("#Task-"+id).html('<button class="delete-task" id="deleteTask-'+id+'" onclick="return confirm("¿Eliminar esta tarea?")"><i class="fa-solid fa-square-xmark"></i></button><h3 class="task-title">'+form.find('#title').val()+'</h3><span class="task-comment">'+form.find('#title').val()+'</span><div class="tasks-btns"><button class="show-task-details" id="taskDetails-'+id+'" data-bs-toggle="modal" data-bs-target="#commentsModal-'+id+'">Mostrar detalles</button><button class="edit-task" id="taskDetails-'+id+'" data-bs-toggle="modal" data-bs-target="#editModal-'+id+'">Editar</button></div>')
            $("#editModal-"+id).html('<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Modal title</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form method="post">@csrf<label for="title">Titulo</label><input name ="title" id="title" type="text" value="'+ form.find('#title').val() +'"><label for="desc">Descripcion</label><input name ="desc" id="desc" type="text" value="'+ form.find('#desc').val() +'"><label for="color">Color</label><input name="color" id="color" type="number" value="'+ form.find('#color').val() +'"><label for="solved">Solved</label><input name="solved" id="solved" type="number" value="'+ form.find('#solved').val() +'"><label for="position">Position</label><input name="position" id="position" type="number" value="'+ form.find('#color').val() +'"><button type="submit" class="submitTask" id="submitTask-'+id+'">submit</button></form></div></div></div>');
        },
    })
})
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