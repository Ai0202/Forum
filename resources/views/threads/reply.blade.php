<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <a href="">
                {{ $reply->owner->name }}
            </a>
            said
            {{ $reply->created_at->diffForHumans() }}...
        </div>
        <div class="card-body">
            <div class="body">
                {{ $reply->body }}
            </div>
        </div>
    </div>
</div>
