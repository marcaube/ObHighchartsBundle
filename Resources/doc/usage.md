# Usage


## Basic Line Chart

In your controller ...

``` php
<?php

use Ob\HighchartsBundle\Highcharts\Highchart;

// ...
public function chartAction()
{
    // Chart
    $series = array(
        array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
    );

    $ob = new Highchart();
    $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
    $ob->title->text('Chart Title');
    $ob->xAxis->title(array('text'  => "Horizontal axis title"));
    $ob->yAxis->title(array('text'  => "Vertical axis title"));
    $ob->series($series);

    return $this->render('::your_template.html.twig', array(
        'chart' => $ob
    ));
}
```

In your template ...

``` html
<!-- Load jQuery from Google's CDN if needed -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="//code.highcharts.com/4.1.8/highcharts.js"></script>
<script src="//code.highcharts.com/4.1.8/modules/exporting.js"></script>
<script type="text/javascript">
    {{ chart(chart) }}
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !


## Use highcharts with mootools

If you'd like to use mootools instead of jquery to render your charts, just load the mootools adapter use the second
argument of the twig extension like this

``` html
<!-- Load MooTools from Google's CDN if needed and the highcharts adapter -->
<script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.2/mootools-yui-compressed.js" type="text/javascript"></script>
<script src="//code.highcharts.com/3.0.10/adapters/mootools-adapter.js" type="text/javascript"></script>

<script src="//code.highcharts.com/4.1.8/highcharts.js"></script>
<script src="//code.highcharts.com/4.1.8/modules/exporting.js"></script>
<script type="text/javascript">
    {{ chart(chart, 'mootools') }}
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```


## Use highcharts without a jquery or mootools wrapper

It is also possible to render your highcharts code without a jquery or mootools wrapper. This is useful when you want
control how and when the chart is loaded or when integrating with existing code.

``` html
<script src="//code.highcharts.com/4.1.8/highcharts.js"></script>
<script src="//code.highcharts.com/4.1.8/modules/exporting.js"></script>
<script type="text/javascript">
    myLib.chartLoad(function(data){
        {{ chart(chart, false) }}
    });
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```


## Use a Javascript anonymous function

There are several use case where you need to define a js function, let's see how to use one for a tooltip formatter

``` php
// ...
$func = new Zend\Json\Expr("function() {
    return 'The value for <b>'+ this.x +
    '</b> is <b>'+ this.y +'</b>';
}");

$ob = new Highchart();
$ob->tooltip->formatter($func);
// ...
```
