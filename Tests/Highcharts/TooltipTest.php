<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

/**
 * This class hold Unit tests for the tooltip option
 */
class TooltipTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Animation option (true/false)
     */
    public function testAnimation()
    {
        $chart = new Highchart();

        $chart->tooltip->animation("true");
        $this->assertRegExp('/tooltip: \{"animation":"true"\}/', $chart->render());

        $chart->tooltip->animation("false");
        $this->assertRegExp('/tooltip: \{"animation":"false"\}/', $chart->render());
    }

    /**
     * backgroundColor option (rgba)
     */
    public function testBackgroundColor()
    {
        $chart = new Highchart();

        $chart->tooltip->backgroundColor("rgba(255, 255, 255, .85)");
        $this->assertRegExp('/tooltip: \{"backgroundColor":"rgba\(255, 255, 255, .85\)"\}/', $chart->render());
    }

    /**
     * borderColor option (null/auto/rgba)
     */
    public function testBorderColor()
    {
        $chart = new Highchart();

        $chart->tooltip->borderColor('null');
        $this->assertRegExp('/tooltip: \{"borderColor":"null"\}/', $chart->render());

        $chart->tooltip->borderColor('auto');
        $this->assertRegExp('/tooltip: \{"borderColor":"auto"\}/', $chart->render());

        $chart->tooltip->borderColor('rgba(255, 255, 255, .85)');
        $this->assertRegExp('/tooltip: \{"borderColor":"rgba\(255, 255, 255, .85\)"\}/', $chart->render());
    }

    /**
     * borderRadius option (integer - radius in px)
     */
    public function testBorderRadius()
    {
        $chart = new Highchart();

        $chart->tooltip->borderRadius(5);
        $this->assertRegExp('/tooltip: \{"borderRadius":5\}/', $chart->render());

        $chart->tooltip->borderRadius("5");
        $this->assertRegExp('/tooltip: \{"borderRadius":"5"\}/', $chart->render());
    }

    /**
     * borderWidth option (integer - width in px)
     */
    public function testborderWidth()
    {
        $chart = new Highchart();

        $chart->tooltip->borderWidth(5);
        $this->assertRegExp('/tooltip: \{"borderWidth":5\}/', $chart->render());

        $chart->tooltip->borderWidth("5");
        $this->assertRegExp('/tooltip: \{"borderWidth":"5"\}/', $chart->render());
    }

    /**
     * enabled option (true/false)
     */
    public function testEnabled()
    {
        $chart = new Highchart();

        $chart->tooltip->enabled("true");
        $this->assertRegExp('/tooltip: \{"enabled":"true"\}/', $chart->render());

        $chart->tooltip->enabled("false");
        $this->assertRegExp('/tooltip: \{"enabled":"false"\}/', $chart->render());
    }

    /**
     * Formatter option (Zend Json Expr)
     */
    public function testFormatter()
    {
        $chart = new Highchart();

        $func = new Expr('function () { return 1; }');

        $chart->tooltip->formatter($func);
        $this->assertRegExp('/tooltip: \{"formatter":function\s?\(\)\s?\{ return 1; \}\}/', $chart->render());
    }

    /**
     * shadow option (true/false)
     */
    public function testShadow()
    {
        $chart = new Highchart();

        $chart->tooltip->shadow("true");
        $this->assertRegExp('/tooltip: \{"shadow":"true"\}/', $chart->render());

        $chart->tooltip->shadow("false");
        $this->assertRegExp('/tooltip: \{"shadow":"false"\}/', $chart->render());
    }
}
