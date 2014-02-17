<?php

namespace Ob\HighchartsBundle\Tests\Highstock;

use Ob\HighchartsBundle\Highcharts\Highstock;

class ColorsTest extends \PHPUnit_Framework_TestCase
{
    public function testColors()
    {
        $chart = new Highstock();

        $colors = array('#FF0000', '#00FF00', '#0000FF');
        $chart->colors($colors);
        $this->assertRegExp('/colors: \[\["#FF0000","#00FF00","#0000FF"\]\]/', $chart->render());
    }
}
