# ObHighchartsBundle

`ObHighchartsBundle` eases the use of highcharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions and PHP objects to do the heavy lifting. The bundle uses the excellent JS library
[Highcharts](http://www.highcharts.com).

DRY out your chart code by writing it all in PHP!

[![Build Status](https://travis-ci.org/marcaube/ObHighchartsBundle.png?branch=master)](https://travis-ci.org/marcaube/ObHighchartsBundle)
[![Total Downloads](https://poser.pugx.org/ob/highcharts-bundle/downloads.png)](https://packagist.org/packages/ob/highcharts-bundle)

## Content
* License
* The Why
* How to get started / Installation
* Usage
    * Make a basic line-chart
    * Use mootools instead of jQuery
    * Use js anonymous functions
* Cookbook
    * Pie chart with legend (like [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend))
    * Make a Multi-axes plot (like [highcharts.com/demo/combo-multi-axes](http://www.highcharts.com/demo/combo-multi-axes))

## License
ObHighchartsBundle is released under the MIT License. See the bundled [LICENSE](https://github.com/marcaube/ObHighchartsBundle/blob/master/LICENSE)
file for details.

Please note that the Highcharts JS library bundled with the project is **not** free for commercial use, see their
[FAQ](http://shop.highsoft.com/faq) for more details on what constitutes a non-commercial project or their [product page](http://shop.highsoft.com/highcharts.html)
for details on pricing.


## Why ?

Because I grew tired of defining data series in php and then doing the exact same thing with a different syntax in 
javascript to display the graph. I needed something to do the heavy lifting for me and take care of the boilerplate 
code.

## How to get started

### Installation

1. Add the following to your `composer.json` file
   ```json
       "require": {
           ...
           "ob/highcharts-bundle": "1.*"
           ...
       }
   ```

2. Run `php composer.phar update "ob/highcharts-bundle"`

3. Register the bundle in your `app/AppKernel.php`:

   ``` php
       <?php
       ...
       public function registerBundles()
       {
           $bundles = array(
               ...
               new Ob\HighchartsBundle\ObHighchartsBundle(),
               ...
           );
       ...
   ```

## Usage

### Basic Line Chart

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

<script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
<script type="text/javascript">
    {{ chart(chart) }}
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !


### Use highcharts with mootools
If you'd like to use mootools instead of jquery to render your charts, just load the mootools adapter use the second
argument of the twig extension like this

``` html
<!-- Load MooTools from Google's CDN if needed and the highcharts adapter -->
<script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.2/mootools-yui-compressed.js" type="text/javascript"></script>
<script src="{{ asset('bundles/obhighcharts/js/highcharts/adapters/mootools-adapter.js') }}" type="text/javascript"></script>

<script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
<script type="text/javascript">
    {{ chart(chart, 'mootools') }}
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

### Use highcharts without a jquery or mootools wrapper
It is also possible to render your highcharts code without a jquery or mootools wrapper. This is useful when you want
control how and when the chart is loaded or when integrating with existing code.
``` html
<script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
<script type="text/javascript">
    myLib.chartLoad(function(data){
        {{ chart(chart, false) }}
    }
</script>

<div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

### Use a Javascript anonymous function
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

## Cookbook

### Pie chart with legend
This is a simple recipe to re-create the pie-chart demo with legend at [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend)

```php
$ob = new Highchart();
$ob->chart->renderTo('linechart');
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

### Multi-axes plot
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
