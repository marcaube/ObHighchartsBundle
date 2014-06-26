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
        $chartJS .= $this->renderEngine($engine);
        $chartJS .= "\n    var " . (isset($this->chart->renderTo) ? $this->chart->renderTo : 'chart') . " = new Highcharts.Chart({\n";

        // Chart Option
        $chartJS .= $this->renderWithJavascriptCallback($this->chart->chart, "chart");

        // Colors
        $chartJS .= $this->renderColors();

        // Credits
        $chartJS .= $this->renderCredits();

        // Exporting
        $chartJS .= $this->renderWithJavascriptCallback($this->exporting->exporting, "exporting");

        // Global
        $chartJS .= $this->renderGlobal();

        // Labels
        // Lang

        // Legend
        $chartJS .= $this->renderWithJavascriptCallback($this->legend->legend, "legend");

        // Loading
        // Navigation
        // Pane
        $chartJS .= $this->renderPane();

        // PlotOptions
        $chartJS .= $this->renderWithJavascriptCallback($this->plotOptions->plotOptions, "plotOptions");

        // Series
        $chartJS .= $this->renderWithJavascriptCallback($this->series, "series");

        // Subtitle
        $chartJS .= $this->renderSubtitle();

        // Symbols

        // Title
        $chartJS .= $this->renderTitle();

        // Tooltip
        $chartJS .= $this->renderWithJavascriptCallback($this->tooltip->tooltip, "tooltip");

        // xAxis
        $chartJS .= $this->renderXAxis();

        // yAxis
        $chartJS .= $this->renderYAxis();

        // trim last trailing comma and close parenthesis
        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";

        if ($engine != false) {
            $chartJS .= "});\n";
        }

        return trim($chartJS);
    }

    /**
     * @param string $engine
     *
     * @return string
     */
    private function renderEngine($engine)
    {
        if ($engine == 'mootools') {
            return 'window.addEvent(\'domready\', function () {';
        } elseif ($engine == 'jquery') {
            return "$(function () {";
        }
    }

    /**
     * @return string
     */
    private function renderColors()
    {
        if (!empty($this->colors)) {
            return "colors: " . json_encode($this->colors) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderCredits()
    {
        if (get_object_vars($this->credits->credits)) {
            return "credits: " . json_encode($this->credits->credits) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderGlobal()
    {
        if (get_object_vars($this->global->global)) {
            return "global: " . json_encode($this->global->global) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderPane()
    {
        if (get_object_vars($this->pane->pane)) {
            return "pane: " . json_encode($this->pane->pane) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderSubtitle()
    {
        if (get_object_vars($this->subtitle->subtitle)) {
            return "subtitle: " . json_encode($this->subtitle->subtitle) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderTitle()
    {
        if (get_object_vars($this->title->title)) {
            return "title: " . json_encode($this->title->title) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderXAxis()
    {
        if (gettype($this->xAxis) === 'array') {
            return $this->renderWithJavascriptCallback($this->xAxis, "xAxis");
        } elseif (gettype($this->xAxis) === 'object') {
            return $this->renderWithJavascriptCallback($this->xAxis->xAxis, "xAxis");
        }

        return "";
    }

    /**
     * @return string
     */
    private function renderYAxis()
    {
        if (gettype($this->yAxis) === 'array') {
            return $this->renderWithJavascriptCallback($this->yAxis, "yAxis");
        } elseif (gettype($this->yAxis) === 'object') {
            return $this->renderWithJavascriptCallback($this->yAxis->yAxis, "yAxis");
        }

        return "";
    }
}
