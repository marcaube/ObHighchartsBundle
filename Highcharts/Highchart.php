<?php

namespace Ob\HighchartsBundle\Highcharts;

use Zend\Json\Json;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class Highchart
{
    // Default options
    public $chart;
    public $colors;
    public $credits;
    public $global;
    public $labels;
    public $lang;
    public $legend;
    public $loading;
    public $plotOptions;
    public $point;
    public $series;
    public $subtitle;
    public $symbols;
    public $title;
    public $tooltip;
    public $xAxis;
    public $yAxis;
    public $exporting;
    public $navigation;


    public function __construct()
    {
        $this->chart = new ChartOption('chart');
        $this->colors = array();
        $this->credits = new ChartOption('credits');
        $this->global = new ChartOption('global');
        $this->labels = new ChartOption('labels');
        $this->lang = new ChartOption('lang');
        $this->legend = new ChartOption('legend');
        $this->loading = new ChartOption('loading');
        $this->plotOptions = new ChartOption('plotOptions');
        $this->point = new ChartOption('point');
        $this->series = array();
        $this->subtitle = new ChartOption('subtitle');
        $this->symbols = array();
        $this->title = new ChartOption('title');
        $this->tooltip = new ChartOption('tooltip');
        $this->xAxis = new ChartOption('xAxis');
        $this->yAxis = new ChartOption('yAxis');

        $this->exporting = new ChartOption('exporting');
        $this->navigation = new ChartOption('navigation');
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $this->$name = $value;

        return $this;
    }

    /**
     * @param string $engine
     *
     * @return string
     */
    public function render($engine = 'jquery')
    {
        $chartJS = "";

        // jQuery or MooTools
        if ($engine == 'mootools') {
            $chartJS = 'window.addEvent(\'domready\', function() {';
        } elseif($engine == 'jquery') {
            $chartJS = "$(function(){";
        }
        $chartJS .= "\n    var " . (isset($this->chart->renderTo) ? $this->chart->renderTo : 'chart') . " = new Highcharts.Chart({\n";

        // Chart Option
        if (get_object_vars($this->chart->chart)) {
            $chartJS .= "        chart: " .
                Json::encode($this->chart->chart,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Colors
        if (!empty($this->colors)) {
            $chartJS .= "        colors: " . json_encode($this->colors) . ",\n";
        }

        // Credits
        if (get_object_vars($this->credits->credits)) {
            $chartJS .= "        credits: " . json_encode($this->credits->credits) . ",\n";
        }

        // Exporting
        if (get_object_vars($this->exporting->exporting)) {
            $chartJS .= "        exporting: " .
                Json::encode($this->exporting->exporting,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Global
        if (get_object_vars($this->global->global)) {
            $chartJS .= "        global: " . json_encode($this->global->global) . ",\n";
        }

        // Labels
        // Lang

        // Legend
        if (get_object_vars($this->legend->legend)) {
            $chartJS .= "        legend: " .
                Json::encode($this->legend->legend,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Loading
        // Navigation
        // Pane

        // PlotOptions
        if (get_object_vars($this->plotOptions->plotOptions)) {
            $chartJS .= "        plotOptions: " .
                Json::encode($this->plotOptions->plotOptions,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Series
        if (!empty($this->series)) {
            $chartJS .= "        series: " .
                Json::encode($this->series[0],
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Subtitle
        if (get_object_vars($this->subtitle->subtitle)) {
            $chartJS .= "        subtitle: " . json_encode($this->subtitle->subtitle) . ",\n";
        }

        // Symbols

        // Title
        if (get_object_vars($this->title->title)) {
            $chartJS .= "        title: " . json_encode($this->title->title) . ",\n";
        }

        // Tooltip
        if (get_object_vars($this->tooltip->tooltip)) {
            $chartJS .= "        tooltip: " .
                Json::encode($this->tooltip->tooltip,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // xAxis
        if (gettype($this->xAxis) === 'array') {
            if (!empty($this->xAxis)) {
                $chartJS .= "        xAxis: " .
                    Json::encode($this->xAxis[0],
                        false,
                        array('enableJsonExprFinder' => true)) . ",\n";
            }
        } elseif (gettype($this->xAxis) === 'object') {
            if (get_object_vars($this->xAxis->xAxis)) {
                $chartJS .= "        xAxis: " .
                    Json::encode($this->xAxis->xAxis,
                        false,
                        array('enableJsonExprFinder' => true)) . ",\n";
            }
        }

        // yAxis
        if (gettype($this->yAxis) === 'array') {
            if (!empty($this->yAxis)) {
                $chartJS .= "        yAxis: " .
                    Json::encode($this->yAxis[0],
                        false,
                        array('enableJsonExprFinder' => true)) . ",\n";
            }
        } elseif (gettype($this->yAxis) === 'object') {
            if (get_object_vars($this->yAxis->yAxis)) {
                $chartJS .= "        yAxis: " .
                    Json::encode($this->yAxis->yAxis,
                        false,
                        array('enableJsonExprFinder' => true)) . ",\n";
            }
        }

        // trim last trailing comma and close parenthesis
        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";

        if($engine != false){
            $chartJS .= "});\n";
        }

        return trim($chartJS);
    }
}
