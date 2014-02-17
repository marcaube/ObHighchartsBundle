<?php

namespace Ob\HighchartsBundle\Highcharts;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class Highchart extends AbstractChart implements ChartInterface
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
        $chartJS .= "\n    var " . (isset($this->chart->renderTo) ? $this->chart->renderTo : 'chart') . " = new Highcharts.Chart({\n";

        // Chart Option
        $chartJS .= $this->renderWithJavascriptCallback($this->chart->chart, "chart");

        // Colors
        if (!empty($this->colors)) {
            $chartJS .= "        colors: " . json_encode($this->colors) . ",\n";
        }

        // Credits
        if (get_object_vars($this->credits->credits)) {
            $chartJS .= "        credits: " . json_encode($this->credits->credits) . ",\n";
        }

        // Exporting
        $chartJS .= $this->renderWithJavascriptCallback($this->exporting->exporting, "exporting");

        // Global
        if (get_object_vars($this->global->global)) {
            $chartJS .= "        global: " . json_encode($this->global->global) . ",\n";
        }

        // Labels
        // Lang

        // Legend
        $chartJS .= $this->renderWithJavascriptCallback($this->legend->legend, "legend");

        // Loading
        // Navigation
        // Pane
        if (get_object_vars($this->pane->pane)) {
            $chartJS .= "        pane: " . json_encode($this->pane->pane) . ",\n";
        }

        // PlotOptions
        $chartJS .= $this->renderWithJavascriptCallback($this->plotOptions->plotOptions, "plotOptions");

        // Series
        $chartJS .= $this->renderWithJavascriptCallback($this->series, "series");

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
        $chartJS .= $this->renderWithJavascriptCallback($this->tooltip->tooltip, "tooltip");

        // xAxis
        if (gettype($this->xAxis) === 'array') {
            $chartJS .= $this->renderWithJavascriptCallback($this->xAxis, "xAxis");
        } elseif (gettype($this->xAxis) === 'object') {
            $chartJS .= $this->renderWithJavascriptCallback($this->xAxis->xAxis, "xAxis");
        }

        // yAxis
        if (gettype($this->yAxis) === 'array') {
            $chartJS .= $this->renderWithJavascriptCallback($this->yAxis, "yAxis");
        } elseif (gettype($this->yAxis) === 'object') {
            $chartJS .= $this->renderWithJavascriptCallback($this->yAxis->yAxis, "yAxis");
        }

        // trim last trailing comma and close parenthesis
        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";

        if ($engine != false) {
            $chartJS .= "});\n";
        }

        return trim($chartJS);
    }
}
