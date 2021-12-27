@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Expensive') }} <div class="float-right"><a href="{{ URL::previous() }}"><button class="btn btn-default">Back</button></a></div></div>

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
                                    <th>Expensive</th>
                                    <th>Amount</th>
                                    <th>User Name</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($expensive)
                                    @foreach ($expensive as $k => $expense)
                                    <tr>
                                        <th>{{ $k+1 }}</th>
                                        <th>{{ $expense->expensive }}</th>
                                        <th>{{ $expense->amount }}</th>
                                        <th>{{ $expense->username  }} </th>
                                        <th>{{ $expense->created_at->format('d/M/Y H:i:s') }}</th>
                                    </tr>
                                    @endforeach 
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<script type="text/javascript">
window.onload = function() {
    var data ='{{ $chardata }}';
    var currentMonth = '{{ date("F") }}';
    data = JSON.parse(data.replace(/&quot;/g,'"'));
    var options = {
        title: {
            text: "Expensive For "+currentMonth+" month"
        },
        data: [{
                type: "pie",
                startAngle: 45,
                showInLegend: "true",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString: "##0.00\"%\"",
                toolTipContent: "<a href = {label}> {label}</a><hr/>Views: {y}",
                dataPoints: data,
        }]
    };
    $("#chartContainer").CanvasJSChart(options);

}
</script>
@endsection
