@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                    
                    <p>First Name: {{ Session::get('user')->user->first_name }}</p>
                    <p>Last Name: {{ Session::get('user')->user->last_name }}</p>
                    <p>Email: {{ Session::get('user')->user->email }}</p>
                    <p>Gender: {{ Session::get('user')->user->gender }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
