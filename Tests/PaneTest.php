<?php

namespace Ob\HighchartsBundle\Tests;

use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the pane option
 */
class PaneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @todo Write PHP Documentation for testBackground
//        pane: {
//            startAngle: -150,
//            endAngle: 150,
//            background: [{
//            backgroundColor: {
//                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
//                stops: [
//                [0, '#FFF'],
//                [1, '#333']
//                ]
//            },
//            borderWidth: 0,
//            outerRadius: '109%'
//            }, {
//                backgroundColor: {
//                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
//                stops: [
//                [0, '#333'],
//                [1, '#FFF']
//                ]
//                },
//                borderWidth: 1,
//                outerRadius: '107%'
//            }, {
//            // default background
//            }, {
//                backgroundColor: '#DDD',
//                borderWidth: 0,
//                outerRadius: '105%',
//                innerRadius: '103%'
//            }]
//            },
     *
     */
    public function testBackground()
    {
        $chart = new Highchart();
//        $this->assertRegExp('/pane: \{"background":\}/', $chart->render());
    }

    public function testCenter()
    {
        $chart = new Highchart();
        // pixel based
        $chart->pane->center(array(50, 100));
        $this->assertRegExp('/pane: \{"center":\[50,100\]\}/', $chart->render());

        // percentage based
        $chart->pane->center(array('50%', '40%'));
        $this->assertRegExp('/pane: \{"center":\["50%","40%"\]\}/', $chart->render());
    }

    public function testEndAngle()
    {
        $chart = new Highchart();
        $chart->pane->endAngle(5);
        $this->assertRegExp('/pane: \{"endAngle":5\}/', $chart->render());
    }

    public function testStartAngle()
    {
        $chart = new Highchart();
        $chart->pane->startAngle(5);
        $this->assertRegExp('/pane: \{"startAngle":5\}/', $chart->render());

    }




}