@extends('layouts.app')
@section('title','Project aanpassen.')
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
        <h1 class="page-title">Project aanpassen</h1>
    </div>
    <div class="row row-cards row-deck d-flex justify-content-center">
        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    @foreach($project as $each)
                        <form action="{{route('project.update',$each->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text"
                                       class="form-control {{($errors->has('project_title'))?'is-invalid':''}}"
                                       value="{{$each->title}}" name="project_title"
                                       placeholder="Kies een catagorie...">
                                @if($errors->has('project_title'))
                                    <p class="text-danger">{{$errors->first('project_title')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="project_category"
                                        class="form-control  {{($errors->has('project_category'))?'is-invalid':''}}">
                                    <option value="">Kies een catagorie</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}" {{($category->id==$each->category_id)?'selected':''}}>{{$category->category_title}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('project_category'))
                                    <p class="text-danger">{{$errors->first('project_category')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Begin datum</label>
                                <input type="date"
                                       class="form-control  {{($errors->has('start_date'))?'is-invalid':''}}"
                                       name="start_date" value="{{$each->start_date}}"
                                       placeholder="Kies start datum...">
                                @if($errors->has('start_date'))
                                    <p class="text-danger">{{$errors->first('start_date')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Eind datum</label>
                                <input type="date"
                                       class="form-control  {{($errors->has('end_date'))?'is-invalid':''}}"
                                       name="end_date" value="{{$each->end_date}}"
                                       placeholder="Kies eind datum...">
                                @if($errors->has('end_date'))
                                    <p class="text-danger">{{$errors->first('end_date')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                        <textarea class="form-control {{($errors->has('description'))?'is-invalid':''}}"
                                                  name="description"
                                                  placeholder="Beschrijf het project...">{{$each->description}}</textarea>
                                @if($errors->has('description'))
                                    <p class="text-danger">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                            <div class="card-footer float-right">
                                <a href="{{route('project.all')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

