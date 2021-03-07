@extends('layouts.app')                               

@section('content')
    <div class="content" style="width: 90%; padding: 5%">
        <h1>Create new page.</h1>
        <form action="{{ route('pages.store') }}" class="createPageFrm" method="post">
            @include('backend.pages.partials.fields')           
        </form>
    </div>

@endsection