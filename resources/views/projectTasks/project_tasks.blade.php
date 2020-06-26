@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('title','Project taken')
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
    <div class="page-header">
        <h1 class="page-title">Mijn project taken</h1>
        <div class="row gutters-xs ml-auto">
            <div class="col">
                <a href="{{route('project_task.create')}}" class="btn btn-success">Maak een project taak</a>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card p-4">
                <div class="table-responsive">
                    <table id="example" class="table card-table table-vcenter text-nowrap table-striped">
                        <thead>
                        <tr>
                            <th>Taak title</th>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Gemaakt op</th>
                            <th>Begin datum</th>
                            <th>Eind datum</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($project_tasks as $project_task)
                            <tr>
                                <td>{{$project_task->title}}</td>
                                <td>{{$project_task->project->title}}</td>
                                <td>
                                    @if($project_task->status=='pending')
                                        <p class="text-center text-light bg-warning m-2 p-1">Bezig</p>
                                    @else
                                        <p class="text-center text-light bg-success m-2">Klaar</p>
                                    @endif
                                </td>
                                <td>{{date_format(date_create($project_task->created_at),'d M,Y')}}</td>
                                <td>{{date_format(date_create($project_task->start_date),'d M,Y')}}</td>
                                <td>{{date_format(date_create($project_task->end_date),'d M,Y')}}</td>
                                <td>
                                    @if($project_task->status=='pending')
                                        <a href="" class="btn btn-success" onclick="alert
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_completed-{{$project_task->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Mark Done</a>
                                    @elseif($project_task->status=='completed')
                                        <a href="" class="btn btn-warning" onclick="alert
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_pending-{{$project_task->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Mark Pending</a>
                                    @endif
                                    <a href="{{route('project_task.edit',$project_task->id)}}" class="btn btn-info">Bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="alert
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$project_task->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Remove</a>
                                    <form id="delete-{{$project_task->id}}"
                                          action="{{route('project_task.delete',$project_task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>

                                    <form id="make_completed-{{$project_task->id}}"
                                          action="{{route('project_task.make_completed',$project_task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                    </form>

                                    <form id="make_pending-{{$project_task->id}}"
                                          action="{{route('project_task.make_pending',$project_task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                    </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


