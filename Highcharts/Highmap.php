<?php

namespace Ob\HighchartsBundle\Highcharts;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class Highmap extends AbstractChart implements ChartInterface
{
    public $colorAxis;
    public $mapNavigation;

    public function __construct()
    {
        parent::__construct();
        $this->initChartOption('colorAxis');
        $this->initChartOption('mapNavigation');
    }

    /**
     * @param string $engine
     *
     * @return string
     */
    public function render($engine = 'jquery')
    {
        $chartJS = "";
        $chartJS .= $this->renderEngine($engine);
        $chartJS .= $this->renderOptions();
        $chartJS .= "\n    var " . (isset($this->chart->renderTo) ? $this->chart->renderTo : 'chart') . " = new Highcharts.Map({\n";

        // Chart Option
        $chartJS .= $this->renderWithJavascriptCallback($this->chart->chart, "chart");

        // Colors
        $chartJS .= $this->renderColors();

        // Color Axis
        $chartJS .= $this->renderColorAxis();

        // Credits
        $chartJS .= $this->renderCredits();

        // Exporting
        $chartJS .= $this->renderWithJavascriptCallback($this->exporting->exporting, "exporting");

        // Labels

        // Legend
        $chartJS .= $this->renderWithJavascriptCallback($this->legend->legend, "legend");

        // MapNavigation
        $chartJS .= $this->renderWithJavascriptCallback($this->mapNavigation->mapNavigation, "mapNavigation");

        // Loading
        // Navigation

        // PlotOptions
        $chartJS .= $this->renderWithJavascriptCallback($this->plotOptions->plotOptions, "plotOptions");

        // RangeSelector
        $chartJS .= $this->renderWithJavascriptCallback($this->rangeSelector->rangeSelector, "rangeSelector");

        // Scrollbar
        $chartJS .= $this->renderScrollbar();

        // Series
        $chartJS .= $this->renderWithJavascriptCallback($this->series, "series");

        // Subtitle
        $chartJS .= $this->renderSubtitle();

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

        if ($engine !== false) {
            $chartJS .= "});\n";
        }

        return trim($chartJS);
    }

    /**
     * @return string
     */
    private function renderColorAxis()
    {
        if (gettype($this->colorAxis) === 'array') {
            return $this->renderWithJavascriptCallback($this->colorAxis, "colorAxis");
        } elseif (gettype($this->colorAxis) === 'object') {
            return $this->renderWithJavascriptCallback($this->colorAxis->colorAxis, "colorAxis");
        }

        return "";
    }
}