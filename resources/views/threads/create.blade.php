
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="con-md-8">
            <div class="card">
                <div class="card-header">
                    新規作成
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('threads.store')}}">
                        @csrf

                        <div class="form-group">
                            <label for="channel_id"></label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value="">Choose One...</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }} >{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
