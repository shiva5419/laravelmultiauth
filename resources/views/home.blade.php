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
                    <div class="expensive-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                    @foreach ($users as $k => $user)
                                    <tr>
                                        <th>{{ $k+1 }}</th>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->email }}</th>
                                        <th>{{ $user->created_at->format('d/M/Y H:i:s') }}</th>
                                        <th><a href="{{ route('expensive', $user->id) }}"><button type="button" class="btn btn-primary"> Expensive</button></a></th>
                                    </tr>
                                    @endforeach 
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
