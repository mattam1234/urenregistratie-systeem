@extends('layouts.app')
@section('title','Categories')
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
        <h1 class="page-title">Catagorie</h1>
        <div class="row gutters-xs ml-auto">
            <div class="col">
                <a href="{{route('category.create')}}" class="btn btn-success">Catagoerie aanmaken</a>
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
                    <table class="table card-table table-vcenter table-striped text-nowrap" id="example">
                        <thead>
                        <tr>
                            <th>Catagorie titel</th>
                            <th>Aangemaakt op</th>
                            <th>Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->category_title}}</td>
                                <td>{{date_format(date_create($category->created_at),'d M,Y')}}</td>
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}"
                                       class="btn btn-info">Bewerken</a>
                                    <a href="" class="btn btn-danger" onclick="
                                        if(confirm('Zeker ?')){
                                        event.preventDefault();
                                        document.getElementById('delete-{{$category->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        ">Verwijder</a>
                                    <form style="display:none;" id="delete-{{$category->id}}"
                                          action="{{route('category.delete',$category->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
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
