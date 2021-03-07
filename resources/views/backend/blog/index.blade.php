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
                    <th>Author</th>
                    <th>Slug</th>
                    <th>Published</th>
                    <th>Delete</th>
                </tr>
            </thead>

            @foreach($model as $post)
                <tr>
                    <td>
                        <a href="{{ route('blog.edit', ['blog' => $post->id]) }}">{{ $post->title }}</a>
                    </td>
                    <td>
                        {{ $post->user()->first()->name }}
                    </td>
                    <td>
                        {{ $post->slug }}
                    </td>
                    <td>
                        {{ $post->published_at }}
                    </td>
                    <td>
                        <form id="delete-form" action="{{ route('blog.destroy', ['blog' => $post->id]) }}" method="POST">
                            <input type="submit" value="Delete" class="btn btn-link" data-form="delete-form" data-mesage="Are Your Sure you want to Delete?" />
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $model->links() }}
    </div>
@endsection