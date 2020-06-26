@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd
@endunless
@section('title','Lopende project taken')
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
        <h1 class="page-title">Lopende project taken</h1>
    </div>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card p-4">
                <div class="table-responsive">
                    <table id="example" class="table card-table table-vcenter text-nowrap table-striped">
                        <thead>
                        <tr>
                            <th>Taak Titel</th>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Gemaakt op</th>
                            <th>Start datum</th>
                            <th>Eind datum</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pendings as $pending)
                            <tr>
                                <td>{{$pending->title}}</td>
                                <td>{{$pending->project->title}}</td>
                                <td><p class="text-center text-light bg-warning m-2 p-1">Bezig</p></td>
                                <td>{{date_format(date_create($pending->created_at),'d M,Y')}}</td>
                                <td>{{date_format(date_create($pending->start_date),'d M,Y')}}</td>
                                <td>{{date_format(date_create($pending->end_date),'d M,Y')}}</td>
                                <td>
                                    @if($pending->status=='pending')
                                        <a href="" class="btn btn-success" onclick="alert
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_completed-{{$pending->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Markeer als klaar</a>
                                    @endif
                                    <a href="{{route('project_task.edit',$pending->id)}}"
                                       class="btn btn-info">Bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="alert
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$pending->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Verwijder</a>
                                    <form id="delete-{{$pending->id}}"
                                          action="{{route('project_task.delete',$pending->id)}}"
                                          style="display:none;" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>

                                    <form id="make_completed-{{$pending->id}}"
                                          action="{{route('project_task.make_completed',$pending->id)}}"
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

