@extends('layouts.app')
@section('title','Lopende taken')
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
    <div class="page-header">
        <h1 class="page-title">Mijn taken</h1>
        <div class="row gutters-xs ml-auto">
            <div class="col">
                <a href="{{route('task.create')}}" class="btn btn-success">Maak taak</a>
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
                            <th>Taak titel</th>
                            <th>Status</th>
                            <th>Gemaakt op</th>
                            <th>Start datum</th>
                            <th>Eind datum</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->title}}</td>
                                <td>
                                    @if($task->status=='pending')
                                        <p class="text-center text-light bg-warning m-2 p-1">Bezig</p>
                                    @else
                                        <p class="text-center text-light bg-success m-2">Klaar</p>
                                    @endif
                                </td>
                                <td>{{date_format(date_create($task->created_at),'d M,Y')}}</td>
                                <td>{{date_format(date_create($task->start_date),'d M,Y')}}</td>
                                <td>{{date_format(date_create($task->end_date),'d M,Y')}}</td>
                                <td>
                                    @if($task->status=='pending')
                                        <a href="" class="btn btn-success" onclick="alert
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_completed-{{$task->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Markeer als klaar</a>
                                    @elseif($task->status=='completed')
                                        <a href="" class="btn btn-warning" onclick="alert
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_pending-{{$task->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Markeer als bezig</a>
                                    @endif
                                    <a href="{{route('task.edit',$task->id)}}" class="btn btn-info">Bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="alert
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$task->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Verijderen</a>
                                    <form id="delete-{{$task->id}}" action="{{route('task.delete',$task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>

                                    <form id="make_completed-{{$task->id}}"
                                          action="{{route('task.make_completed',$task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                    </form>

                                    <form id="make_pending-{{$task->id}}"
                                          action="{{route('task.make_pending',$task->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
