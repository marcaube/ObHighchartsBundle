<?php

namespace Ob\HighchartsBundle\Tests;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Ob\HighchartsBundle\Twig\HighchartsExtension;

/**
 * This class hold Unit tests for the Twig extension
 */
class TwigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Chart rendering using the twig extension
     */
    public function testTwigExtension()
    {
        $chart = new Highchart();
        $extension = new HighchartsExtension();

        $this->assertEquals('highcharts_extension', $extension->getName());

        $this->assertArrayHasKey('chart', $extension->getFunctions());

        // render with jquery
        $this->assertRegExp(
            '/\$\(function\(\)\{\n?\r?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $extension->chart($chart)
        );

        // render with jquery explicitly
        $this->assertRegExp(
            '/\$\(function\(\)\{\n?\r?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $extension->chart($chart, 'jquery')
        );

        // render with mootools
        $this->assertRegExp(
            '/window.addEvent\(\'domready\', function\(\) \{\r?\n?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $extension->chart($chart, 'mootools')
        );
    }
}