@extends('layouts.app')

@section('content')
    <div class="container dashpage p-4" style="height: 100vh; display: flex; flex-direction: column;">
        <div class="row mb-1" style="margin-top:3.5em">
            @foreach([
                ['Total Posts', $totalPosts, 'info'],
                ['Deleted Posts', $softDeletedPosts, 'warning'],
                ['Total Comments', $totalComments, 'success'],
                ['Deleted Users', $softDeletedUsers, 'danger']
            ] as [$title, $count, $color])
                <div class="col-md-3 mb-3">
                    <div class="card metrics-card border-{{ $color }} bg-{{ $color }}">
                        <div class="card-content text-{{ $color }}">
                            <div class="card-title">{{ $title }}</div>
                            <div class="card-value">{{ $count }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row flex-fill">
            <div class="col-md-6 d-flex flex-column">
                <div class="flex-fill mb-3">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div id="usersChart" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
                <div class="flex-fill">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div id="postsChart" style=""></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column">
                <div class="flex-fill">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div id="commentsChart" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartsData = {
                posts: {!! json_encode($postsChartData) !!},
                users: {!! json_encode($usersChartData) !!},
                comments: {!! json_encode($commentsChartData) !!}
            };

            function createChart(container, options) {
                return Highcharts.chart(container, {
                    ...options,
                    chart: {
                        ...options.chart,
                        events: {
                            redraw: function () {
                                this.reflow();
                            }
                        }
                    }
                });
            }

            const postsChart = createChart('postsChart', {
                chart: { type: 'bar' },
                title: { text: 'Posts Created per Month' },
                xAxis: {
                    categories: chartsData.posts.categories,
                    title: { text: 'Month' }
                },
                yAxis: {
                    min: 0,
                    title: { text: 'Number of Posts' }
                },
                series: [{
                    name: 'Posts Created',
                    data: chartsData.posts.data
                }]
            });

            const usersChart = createChart('usersChart', {
                chart: { type: 'pie' },
                title: { text: 'Users by Role' },
                series: [{
                    name: 'Users Count',
                    colorByPoint: true,
                    data: chartsData.users.categories.map((category, index) => ({
                        name: category,
                        y: chartsData.users.data[index]
                    }))
                }]
            });

            const commentsCategories = chartsData.comments.categories;
            const commentsData = chartsData.comments.data;

            const top10Comments = commentsCategories
                .map((category, index) => ({ category, data: commentsData[index] }))
                .sort((a, b) => b.data - a.data)
                .slice(0, 10);

            const top10Categories = top10Comments.map(item => item.category);
            const top10Data = top10Comments.map(item => item.data);

            const commentsChart = createChart('commentsChart', {
                chart: { type: 'bar' },
                title: { text: 'Top 10 Users by Comments' },
                xAxis: {
                    categories: top10Categories,
                    title: { text: 'User' }
                },
                yAxis: {
                    min: 0,
                    title: { text: 'Number of Comments' }
                },
                series: [{
                    name: 'Comments',
                    data: top10Data
                }]
            });

            window.addEventListener('resize', () => {
                postsChart.reflow();
                usersChart.reflow();
                commentsChart.reflow();
            });
        });
    </script>
@endsection
