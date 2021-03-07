@extends('layouts.app')                                                        

@section('content')
    <div class="content" style="width: 90%; padding: 5%">
        <h1>Edit post.</h1>
        <form action="{{ route('blog.update', ['blog' => $model->id]) }}" method="post">
            {{ method_field('PUT') }}
            @include('backend.blog.partials.fields')                               
        </form>
    </div>

@endsection

@section('scripts')

    @include('backend.blog.partials.scripts')    

@endsection