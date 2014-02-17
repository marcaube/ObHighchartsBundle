<?php

namespace Ob\HighchartsBundle\Highcharts;

use Zend\Json\Json;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class Highstock extends AbstractChart implements ChartInterface
{
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
            $chartJS = 'window.addEvent(\'domready\', function () {';
        } elseif ($engine == 'jquery') {
            $chartJS = "$(function () {";
        }
        $chartJS .= "\n    var " . (isset($this->chart->renderTo) ? $this->chart->renderTo : 'chart') . " = new Highcharts.StockChart({\n";

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

        // Labels

        // Legend
        if (get_object_vars($this->legend->legend)) {
            $chartJS .= "        legend: " .
                Json::encode($this->legend->legend,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // Loading
        // Navigation

        // PlotOptions
        if (get_object_vars($this->plotOptions->plotOptions)) {
            $chartJS .= "        plotOptions: " .
                Json::encode($this->plotOptions->plotOptions,
                    false,
                    array('enableJsonExprFinder' => true)) . ",\n";
        }

        // RangeSelector
        $chartJS .= $this->renderWithJavascriptCallback($this->rangeSelector->rangeSelector, "rangeSelector");

        // Scrollbar

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

        if ($engine != false) {
            $chartJS .= "});\n";
        }

        return trim($chartJS);
    }
}
