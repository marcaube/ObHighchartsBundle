<?php

namespace Ob\HighchartsBundle\Highcharts;

interface ChartInterface
{
    /**
     * @param string $engine
     *
     * @return string
     */
    public function render($engine);
}
