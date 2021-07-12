@extends('layouts.app')

@section('content')

<div id="app" class="admin-main">
    
    <div class="left-main">
        <div class="box add" @click="dsplNew()"><i class="fas fa-plus"></i></div>
        @foreach ($tasks as $task)
        <div class="box" @click="taskInfo( {{$task}} )">
            <span>#{{$task->id}}</span>
            <h4>{{$task->title}}</h4>
            <form class="d-inline-block" action="{{ route('task.destroy', $task->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button id="my-btn"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
        @endforeach
    </div>
    
    <div class="right-main">
        <div class="right-up">
            <div class="task-info" v-if="taskID != 0">
                <div class="id-ops">
                    <span>Task ID#@{{ taskID }}</span>
                    <div>
                        <button class="btn" @click="dsplEdit()">Edit</button>
                        
                    </div>
                </div>
                <div class="title-content">
                    <h2>@{{ taskTitle }}</h2>
                    <p>@{{ taskContent }}</p>
                </div>
            </div>
        </div>

        <div class="right-down">

            <div class="new-task" v-if="display === 'new'">
                <form action="{{route('task.store')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>

            <div class="edit-task" v-if="display === 'edit'">
                <form :action="updateTask()" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" :value="taskTitle" maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="3">@{{ taskContent }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

