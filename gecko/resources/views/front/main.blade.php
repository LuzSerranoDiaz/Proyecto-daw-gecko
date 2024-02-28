@include('layouts/app')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
  Añadir nueva tarea
</button>

<div class="main-content">
    @foreach ($tasks as $task)
        <div class="element" id="Task-{{ $task->id }}">
            <h3 class="task-title">{{ $task->title }}</h3>
            <span class="task-comment"> {{$task->desc}}</span>
            <div class="tasks-btns">
              <button class="show-task-details" id="taskDetails-{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#commentsModal">Mostrar detalles</button>
              <button class="delete-task" id="deleteTask-{{ $task->id }}">Eliminar</button>
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
            <form method="post" action="{{url('api/store_task')}}">
                @csrf
            
                <label for="title">Titulo</label>
                <input name ="title" id="title" type="text">
                <label for="desc">Descripcion</label>
                <input name ="desc" id="desc" type="text">
                <label for="color">Color</label>
                <input name="color" id="color" type="number">
                <label for="solved">Solved</label>
                <input name="solved" id="solved" type="number">
                <label for="position">Position</label>
                <input name="position" id="position" type="number">
                <button type="submit" id="submitTask">submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  

  <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
  
