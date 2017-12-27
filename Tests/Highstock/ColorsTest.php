<?php

namespace Ob\HighchartsBundle\Tests\Highstock;

use Ob\HighchartsBundle\Highcharts\Highstock;
use PHPUnit\Framework\TestCase;

class ColorsTest extends TestCase
{
    public function testColors()
    {
        $chart = new Highstock();

        $colors = array('#FF0000', '#00FF00', '#0000FF');
        $chart->colors($colors);
        $this->assertRegExp('/colors: \[\["#FF0000","#00FF00","#0000FF"\]\]/', $chart->render());
    }
}
