@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('title','Project taaken')
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
    <div class="grid-container">
        <div class="my-3 my-md-5">
            <div class="page-header">
                <h1 class="page-title">Projecten die af zijn</h1>
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
                                @foreach($finished as $each)
                                    <tr>
                                        <td>{{$each->title}}</td>
                                        <td>{{$each->project->title}}</td>
                                        <td><p class="text-center text-light bg-success m-2">Done</p></td>
                                        <td>{{date_format(date_create($each->created_at),'d M,Y')}}</td>
                                        <td>{{date_format(date_create($each->start_date),'d M,Y')}}</td>
                                        <td>{{date_format(date_create($each->end_date),'d M,Y')}}</td>
                                        <td>
                                            @if($each->status=='completed')
                                                <a href="" class="btn btn-warning" onclick="alert
                                                    if(confirm('Zeker ?')){
                                                    event.preventDefault();
                                                    document.getElementById('make_pending-{{$each->id}}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }
                                                    ">Markeer als bezig</a>
                                            @endif
                                            <a href="{{route('project_task.edit',$each->id)}}"
                                               class="btn btn-info">Bewerk</a>
                                            <a href="" class="btn btn-danger" onclick="alert
                                                if(confirm('Zeker ?')){
                                                event.preventDefault();
                                                document.getElementById('delete-{{$each->id}}').submit();
                                                }else{
                                                event.preventDefault();
                                                }
                                                ">Remove</a>
                                            <form id="delete-{{$each->id}}"
                                                  action="{{route('project_task.delete',$each->id)}}"
                                                  style="display:none;" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <form id="make_pending-{{$each->id}}"
                                                  action="{{route('project_task.make_pending',$each->id)}}"
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
        </div>
    </div>
@endsection


