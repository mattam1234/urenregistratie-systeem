@extends('layouts.app')
@section('title','Ongoing Projects')
@extends('layouts.app')
@unless (Auth::check())
    You are not signed in.
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
        <h1 class="page-title">Projecten</h1>
    </div>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th>Project Titel</th>
                            <th>Categorie</th>
                            <th>Status</th>
                            <th>Aangemaakt op</th>
                            <th>Begonnen op</th>
                            <th>Geeindigt op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{$project->title}}</td>
                                <td>{{$project->category->category_title}}</td>
                                <td>
                                    @if($project->status=='pending')
                                        <p class="text-center text-light bg-warning m-2 p-1">Bezig</p>
                                    @else
                                        <p class="text-center text-light bg-success m-2">Klaar</p>
                                    @endif
                                </td>
                                <td>{{date_format(date_create($project->created_at),'d M,Y')}}</td>
                                <td>{{date_format(date_create($project->start_date),'d M,Y')}}</td>
                                <td>{{date_format(date_create($project->end_date),'d M,Y')}}</td>
                                <td>
                                    @if($project->status=='pending')
                                        <a href="" class="btn btn-success" onclick="
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_completed-{{$project->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Mark Completed</a>
                                    @elseif($project->status=='completed')
                                        <a href="" class="btn btn-warning" onclick="
                                            if(confirm('Zeker ?')){
                                            event.preventDefault();
                                            document.getElementById('make_pending-{{$project->id}}').submit();
                                            }else{
                                            event.preventDefault();
                                            }
                                            ">Mankeer als bezig</a>
                                    @endif
                                    <a href="{{route('project.edit',$project->id)}}"
                                       class="btn btn-info">Bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$project->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Remove</a>
                                    <form id="delete-{{$project->id}}" style="display:none;"
                                          action="{{route('project.delete',$project->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <form id="make_completed-{{$project->id}}" style="display:none;"
                                          action="{{route('project.make_completed',$project->id)}}"
                                          method="POST">
                                        @csrf
                                    </form>
                                    <form id="make_pending-{{$project->id}}" style="display:none;"
                                          action="{{route('project.make_pending',$project->id)}}" method="POST">
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

