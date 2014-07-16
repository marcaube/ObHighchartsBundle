# Cookbook


## Pie chart with legend

This is a simple recipe to re-create the pie-chart demo with legend at [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend)

```php
$ob = new Highchart();
$ob->chart->renderTo('piechart');
$ob->title->text('Browser market shares at a specific website in 2010');
$ob->plotOptions->pie(array(
    'allowPointSelect'  => true,
    'cursor'    => 'pointer',
    'dataLabels'    => array('enabled' => false),
    'showInLegend'  => true
));
$data = array(
    array('Firefox', 45.0),
    array('IE', 26.8),
    array('Chrome', 12.8),
    array('Safari', 8.5),
    array('Opera', 6.2),
    array('Others', 0.7),
);
$ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
```

## Pie chart with Drilldown

This is a simple recipe to re-create a chart similar to the drilldown pie-chart demo at [highcharts.com/demo/pie-drilldown](http://www.highcharts.com/demo/pie-drilldown)

```php
$ob = new Highchart();
$ob->chart->renderTo('container');
$ob->chart->type('pie');
$ob->title->text('Browser market shares. November, 2013.');
$ob->plotOptions->series(
    array(
        'dataLabels' => array(
            'enabled' => true,
            'format' => '{point.name}: {point.y:.1f}%'
        )
    )
);

$ob->tooltip->headerFormat('<span style="font-size:11px">{series.name}</span><br>');
$ob->tooltip->pointFormat('<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>');

$data = array(
    array(
        'name' => 'Chrome',
        'y' => 18.73,
        'drilldown' => 'Chrome',
        'visible' => true
    ),
    array(
        'name' => 'Microsoft Internet Explorer',
        'y' => 53.61,
        'drilldown' => 'Microsoft Internet Explorer',
        'visible' => true
    ),
    array('Firefox', 45.0),
    array('Opera', 1.5)
);
$ob->series(
    array(
        array(
            'name' => 'Browser share',
            'colorByPoint' => true,
            'data' => $data
        )
    )
);

$drilldown = array(
    array(
        'name' => 'Microsoft Internet Explorer',
        'id' => 'Microsoft Internet Explorer',
        'data' => array(
            array("v8.0", 26.61),
            array("v9.0", 16.96),
            array("v6.0", 6.4),
            array("v7.0", 3.55),
            array("v8.0", 0.09)
        )
    ),
    array(
        'name' => 'Chrome',
        'id' => 'Chrome',
        'data' => array(
            array("v19.0", 7.73),
            array("v17.0", 1.13),
            array("v16.0", 0.45),
            array("v18.0", 0.26)
        )
    ),
);
$ob->drilldown->series($drilldown);
```

## Multi-axes plot

This is a simple recipe for creating a plot with multiple y-axes, similar to [the highcharts demo](http://www.highcharts.com/demo/combo-multi-axes)

```php
$series = array(
    array(
        'name'  => 'Rainfall',
        'type'  => 'column',
        'color' => '#4572A7',
        'yAxis' => 1,
        'data'  => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4),
    ),
    array(
        'name'  => 'Temperature',
        'type'  => 'spline',
        'color' => '#AA4643',
        'data'  => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
    ),
);
$yData = array(
    array(
        'labels' => array(
            'formatter' => new Expr('function () { return this.value + " degrees C" }'),
            'style'     => array('color' => '#AA4643')
        ),
        'title' => array(
            'text'  => 'Temperature',
            'style' => array('color' => '#AA4643')
        ),
        'opposite' => true,
    ),
    array(
        'labels' => array(
            'formatter' => new Expr('function () { return this.value + " mm" }'),
            'style'     => array('color' => '#4572A7')
        ),
        'gridLineWidth' => 0,
        'title' => array(
            'text'  => 'Rainfall',
            'style' => array('color' => '#4572A7')
        ),
    ),
);
$categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

$ob = new Highchart();
$ob->chart->renderTo('container'); // The #id of the div where to render the chart
$ob->chart->type('column');
$ob->title->text('Average Monthly Weather Data for Tokyo');
$ob->xAxis->categories($categories);
$ob->yAxis($yData);
$ob->legend->enabled(false);
$formatter = new Expr('function () {
                 var unit = {
                     "Rainfall": "mm",
                     "Temperature": "degrees C"
                 }[this.series.name];
                 return this.x + ": <b>" + this.y + "</b> " + unit;
             }');
$ob->tooltip->formatter($formatter);
$ob->series($series);
```
