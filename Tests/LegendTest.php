<?php

namespace Ob\HighchartsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the legend option
 */
class LegendTest extends WebTestCase
{
    /**
     * @var array
     */
    private $series;


    /**
     * Initialises the data
     */
    public function setUp()
    {
        $this->series = array(
            array("name" => "Data Serie #1",    "data" => array(1,2,4,5,6,3,8)),
            array("name" => "Data Serie #2",    "data" => array(7,3,5,1,6,5,9))
        );
    }


    /**
     * Align option (left/center/right)
     */
    public function testAlign()
    {
        $linechart = new Highchart();
        $linechart->series($this->series);

        $linechart->legend->align("left");
        $this->assertRegExp('/legend: \{"align":"left"\}/',$linechart->render());

        $linechart->legend->align("center");
        $this->assertRegExp('/legend: \{"align":"center"\}/',$linechart->render());

        $linechart->legend->align("right");
        $this->assertRegExp('/legend: \{"align":"right"\}/',$linechart->render());
    }


    /**
     * Layout option (horizontal/vertical)
     */
    public function testLayout()
    {
        $linechart = new Highchart();
        $linechart->series($this->series);

        $linechart->legend->layout("horizontal");
        $this->assertRegExp('/legend: \{"layout":"horizontal"\}/',$linechart->render());

        $linechart->legend->layout("vertical");
        $this->assertRegExp('/legend: \{"layout":"vertical"\}/',$linechart->render());
    }


    /**
     * Enabled option (true/false)
     */
    public function testEnabledDisabled()
    {
        $linechart = new Highchart();
        $linechart->series($this->series);

        $linechart->legend->enabled(false);
        $this->assertRegExp('/legend: \{"enabled":false\}/',$linechart->render());

        $linechart->legend->enabled(true);
        $this->assertRegExp('/legend: \{"enabled":true\}/',$linechart->render());
    }

}