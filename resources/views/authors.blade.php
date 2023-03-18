@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Authors') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Place Of Birth</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $d)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <th scope="row">{{$d->first_name}}</th>
                                    <th scope="row">{{$d->last_name}}</th>
                                    <th scope="row">{{$d->birthday}}</th>
                                    <th scope="row">{{$d->gender}}</th>
                                    <th scope="row">{{$d->place_of_birth}}</th>
                                    <th scope="row"><a href="{{route('author.view', $d->id)}}" class="btn btn-info"> View </a></th>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
