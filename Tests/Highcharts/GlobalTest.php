<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the global option
 */
class GlobalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * useUTC option (true/false)
     */
    public function testGlobal()
    {
        $chart = new Highchart();

        $chart->global->useUTC("true");
        $this->assertRegExp('/global: \{"useUTC":"true"\}/', $chart->render());

        $chart->global->useUTC("false");
        $this->assertRegExp('/global: \{"useUTC":"false"\}/', $chart->render());
    }

    /**
     * noData option (string)
     */
    public function testLang()
    {
        $chart = new Highchart();

        $chart->lang->noData("No data to display");
        $this->assertRegExp('/"noData":"No data to display"/', $chart->render());
    }
}
