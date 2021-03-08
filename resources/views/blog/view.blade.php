@extends('layouts.frontend')                              

@section('content')
    <div class="container">
        <article>
            <h2>
                {{ $post->title }}
            </h2>
            <p>Published by: {{ $post->user->name }} on {{ $post->present()->publishedDate }}</p>
            <p> {!! $post->body !!} </p>
        </article>
    </div>
@endsection