
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


    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            @if (Auth::check())
                <form action="{{ route('reply.store', ['thread' => $thread->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit">投稿</button>
                </form>
            @else
                Plese <a href="{{ route('login') }}">signin</a>
            @endif
        </div>
    </div>

</div>
@endsection
