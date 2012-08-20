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

        $this->assertTrue(array_key_exists('chart', $extension->getFunctions()));

        $this->assertRegExp(
            '/\$\(function\(\)\{\n?\r?\s*var chart = new Highcharts.Chart\(\{\n?\r?\s*\}\);\n?\r?\s*\}\);/',
            $extension->chart($chart)
        );
    }
}