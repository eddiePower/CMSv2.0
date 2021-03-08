@extends('layouts.app')                                         

@section('content')
    <div class="content" style="width: 90%; padding: 5%">
        <h1>Create new Post.</h1>
        <form action="{{ route('blog.store',  ['blog' => $model]) }}" method="post">
            @include('backend.blog.partials.fields')                     
        </form>
    </div>

@endsection

@section('scripts')

    @include('backend.blog.partials.scripts')          

@endsection