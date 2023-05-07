<h4 style="text-align: center">Comentarios</h4>
<hr>

@if(\Illuminate\Support\Facades\Auth::check())
    <form action="{{route('comment')}}" method="post">
        @csrf
        <input type="hidden" name="video_id" value="{{$video->id}}" required>
        <p>
            <textarea class="form-control" name="body" required cols="30" rows="10"></textarea>
        </p>
        <input type="submit" value="Comentar" class="btn btn-success" style="text-align: end">
    </form>
@endif
<br>
@if(isset($video->comments))
    <div id="commets-list">
        <span hidden>{{$contador = 0}}</span>
        @foreach($video->comments as $comment)
            <span hidden>{{$contador ++}}</span>
            <div class="comment-item col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            {{$comment->body}}
                        </p>

                        <p class="card-text"><small
                                class="text-muted">{{$comment->user->name.' '.$comment->user->surname}}
                                - {{$comment->created_at}}</small></p>
                    </div>
                </div>
            </div>
            <br>
            @if($contador > 5)
                @break
            @endif
        @endforeach
    </div>

@endif
