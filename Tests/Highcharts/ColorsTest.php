<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the colors option
 */
class ColorsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Series output
     */
    public function testColors()
    {
        $linechart = new Highchart();

        $colors = array('#FF0000', '#00FF00', '#0000FF');
        $linechart->colors($colors);
        $this->assertRegExp('/colors: \[\["#FF0000","#00FF00","#0000FF"\]\]/', $linechart->render());
    }
}
