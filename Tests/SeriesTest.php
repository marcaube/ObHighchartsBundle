<?php

namespace Ob\HighchartsBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the series option
 */
class SeriesTest extends WebTestCase
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
     * Series output
     */
    public function testData()
    {
        $linechart = new Highchart();
        $linechart->series($this->series);

        $this->assertRegExp('/\{"name":"Data Serie #1","data":\[1,2,4,5,6,3,8\]\}/',$linechart->render());
        $this->assertRegExp('/\{"name":"Data Serie #2","data":\[7,3,5,1,6,5,9\]\}/',$linechart->render());
    }

}