@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Developers') }}</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Level</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($developers as $developer)
                                <tr>
                                    <th scope="row">{{ $developer->id }}</th>
                                    <td>{{ $developer->name }}</td>
                                    <td>{{ $developer->level }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $developers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
