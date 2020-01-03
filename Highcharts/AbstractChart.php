<?php

namespace Ob\HighchartsBundle\Highcharts;

use Laminas\Json\Json;

abstract class AbstractChart
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
    public $rangeSelector;
    public $point;
    public $series;
    public $drilldown;
    public $subtitle;
    public $symbols;
    public $title;
    public $tooltip;
    public $xAxis;
    public $yAxis;
    public $exporting;
    public $navigation;
    public $pane;
    public $scrollbar;

    public function __construct()
    {
        $chartOptions = array('chart', 'credits', 'global', 'labels', 'lang', 'legend', 'loading', 'plotOptions',
            'rangeSelector', 'point', 'subtitle', 'title', 'tooltip', 'xAxis', 'yAxis', 'pane', 'exporting',
            'navigation', 'drilldown', 'scrollbar');

        foreach ($chartOptions as $option) {
            $this->initChartOption($option);
        }

        $arrayOptions = array('colors', 'series', 'symbols');

        foreach ($arrayOptions as $option) {
            $this->initArrayOption($option);
        }
    }

    abstract public function render();

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $this->$name = $value;

        return $this;
    }

    /**
     * @param string $name
     */
    protected function initChartOption($name)
    {
        $this->{$name} = new ChartOption($name);
    }

    /**
     * @param string $name
     */
    protected function initArrayOption($name)
    {
        $this->{$name} = array();
    }

    /**
     * @param ChartOption|array $chartOption
     * @param string            $name
     *
     * @return string
     */
    protected function renderWithJavascriptCallback($chartOption, $name)
    {
        $result = "";

        if (gettype($chartOption) === 'array') {
            $result .= $this->renderArrayWithCallback($chartOption, $name);
        }

        if (gettype($chartOption) === 'object') {
            $result .= $this->renderObjectWithCallback($chartOption, $name);
        }

        return $result;
    }

    /**
     * @param array  $chartOption
     * @param string $name
     *
     * @return string
     */
    protected function renderArrayWithCallback($chartOption, $name)
    {
        $result = "";

        if (!empty($chartOption)) {
            // Zend\Json is used in place of json_encode to preserve JS anonymous functions
            $result .= $name . ": " . Json::encode($chartOption[0], false, array('enableJsonExprFinder' => true)) . ", \n";
        }

        return $result;
    }

    /**
     * @param ChartOption $chartOption
     * @param string      $name
     *
     * @return string
     */
    protected function renderObjectWithCallback($chartOption, $name)
    {
        $result = "";

        if (get_object_vars($chartOption)) {
            // Zend\Json is used in place of json_encode to preserve JS anonymous functions
            $result .= $name . ": " . Json::encode($chartOption, false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }

    /**
     * @param string $engine
     *
     * @return string
     */
    protected function renderEngine($engine)
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
    protected function renderColors()
    {
        if (!empty($this->colors)) {
            return "colors: " . json_encode($this->colors) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderCredits()
    {
        if (get_object_vars($this->credits->credits)) {
            return "credits: " . json_encode($this->credits->credits) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderSubtitle()
    {
        if (get_object_vars($this->subtitle->subtitle)) {
            return "subtitle: " . json_encode($this->subtitle->subtitle) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderTitle()
    {
        if (get_object_vars($this->title->title)) {
            return "title: " . json_encode($this->title->title) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderXAxis()
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
    protected function renderYAxis()
    {
        if (gettype($this->yAxis) === 'array') {
            return $this->renderWithJavascriptCallback($this->yAxis, "yAxis");
        } elseif (gettype($this->yAxis) === 'object') {
            return $this->renderWithJavascriptCallback($this->yAxis->yAxis, "yAxis");
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderOptions()
    {
        $result = "";

        if (get_object_vars($this->global->global) || get_object_vars($this->lang->lang)) {
            $result .= "\n    Highcharts.setOptions({";
            $result .= $this->renderGlobal();
            $result .= $this->renderLang();
            $result .= "    });\n";
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function renderGlobal()
    {
        if (get_object_vars($this->global->global)) {
            return "global: " . json_encode($this->global->global) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderLang()
    {
        if (get_object_vars($this->lang->lang)) {
            return "lang: " . json_encode($this->lang->lang) . ",\n";
        }

        return "";
    }

    /**
     * @return string
     */
    protected function renderScrollbar()
    {
        if (get_object_vars($this->scrollbar->scrollbar)) {
            return 'scrollbar: ' . json_encode($this->scrollbar->scrollbar) . ",\n";
        }

        return '';
    }
}
