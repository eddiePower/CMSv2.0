@extends('layouts.app')                                  

@section('content')
    <div class="content" style="width: 90%; padding: 5%">
        <h1>Edit page.</h1>
        <form action="{{ route('pages.update', ['page' => $model->id]) }}" class="createPageFrm" method="post">
            {{ method_field('PUT') }}
            @include('backend.pages.partials.fields')         
        </form>
    </div>

@endsection