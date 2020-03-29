
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="">
                        {{ $thread->creator->name }} posted
                    </a>
                    {{ $thread->title }}
                </div>
                <div class="card-body">
                    <div class="body">{{ $thread->body }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
    </div>

</div>
@endsection
