@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="card text-center p-5">Welcome to Royal Apps</h1>
            @if(session('user'))
                <a href="{{route('authors')}}" class="btn btn-sm btn-success">
                    Authors
                </a>
            @endguest
        </div>
    </div>
</div>
@endsection