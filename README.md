# ObHighchartsBundle - A simple chart bundle using HighRoller, a PHP wrapper for Highcharts.js

`ObHighchartsBundle` aims to ease the use of highcharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions to do the heavy lifting. The bundle uses the excellent JS library Highcharts and a PHP wrapper
by the guys at [Gravity.com](http://gravity.com/)

* Highcharts [Home Page](http://http://www.highcharts.com)
* HighRoller [Home Page](http://highroller.io) [Gravity.com](http://gravity.com/)

## How to get started

### Installation

Add the following lines to your `deps` file:

    [ObHighchartsBundle]
        git=git://github.com/marcaube/ObHighchartsBundle.git
        target=/bundles/Ob/HighchartsBundle

Now, run the vendors script to download the bundle:

    $ php bin/vendors install

Then configure the Autoloader

    <?php
    ...
    'Ob' => __DIR__.'/../vendor/bundles',

And finally register the bundle in your `AppKernel.php`:

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


## Usage

### Basic Line Chart

In your controller ...

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

In your template ...

    <script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
    <script type="text/javascript">
        {{ chart(chart) }}
    </script>

    <div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

Voilà !