@include('layouts/app')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>
</div>

<div class="main-content">
    @foreach ($tasks as $task)
    <div class="element-container <?= $task->solved == 1 ? 'solved' : 'not-solved' ?>">
      <div class="element" draggable="true" id="Task-{{ $task->id }}" aria-hidden="false">
        <div class="color-{{ $task->color }}"></div>
        <button class="delete-task" id="deleteTask-{{ $task->id }}"><i class="fa-solid fa-square-xmark"></i></button>
        @if ($task->solved == 0)
          <i class="fa-solid fa-x solve-task" id="task-{{ $task->id }}"></i>
        @else
          <i class="fa-solid fa-check solve-task" id="task-{{ $task->id }}"></i>
        @endif
        <h3 class="task-title">{{ $task->title }}</h3>
        <div class="task-comment-container">
          <span class="task-comment"> {{$task->desc}}</span>
        </div>
          <div class="tasks-btns">
            <button class="show-task-details" id="taskDetails-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $task->id }}">Mostrar detalles</button>
            <button class="edit-task" id="taskDetails-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#editModal-{{ $task->id }}">Editar</button>
          </div>
        </div>
      </div>
{{-- MODAL COMENTARIOS--}}
      <div class="modal fade" id="commentsModal-{{ $task->id }}" tabindex="-1" aria-labelledby="commentsModal-{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Comentarios</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              @foreach ($comments as $comment)
                @if ($comment->tasks_id == $task->id)
                <div class="commentBody" id="comment-{{ $comment->id }}">
                  <div class="commentTitle">
                    {{ $comment->title }}
                    <button class="deleteComment">x</button>
                  </div>
                  <div class="commentDesc">
                    <span class="commentDescDetail">{{ $comment->desc }}</span>
                  </div>
                </div>
                @endif
              @endforeach
              <button class="btn btn-primary addComment" type="submit" id="addComment-{{ $task->id }}">Añadir comentario <i class="fa-solid fa-caret-down"></i></button>
              <form class="hidden">
                @csrf
                <div class="form-group">
                  <label for="title">Titulo</label>
                  <input class="form-control" name ="title" id="title" type="text">
                  <label for="desc">Descripcion</label>
                  <input class="form-control" name ="desc" id="desc" type="text">
                  <button class="btn btn-primary submitComment" type="submit" id="submitComment-{{ $task->id }}">submit</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

{{-- MODAL EDITAR --}}

      <div class="modal fade" id="editModal-{{ $task->id }}" tabindex="-1" aria-labelledby="editModal-{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">
                      <label for="title">Titulo</label>
                      <input class="form-control" name ="title" id="title" type="text" value="{{ $task->title }}">
                      <label for="desc">Descripcion</label>
                      <input class="form-control" name ="desc" id="desc" type="text" value="{{ $task->desc }}">
                      <label for="color">Color</label>
                      <select class="form-select" name="color" id="color">
                        <option value="1">Rojo</option>
                        <option value="2">Amarillo</option>
                        <option value="3">Verde</option>
                      </select>
                      <button class="btn btn-primary submitTask" type="submit" id="submitTask-{{ $task->id }}">submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
</div>



<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post">
                @csrf
                <div class="form-group">
                  <label for="title">Titulo</label>
                  <input class="form-control" name ="title" id="title" type="text" maxlength="20">
                  <label for="desc">Descripcion</label>
                  <input class="form-control" name ="desc" id="desc" type="text">
                  <label for="color">Color</label>
                  <select class="form-select" name="color" id="color">
                    <option value="1">Rojo</option>
                    <option selected value="2">Amarillo</option>
                    <option value="3">Verde</option>
                  </select>
                  <button class="btn btn-primary" type="submit" id="submitTask">submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
  


  
