$('#submitTask').on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    let form = $(e.target).parent();
    let modal = $( "#taskModal" );
    let elementColor;
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
            $.loading().open();
        },
        success: function(response){
            $.loading().close();
            modal.modal('toggle');
            $('.main-content').append('<div class="element-container"><div class="element" draggable="true" id="Task-'+response.task_id+'" data-position="{{ $task->position }}" aria-hidden="false"><div class="color-'+form.find('#color').val()+'"></div><button class="delete-task" id="deleteTask-'+response.task_id+'"><i class="fa-solid fa-square-xmark"></i></button><i class="fa-solid fa-x solve-task" id="task-'+response.task_id+'"></i><h3 class="task-title">'+form.find('#title').val()+'</h3><div class="task-comment-container"><span class="task-comment"> '+form.find('#desc').val()+'</span></div><div class="tasks-btns"><button class="show-task-details" id="taskDetails-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#commentsModal-'+response.task_id+'">Mostrar detalles</button><button class="edit-task" id="taskDetails-'+response.task_id+'" data-bs-toggle="modal" data-bs-target="#editModal-'+response.task_id+'">Editar</button></div></div></div>')
            $('.main-content').append('<div class="modal fade" id="commentsModal-'+response.task_id+'" tabindex="-1" aria-labelledby="commentsModal-'+response.task_id+'" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Comentarios</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"></div></div></div></div>')
            $('.main-content').append('<div class="modal fade" id="editModal-'+response.task_id+'" tabindex="-1" aria-labelledby="editModal-'+response.task_id+'" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Modal title</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><form method="post"><div class="form-group"><label for="title">Titulo</label><input class="form-control" name ="title" id="title" type="text" value="'+form.find('#title').val()+'"><label for="desc">Descripcion</label><input class="form-control" name ="desc" id="desc" type="text" value="'+form.find('#desc').val()+'"><label for="color">Color</label><select class="form-select" name="color" id="color"><option value="1">Rojo</option><option value="2">Amarillo</option><option value="3">Verde</option></select><button class="btn btn-primary submitTask" type="submit" id="submitTask-'+response.task_id+'">submit</button></div></form></div></div></div></div>');
        },
    });
});

$('body').on('click', '.submitTask', function(e){
    e.preventDefault();
    e.stopPropagation();
    let form = $(e.target).parent();
    let id = $(this).attr('id').split('-')[1];
    let modal = $( "#editModal-"+id);
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
            switch (form.find('#color').val()){
                case '1': elementColor ='background-color: red'; break;
                case '2': elementColor = 'background-color: yellow';break;
                case '3': elementColor = 'background-color: green';break;
                default: elementColor = 'background-color: yellow';
            }
            $.loading().close();
            modal.modal('toggle');
            $('#Task-'+id).find('.task-title').text(form.find('#title').val());
            $('#Task-'+id).find('.task-comment').text(form.find('#desc').val());
            $('#Task-'+id).find('.color').attr('style', elementColor);
        },
    });
});

$('body').on('click', '.delete-task' , function(e){
    if (confirm('Are you sure?') === true) {
        let id=$(this).attr('id').split('-')[1];
        $.ajax({
            url:'api/delete_task/' + id,
            type:'DELETE',
            beforeSend: function(){
                $.loading().open();
            },
            success: function(){
                $.loading().close();
                $("#Task-" + id).parent().remove();
            },
        });
    }
});

$('body').on('click', '.solve-task', function(e){
    let id = $(this).attr('id').split('-')[1],
        target = $(e.target);
    $.ajax({
        url: 'api/solve_task/' + id,
        type: 'GET',
        beforeSend: function(){
            $.loading().open();
        },
        success: function(){
            if ($(target).hasClass('fa-check')) {
                $(target).removeClass('fa-check');
                $(target).addClass('fa-x');
            } else {
                $(target).removeClass('fa-x');
                $(target).addClass('fa-check');
            }
            $.loading().close();
        },
    })
});

const elements = document.querySelectorAll(".element");
const containers = document.querySelectorAll(".element-container");

elements.forEach((element) => {
  element.addEventListener("dragstart", dragStart);
  element.addEventListener("dragend", dragEnd);
});

containers.forEach((container) => {
  container.addEventListener("dragover", dragOver);
  container.addEventListener("drop", drop);
});

function dragStart(event) {
  event.dataTransfer.setData("draggedId", event.target.id);
  setTimeout(() => event.target.classList.toggle("hidden"));
}

function dragEnd(event) {
  event.target.classList.toggle("hidden");
}

function dragOver(event) {
  event.preventDefault();
}

function drop(event) {
  let draggedId = event.dataTransfer.getData("draggedId"),
    draggedElement = document.getElementById(draggedId),
    fromContainer = draggedElement.parentNode,
    toContainer = event.currentTarget;

  if (toContainer !== fromContainer) {
    fromContainer.appendChild(toContainer.firstElementChild);
    toContainer.appendChild(draggedElement);
  }
}

$('.filter').change(function() {
    if(this.checked) {
        switch (this.id){
            case 'green': 
                $('.color-3').parent().each(function(index, element){
                        $(element).removeAttr('hidden');
                });
            break;
            case 'yellow':
                $('.color-2').parent().each(function(index, element){
                        $(element).removeAttr('hidden');
                });    
            break;
            case 'red':
                $('.color-1').parent().each(function(index, element){
                        $(element).removeAttr('hidden');
                });
            break;
            case 'solved': 
            $('.fa-check').parent().each(function(index, element){
                $(element).removeAttr('hidden');
                $(element).removeAttr('style');
            });
            break;
        }
    } else {
        switch (this.id){
            case 'green': 
                $('.color-3').parent().each(function(index, element){
                    $(element).attr('hidden', '');
                });
            break;
            case 'yellow':
                $('.color-2').parent().each(function(index, element){
                    $(element).attr('hidden', '');
                });    
            break;
            case 'red': 
            $('.color-1').parent().each(function(index, element){
                $(element).attr('hidden', '');
            });
            break;
            case 'solved': 
            $('.fa-check').parent().each(function(index, element){
                $(element).attr('hidden', '');
                // $(element).attr('styles', 'visibility:collapse;'); Intente esto para que se quedara escondidas las tareas completadas mientras des-escondias otro tipo de tareas
            });
            break;
        }
    }
})

$('body').on('click', '.addComment', function(e){
    $(this).closest('.modal-body').find('form').removeAttr('hidden');
})

$('body').on('click', '.submitComment', function(e){
    e.preventDefault();
    e.stopPropagation();
    let form = $(e.target).parent();
    let id = $(this).attr('id').split('-')[1];
    $.ajax({
        url:'api/store_comment',
        type:'POST',
        data:{
            title: form.find('#title').val(),
            desc: form.find('#desc').val(),
            tasks_id: id,
        },
        beforeSend: function(){
            $.loading().open();
        },
        success: function(response){
            $.loading().close();
            form.parent().attr('hidden', '');
            $('#commentsModal-'+id).find('.modal-body').prepend('<div class="commentBody" id="comment-'+response.comment_id+'"><div class="commentTitle">'+form.find('#title').val()+'<button class="deleteComment">x</button></div><div class="commentDesc"><span class="commentDescDetail">'+form.find('#title').val()+'</span></div></div>');
        },
    });
})

$('body').on('click', '.deleteComment', function(e){
    if (confirm('Are you sure?') === true) {
        let id=$(this).closest('.commentBody').attr('id').split('-')[1];
        $.ajax({
            url:'api/delete_comment/' + id,
            type:'DELETE',
            beforeSend: function(){
                $.loading().open();
            },
            success: function(){
                $.loading().close();
                $("#comment-" + id).remove();
            },
        });
    }
})

