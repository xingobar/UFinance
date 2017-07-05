@extends('layouts.app')

@section('static')
<!--<script src="https://d3js.org/d3.v4.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<style>
.bar {
  fill: steelblue;
}
.bar:hover {
  fill: brown;
}
.axis {
  font: 10px sans-serif;
}
.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}
.x-axis path {
  display: none;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="data">
                
            </div>
        </div>
    </div>
</div>

<script>
    var margin={
        top:20,
        right:20,
        bottom:30,
        left:40
    },
    width = 650 - margin.left - margin.right;
    height = 500 - margin.top - margin.bottom;

    var x = d3.scale.ordinal() // 序數比例尺
            .rangeRoundBands([0,width,.1]);
    var y = d3.scale.linear()
            .range([height,0]);
    var xAxis = d3.svg.axis()
                .scale(x)
                .orient('bottom');
    var yAxis = d3.svg.axis()
                .scale(y)
                .orient('left')
                .ticks(10,'');
    var svg = d3.select('#data')
                .append('svg')
                .attr('width',width + margin.left + margin.right)
                .attr('height',height + margin.bottom + margin.top)
                .append('g')
                .attr('transform','translate('+margin.left+','+margin.top+')');
    var data ;
    $.ajax({
        url:'/getAllData',
        async:false,
        success:function(accounts){
            data = accounts
        }
    });
    x.domain(data.map(function(d){
        return d.created_at;
    }));
    y.domain([0,d3.max(data,function(d){
        return d.amount;
    })]);

    svg.append('g')
        .attr('class','x-axis')
        .attr('transform','translate(0,'+height +')')
        .call(xAxis);

    svg.append('g')
        .attr('class','y-axis')
        .call(yAxis)
        .append('text')
        .attr('transform','rotate(-90)')
        .attr('y',6)
        .attr('dy','.71em')
        .style('text-anchor','end')
        .text('amount');
    
    svg.selectAll('bar')
        .data(data)
        .enter().append('rect')
        .attr('class','bar')
        .attr('x',function(d){
            return x(d.created_at);
        })
        .attr('width',x.rangeBand())
        .attr('y',function(d){
            return y(d.amount);
        })
        .attr('height',function(d){
            return height - y(d.amount);
        });
</script>
@endsection