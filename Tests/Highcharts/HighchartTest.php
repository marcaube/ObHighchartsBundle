<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;
use PHPUnit\Framework\TestCase;

/**
 * This class hold Unit tests for the Highchart Class
 */
class HighchartTest extends TestCase
{
    /**
     * Render chart using jQuery
     */
    public function testJquery()
    {
        $chart = new Highchart();
        $this->assertRegExp(
            '/\$\(function\s?\(\)\s?\{\n?\r?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $chart->render()
        );
    }

    /**
     * Render chart without library wrapper
     */
    public function testNoEngine()
    {
        $chart = new Highchart();
        $this->assertRegExp(
            '/var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);/',
            $chart->render(null)
        );
    }

    /**
     * Render chart using Mootools
     */
    public function testMooTools()
    {
        $chart = new Highchart();
        $this->assertRegExp(
            '/window.addEvent\(\'domready\', function\s?\(\)\s?\{\r?\n?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $chart->render('mootools')
        );
    }

    /**
     * Magic getters and setters
     */
    public function testSetGet()
    {
        $chart = new Highchart();

        $chart->credits->enabled(false);
        $this->assertTrue($chart->credits->enabled == false);

        $chart->credits->enabled(true);
        $this->assertTrue($chart->credits->enabled == true);
    }

    /**
     * Look for that mean trailing comma
     */
    public function testIeFriendliness()
    {
        $chart = new Highchart();

        $chart->chart->setTitle('Am I IE friendly yet?');
        $this->assertRegExp(
            '/\}(?<!,)\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $chart->render()
        );
    }
}
