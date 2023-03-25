@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="h3 m-0">{{ __('Jobs') }}</span>
                        <ul class="nav nav-pills card-header-pills justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('jobs.re-import') }}">Re-Import</a>
                            </li>
                        </ul>
                    </div><!-- ./card-header -->

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Level</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <th scope="row">{{ $job->id }}</th>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->level }}</td>
                                    <td>{{ $job->estimated_duration }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $jobs->links() }}
                    </div><!-- ./card-body -->
                </div><!-- ./card -->
            </div><!-- ./col-md-8 -->
        </div><!-- ./row -->
    </div><!-- ./container -->
@endsection
