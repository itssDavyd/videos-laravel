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

                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier() == $comment->user_id || \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier() == $video->user_id)
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal_{{$comment->id}}">
                            Eliminar comentario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal_{{$comment->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar
                                            comentario::{{$comment->user->name .' '.$comment->user->surname}}</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro de que quieres eliminar este comentario?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                                        </button>
                                        <a href="{{route('deleteComment',['id_comment'=>$comment->id])}}" type="button"
                                           class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <br>
            @if($contador > 5)
                @break
            @endif
        @endforeach
    </div>

@endif
