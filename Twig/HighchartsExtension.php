<?php
namespace Ob\HighchartsBundle\Twig;

use Ob\HighchartsBundle\HighRoller\HighRoller;
use Ob\HighchartsBundle\HighRoller\HighRollerSeriesData;
use Ob\HighchartsBundle\HighRoller\HighRollerLineChart;

class HighchartsExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'chart' => new \Twig_Function_Method($this, 'chart', array('is_safe' => array('html'))),
            'line_chart' => new \Twig_Function_Method($this, 'lineChart', array('is_safe' => array('html'))),
        );
    }

    public function chart($chart)
    {
        return $chart->renderChart();
    }

    public function lineChart($data, $params = array())
    {
        // TODO: use the params array for title, xAxis title, yAxis title, etc.
        $series = new HighRollerSeriesData();
        $series->addName('myData')->addData($data);

        $chart = new HighRollerLineChart();
        $chart->chart->renderTo = 'linechart';
        $chart->title->text = 'Hello HighRoller';
        $chart->xAxis->title->text = 'Total';
        $chart->yAxis->title->text = 'Total';
        $chart->addSeries($series);

        return $chart->renderChart();
    }

    public function getName()
    {
        return 'highcharts_extension';
    }
}