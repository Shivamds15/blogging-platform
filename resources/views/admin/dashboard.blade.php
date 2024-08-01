@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center" style="background-color: #007bff;color: #c0deff;border-radius: 100%;">Dashboard</h1>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-info mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Total Posts</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-text">{{ $totalPosts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0">Soft-Deleted Posts</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-text">{{ $softDeletedPosts }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Total Comments</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-text">{{ $totalComments }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Soft-Deleted Users</h5>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-text">{{ $softDeletedUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Posts Analytics</h5>
                </div>
                <div class="card-body">
                    <div id="postsChart" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Users Analytics</h5>
                </div>
                <div class="card-body">
                    <div id="usersChart" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Comments Analytics</h5>
                </div>
                <div class="card-body">
                    <div id="commentsChart" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const postsData = {
            categories: {!! json_encode($postsChartData['categories']) !!},
            data: {!! json_encode($postsChartData['data']) !!}
        };

        const usersData = {
            categories: {!! json_encode($usersChartData['categories']) !!},
            data: {!! json_encode($usersChartData['data']) !!}
        };

        const commentsData = {
            categories: {!! json_encode($commentsChartData['categories']) !!},
            data: {!! json_encode($commentsChartData['data']) !!}
        };

        Highcharts.chart('postsChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Posts Created per Month'
            },
            xAxis: {
                categories: postsData.categories,
                title: {
                    text: 'Month'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Posts'
                }
            },
            series: [{
                name: 'Posts Created',
                data: postsData.data
            }]
        });

        Highcharts.chart('usersChart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Users by Role'
            },
            series: [{
                name: 'Users Count',
                colorByPoint: true,
                data: usersData.categories.map((category, index) => ({
                    name: category,
                    y: usersData.data[index]
                }))
            }]
        });

        Highcharts.chart('commentsChart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Comments per User'
            },
            xAxis: {
                categories: commentsData.categories,
                title: {
                    text: 'User'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Comments'
                }
            },
            series: [{
                name: 'Comments',
                data: commentsData.data
            }]
        });
    });
</script>
@endsection
