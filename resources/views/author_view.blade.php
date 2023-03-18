@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Author Detail') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <p>First Name: {{ $data->first_name}}</p>
                    <p>Last Name: {{ $data->last_name}}</p>
                    <p>Birthday: {{ $data->birthday}}</p>
                    <p>Biography: {{ $data->biography}}</p>
                    <p>Gender: {{ $data->gender}}</p>
                    <p>Place of birth: {{ $data->place_of_birth}}</p>

                    <div class="col-md-12 text-end">
                        <a href="{{ route('book.create') }}" class="btn btn-success">Create New Book</a>
                    </div>

                    @if(count($data->books) > 0)                                        
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Release Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">isbn</th>
                                <th scope="col">Format</th>
                                <th scope="col">Number Of Pages</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->books as $key => $d)
                                    <tr>
                                        <th scope="row">{{++$key}}</th>
                                        <th scope="row">{{$d->title}}</th>
                                        <th scope="row">{{$d->release_date}}</th>
                                        <th scope="row">{{$d->description}}</th>
                                        <th scope="row">{{$d->isbn}}</th>
                                        <th scope="row">{{$d->format}}</th>
                                        <th scope="row">{{$d->number_of_pages}}</th>
                                        <th scope="row"><a href="{{route('book.delete', $d->id)}}" class="btn btn-danger"> Delete </a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <a href="{{ route('author.delete', $data->id) }}" class="btn btn-danger">Delete Author</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
