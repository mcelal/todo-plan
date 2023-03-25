@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Report') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Hours:</h5>
                                    <p class="card-text">{{ $report['totalHours'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Jobs:</h5>
                                    <p class="card-text">{{ $report['totalJobs'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Weeks:</h5>
                                    <p class="card-text">{{ $report['week'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row -->

                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-hover">
                                <tbody>
                                @foreach($report['items'] as $week => $weekJobs)
                                    @if(! $loop->first)
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" class="text-center table-active py-4 h3" colspan="4">{{ __("Week #").$week }}</th>
                                    </tr>
                                    <tr>
                                        <th>Developer</th>
                                        <th>Job</th>
                                        <th>Level</th>
                                        <th>Hour</th>
                                    </tr>
                                    @foreach($weekJobs as $developer)
                                        @foreach($developer as $job)
                                            <tr>
                                                <td>{{ $job['developer'] }}</td>
                                                <td>{{ $job['job'] }}</td>
                                                <td>{{ $job['level'] }}</td>
                                                <td>{{ $job['hour'] }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-secondary text-white">
                                            <td colspan="3" class="text-end">Total Hours</td>
                                            <td>{{ collect($developer)->sum('hour') }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- ./col-md-12 -->
                    </div><!-- ./row -->
                </div><!-- ./card-body -->
            </div><!-- ./card -->
        </div><!-- ./col-md-8 -->
    </div><!-- ./row -->
</div><!-- ./container -->
@endsection
