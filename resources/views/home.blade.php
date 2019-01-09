@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->bio }}</p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/status" method="POST">
                        @csrf

                        <div class="form-group">
                          <label for="body"><strong>Update status</strong></label>
                          <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                        </div>

                        <input type="submit" value="Post" class="btn btn-primary btn-block">
                    </form>


                </div>
            </div>

            <hr>
            <h3 class="card-body mt-2">Your recent posts</h3>
            <hr>

            @foreach ($statuses as $status)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $status->body }}</h4>
                    <p class="card-text">
                        <i class="fas fa-heart"></i> {{ $status->likes }} &nbsp;&nbsp;
                        {{ $status->created_at->diffForHumans() }}

                        <form action="/status/{{ $status->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </p>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection