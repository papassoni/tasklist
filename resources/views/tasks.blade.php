@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        @if(isset($task))
            <form action="{{ url('task/'.$task->id) }}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}
                <!-- Task Name -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="title" id="task-title" class="form-control" value='{{ $task->title }}'>
                    </div>
                    <label for="description" class="col-sm-3 control-label">Descrição</label>
                    <div class="col-sm-6">
                        <textarea placeholder="Descrição da tarefa" name='description' id='task-description' class="form-control">{{$task->description}}</textarea>
                    </div>
                    <label for="task-done" class="col-sm-3 control-label">
                        <input type='checkbox' name='done' id='task-done' class="filled-in form-control" value='1' {{$task->done?'checked':''}}>
                        <span>Concluída</span>                        
                    </label>
                    <br />
                    <br />                        
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
        @else
            <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}

                <!-- Task Name -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <input placeholder="Titulo da tarefa" type="text" name="title" id="task-title" class="form-control">
                    </div>
                    
                    <div class="col-sm-6">
                        <textarea placeholder="Descrição da tarefa" name='description' id='task-description' class="form-control"></textarea>
                    </div>

                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Adiconar
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>

    <!-- TODO: Current Tasks -->
    @if (count($tasks) > 0)
        <br />
        <br />
        <div>
            <div class="panel panel-default">
                

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Tarefa</th>
                            <th>Status</th>
                            <th>Data Criação</th>
                            <th>Ultima alteração</th>
                            <th>Ação</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $task->title }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $task->done?'concluída':'aberta' }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $task->created_at }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $task->updated_at }}</div>
                                    </td>
                                    <!-- Delete Button -->
                                    <td>
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('GET') !!}

                                            <button class="btn waves-effect"> Alterar</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}

                                            <button class="btn waves-effect">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection