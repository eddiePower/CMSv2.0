@extends('layouts.app')                                               

@section('content')
    <div class="container" style="width: 90%" align="center">
        @if(session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}">{{ $user->email }}</a>
                        </td>
                        <td>
                            {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $model->links() }}
    </div>

@endsection