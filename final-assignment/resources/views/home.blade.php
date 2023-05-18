@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
                <div class="d-flex m-3 justify-content-evenly">
                    @if(Auth::check() && Auth::user()->role === 'teacher')
                        <!-- Button for teacher -->
                        <a role="button" href="/teacher" class="btn btn-outline-primary">Teacher GUI</a>
                    @else
                        <!-- Button for student -->
                        <a role="button" href="/questions" class="btn btn-outline-primary">Student GUI</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
