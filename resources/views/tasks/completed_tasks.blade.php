@extends('layouts.app')
@section('title','taken')
@unless (Auth::check())
    Je bent niet ingelogd
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
        <h1 class="page-title">Taken die af zijn</h1>
    </div>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card p-4">
                <div class="table-responsive">
                    <table id="example" class="table card-table table-vcenter text-nowrap table-striped">
                        <thead>
                        <tr>
                            <th>Taak titel</th>
                            <th>Catagorie</th>
                            <th>Status</th>
                            <th>Aangemaakt op</th>
                            <th>Start datum</th>
                            <th>Eind datum</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completed as $task)
                            <tr>
                                <td>{{$task->title}}</td>
                                <td>{{$task->category->category_title}}</td>
                                <td><p class="text-center text-light bg-success m-2">Klaar</p></td>
                                <td>{{date_format(date_create($task->created_at),'d M,Y')}}</td>
                                <td>{{date_format(date_create($task->start_date),'d M,Y')}}</td>
                                <td>{{date_format(date_create($task->end_date),'d M,Y')}}</td>
                                <td>
                                    <a href="" class="btn btn-warning" onclick="alert
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('make_pending-{{$task->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Markeer als bezig</a>
                                    <a href="{{route('task.edit',$task->id)}}" class="btn btn-info">bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="alert
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$task->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Verwijderen</a>
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
