<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the legend option
 */
class LegendTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Align option (left/center/right)
     */
    public function testAlign()
    {
        $chart = new Highchart();

        $chart->legend->align("left");
        $this->assertRegExp('/legend: \{"align":"left"\}/', $chart->render());

        $chart->legend->align("center");
        $this->assertRegExp('/legend: \{"align":"center"\}/', $chart->render());

        $chart->legend->align("right");
        $this->assertRegExp('/legend: \{"align":"right"\}/', $chart->render());
    }

    /**
     * Layout option (horizontal/vertical)
     */
    public function testLayout()
    {
        $chart = new Highchart();

        $chart->legend->layout("horizontal");
        $this->assertRegExp('/legend: \{"layout":"horizontal"\}/', $chart->render());

        $chart->legend->layout("vertical");
        $this->assertRegExp('/legend: \{"layout":"vertical"\}/', $chart->render());
    }

    /**
     * Enabled option (true/false)
     */
    public function testEnabledDisabled()
    {
        $chart = new Highchart();

        $chart->legend->enabled(false);
        $this->assertRegExp('/legend: \{"enabled":false\}/', $chart->render());

        $chart->legend->enabled(true);
        $this->assertRegExp('/legend: \{"enabled":true\}/', $chart->render());
    }
}
