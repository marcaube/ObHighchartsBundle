<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;
use PHPUnit\Framework\TestCase;

/**
 * This class hold Unit tests for the colors option
 */
class ColorsTest extends TestCase
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
