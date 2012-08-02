# ObHighchartsBundle

`ObHighchartsBundle` aims to ease the use of highcharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions to do the heavy lifting. The bundle uses the excellent JS library Highcharts and a PHP wrapper
by the guys at [Gravity.com](http://gravity.com/)

* [Highcharts' Home Page](http://http://www.highcharts.com)
* [HighRoller's Home Page](http://highroller.io) / [Gravity.com](http://gravity.com/)


## Quicknav
* [Why](#why-)
* [How to get started](#how-to-get-started)
* [Usage](#usage)
* [List of things to do](#todo)

## Why ?

Because I grew tired of defining data series in php and then doing the exact same thing with a different syntax in 
javascript to display the graph. I needed something to do the heavy lifting for me and take care of the boilerplate 
code.

When I found HighRoller, the PHP wrapper, I just had to make a bundle I could reuse accross my projects. This project is
in a ***really*** early stage as I don't know yet how I'm going to do things.

I'd like to be able to define things in the controller, and change the way the graph/chart appears depending on the data.
I'd also like to have template tags to do the same thing directly in the view.

## How to get started

### Installation

Add the following lines to your `deps` file:

    [ObHighchartsBundle]
        git=git://github.com/marcaube/ObHighchartsBundle.git
        target=/bundles/Ob/HighchartsBundle

Now, run the vendors script to download the bundle:

``` bash
    $ php bin/vendors install
```

Then configure the Autoloader

``` php
    <?php
    ...
    'Ob' => __DIR__.'/../vendor/bundles',
```

And finally register the bundle in your `app/AppKernel.php`:

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
    use Ob\HighchartsBundle\HighRoller\HighRoller;
    use Ob\HighchartsBundle\HighRoller\HighRollerSeriesData;
    use Ob\HighchartsBundle\HighRoller\HighRollerLineChart;

    // ...
    public function chartAction()
    {
        // Chart
        $series = new HighRollerSeriesData();
        $series->addName('Data Serie Name')->addData(array(1,2,4,5,6,3,8));

        $chart = new HighRollerLineChart();
        $chart->chart->renderTo = 'linechart';  // The #id of the div where to render the chart
        $chart->title->text = 'Chart Title';
        $chart->xAxis->title->text = 'Horizontal axis title';
        $chart->yAxis->title->text = 'Vertical axis title';
        $chart->addSeries($series);

        return $this->render('::your_template.html.twig', array(
            'chart' => $chart
        ));
    }
```

In your template ...

``` html
    <script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
    <script type="text/javascript">
        {{ chart(chart) }}
    </script>

    <div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !

## Todo
* Look how other chart-rendering bundles do and evaluate the best way to do things
* Ease the conversion of a Collection of entities to an associative array Highcharts can use. Provide functions to do it.
* Try not to ship with with HighRoller or Highcharts. This is impossible if there need to be changes to them though...
