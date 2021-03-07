@extends('layouts.app')                                                          

@section('content')
    <div class="content" style="width: 90%; padding: 5%">
        <h1>Edit {{ $model->name }}.</h1>
        <form action="{{ route('users.update', ['user' => $model->id]) }}" class="createUserFrm" method="post">
            {{ method_field('PUT') }}
            <!-- Equivalent for @csrf directive -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}" />
            </div>
            <div class="form-group">
                <label for="url">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $model->email }}" />
            </div>

            <div class="form-group">
                <label for="roles">Roles</label>
                @foreach($roles as $role)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $model->hasRole($role->name) ? 'checked' : '' }} />
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Submit" />
                <input type="reset" class="btn btn-accent" value="Reset" />
            </div>
        </form>
    </div>

@endsection