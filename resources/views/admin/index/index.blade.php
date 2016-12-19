@extends("admin.public.layout")

@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box-header with-border">
                <h3 class="box-title">系统信息</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">一周网站点击数报告</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>一周网站链接点击量统计数据</strong>
                                    </p>
                                    <div class="chart">
                                        <canvas id="web_chart" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">一周文章点击数报告</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>一周文章链接点击量统计数据</strong>
                                    </p>
                                    <div class="chart">
                                        <canvas id="art_chart" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td>服务器域名： {{ $systemInfo['hostName'] }}</td>
                    </tr>
                    <tr>
                        <td>PHP版本： {{ $systemInfo['phpVersion'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器端信息：{{ $systemInfo['runOS'] }}/{{ $systemInfo['serverInfo'] }}</td>
                    </tr>
                    <tr>
                        <td>最大上传限制：{{ $systemInfo['maxUploadSize'] }}</td>
                    </tr>
                    <tr>
                        <td>最大执行时间：{{ $systemInfo['maxExecutionTime'] }} seconds</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
<!-- /.content-wrapper -->

@section('script')
<script type="text/javascript" src="{{ asset('/static/js/chartjs/chartjs.js') }}"></script>
<script type="text/javascript">
$(function () {
set_active_menu('root_menu', "{{ route('admin.index.index') }}");
var webChart = new Chart($("#web_chart"), {
type: 'bar',
        data: {
        labels: [{!! implode(",", $chartLabels) !!}],
                datasets: [
                {
                label: '点击数',
                        backgroundColor: "rgba(199,237,204,0.8)",
                        borderColor: "rgba(199,237,204,0.8)",
                        fill: false,
                        data:[{!! implode(",", $count) !!}]
                },
                ]
        },
        options: {
        scales: {
        yAxes: [{
        ticks: {
        beginAtZero:true
        }
        }]
        }
        }
});
var artChart = new Chart($("#art_chart"), {
type: 'bar',
        data: {
        labels: [{!! implode(",", $chartLabels) !!}],
                datasets: [
                {
                label: '点击数',
                        backgroundColor: "rgba(199,237,204,0.8)",
                        borderColor: "rgba(199,237,204,0.8)",
                        fill: false,
                        data:[{!! implode(",", $artCount) !!}]
                },
                ]
        },
        options: {
        scales: {
        yAxes: [{
        ticks: {
        beginAtZero:true
        }
        }]
        }
        }
});
});
</script>
@endsection