# ObHighchartsBundle - A simple chart bundle using HighRoller, a PHP wrapper for Highcharts.js

This bundle aims to ease the use of highcharts to display rich graph and charts in your Symfony2 application.

* Highcharts [Home Page](http://http://www.highcharts.com)
* HighRoller [Home Page](http://highroller.io)

## How to get started

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