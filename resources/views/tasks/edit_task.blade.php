@extends('layouts.app')
@section('title','Bewerk taak')

@unless (Auth::check())
    Je bent niet ingelogt.
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
                <h1 class="page-title">Bewerk taak</h1>
            </div>
            <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-status bg-green"></div>
                        <div class="card-header">Bewerk taak</div>
                        <div class="card-body">
                            @foreach($task as $each)
                                <form action="{{route('task.update',$each->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="task_title"
                                               class="form-control {{($errors->has('task_title'))?'is-invalid':''}}"
                                               value="{{$each->title}}" placeholder="Enter task title...">
                                        @if($errors->has('task_title'))
                                            <p class="text-danger">{{$errors->first('task_title')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <select name="task_category"
                                                class="form-control {{($errors->has('task_category'))?'is-invalid':''}}">
                                            <option value="">Kies een catagorie</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{($category->id==$each->category_id)?'selected':''}}>{{$category->category_title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('task_category'))
                                            <p class="text-danger">{{$errors->first('task_category')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Start datum</label>
                                        <input type="date" name="start_date" value="{{ $each->start_date }}"
                                               class="form-control {{($errors->has('start_date'))?'is-invalid':''}}"
                                               placeholder="Kies start datum...">
                                        @if($errors->has('start_date'))
                                            <p class="text-danger">{{$errors->first('start_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Eind datum</label>
                                        <input type="date" name="end_date" value="{{ $each->end_date }}"
                                               class="form-control {{($errors->has('start_date'))?'is-invalid':''}}"
                                               placeholder="Kies eind datum...">
                                        @if($errors->has('end_date'))
                                            <p class="text-danger">{{$errors->first('end_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="task_estimated"
                                               class="form-control {{($errors->has('task_estimated'))?'is-invalid':''}}"
                                               value="{{$each->estimated_hours}}" placeholder="{{$each->estimated_hours}}">
                                        @if($errors->has('task_estimated'))
                                            <p class="text-danger">{{$errors->first('task_estimated')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="task_hours"
                                               class="form-control {{($errors->has('task_hours'))?'is-invalid':''}}"
                                               value="{{$each->hours ?? '0'}}" placeholder="{{$each->hours ?? 'Gedraaide uren...'}}">
                                        @if($errors->has('task_hours'))
                                            <p class="text-danger">{{$errors->first('task_hours')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Gebruiker</label>
                                        <select name="user" class="form-control">
                                            <option value="{{$currentUser->id}}" selected>{{$currentUser->voorNaam}} {{$currentUser->achterNaam}}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"> {{ $user->voorNaam }} {{$user->achterNaam}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control {{($errors->has('description'))?'is-invalid':''}}"
                                                  name="description"
                                                  placeholder="Taak beschrijving...">{{$each->description}}</textarea>
                                        @if($errors->has('description'))
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer float-right">
                                        <a href="{{route('task.ongoing')}}" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
@endsection
