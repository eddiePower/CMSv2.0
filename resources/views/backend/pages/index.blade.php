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
                    <th>Title</th>
                    <th>URL</th>
                    <th>Delete Page</th>
                </tr>
            </thead>

            @foreach($pages as $model)
                <tr>
                    <td>
                        {!! $model->present()->paddedTitle !!}
                    </td>
                    <td>
                        <a href="{{ route('pages.edit', ['page' => $model->id]) }}">{{ $model->url }}</a>
                    </td>
                    <td>
                        <form id="delete-form" action="{{ route('pages.destroy', ['page' => $model->id]) }}" method="POST">
                            <input type="submit" value="Delete" class="btn btn-link" data-form="delete-form" data-mesage="Are Your Sure you want to Delete?" />
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $pages->links() }}
    </div>

@endsection