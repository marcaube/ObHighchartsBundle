<?php

namespace Ob\HighchartsBundle\Highcharts;

use Zend\Json\Json;

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
    public $subtitle;
    public $symbols;
    public $title;
    public $tooltip;
    public $xAxis;
    public $yAxis;
    public $exporting;
    public $navigation;
    public $pane;

    public function __construct()
    {
        $chartOptions = array('chart', 'credits', 'global', 'labels', 'lang', 'legend', 'loading', 'plotOptions',
            'rangeSelector', 'point', 'subtitle', 'title', 'tooltip', 'xAxis', 'yAxis', 'pane', 'exporting',
            'navigation');

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
            $result .= $name . ": " . Json::encode($chartOption, false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }
}
