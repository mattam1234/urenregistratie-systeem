@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('style')
    <style>
        body {
            background-image: url("{{asset('images/background.png')}}");
        }

        .grid-container {
            height: 70%;
            display: grid;
            grid-template-columns: auto auto auto;
            grid-template-rows: auto auto;
            padding: 10px;
            grid-gap: 3em;
            overflow: auto;
        }

        .grid-item {
            padding: 20px;
            border: #808080 solid 1px;
            border-radius: 5px;
            background-color: #FFFFFF;
        }
    </style>
@endsection
@section('content')
    <div class="page-header d-flex justify-content-center">
        <h1 class="page-title">Een nieuwe project taak aanmaken.</h1>
    </div>
    <div class="row row-cards row-deck d-flex justify-content-center">
        <div class="col-6">
            @if($count==0)
                <h3 class="text-info text-center">Sorry !Geen projecten gevonden</h3>
                <a href="{{route('project.create')}}" class="btn btn-info">Taak aanmaken</a>
            @else
                <div class="card">
                    <div class="card-status bg-green"></div>
                    <div class="card-header">een project taak aanmaken</div>
                    <div class="card-body">
                        <form action="{{route('project_task.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="project_task_title"
                                       class="form-control {{($errors->has('project_task_title'))?'is-invalid':''}}"
                                       value="{{old('project_task_title')}}"
                                       placeholder="Enter project task title...">
                                @if($errors->has('task_title'))
                                    <p class="text-danger">{{$errors->first('project_task_title')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="task_project" id=""
                                        class="form-control {{($errors->has('task_project'))?'is-invalid':''}}">
                                    <option value="">Kies een catagorie</option>
                                    @foreach($projects as $project)
                                        <option
                                            value="{{$project->id}}" {{(old('task_project')==$project->id)?'selected':''}}>{{$project->title}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('task_project'))
                                    <p class="text-danger">{{$errors->first('task_project')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="task_project" id=""
                                        class="form-control {{($errors->has('task_project'))?'is-invalid':''}}">
                                    <option value="">Kies een project</option>
                                    @foreach($projects as $project)
                                        <option
                                            value="{{$project->id}}" {{(old('task_project')==$project->id)?'selected':''}}>{{$project->title}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('task_project'))
                                    <p class="text-danger">{{$errors->first('task_project')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Start From</label>
                                <input type="date" name="start_date" value="{{old('start_date')}}"
                                       class="form-control {{($errors->has('start_date'))?'is-invalid':''}}"
                                       placeholder="Enter start date...">
                                @if($errors->has('start_date'))
                                    <p class="text-danger">{{$errors->first('start_date')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Eind datum</label>
                                <input type="date" name="end_date" value="{{old('end_date')}}"
                                       class="form-control {{($errors->has('end_date'))?'is-invalid':''}}"
                                       placeholder="Enter end date...">
                                @if($errors->has('end_date'))
                                    <p class="text-danger">{{$errors->first('end_date')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="task_estimated"
                                       class="form-control {{($errors->has('task_estimated'))?'is-invalid':''}}"
                                       value="{{old('task_estimated')}}" placeholder="Benodigde tijd">
                                @if($errors->has('task_estimated'))
                                    <p class="text-danger">{{$errors->first('task_estimated')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                            <textarea
                                                class="form-control {{($errors->has('description'))?'is-invalid':''}}"
                                                name="description"
                                                placeholder="Project task description...">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                    <p class="text-danger">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                            <div class="card-footer float-right">
                                <a href="{{route('project_task.all')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
        </div>
    </div>
@endsection

@section('title','TSD Nieuwe project taak')
