<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;
use PHPUnit\Framework\TestCase;

/**
 * This class hold Unit tests for the exporting option
 */
class ExportingTest extends TestCase
{
    /**
     * buttons option
     */
    public function testButtons()
    {
        $chart = new Highchart();

        // align option (string - left/center/right)
        $chart->exporting->buttons(array('exportButton' => array('align' => 'center')));
        $this->assertRegExp('/exporting: \{"buttons":\{"exportButton":\{"align":"center"\}\}\}/', $chart->render());
        $chart->exporting->buttons(array('printButton' => array('align' => 'center')));
        $this->assertRegExp('/exporting: \{"buttons":\{"printButton":\{"align":"center"\}\}\}/', $chart->render());

        // backgroundColor option
        $chart->exporting->buttons(array('exportButton' => array('backgroundColor' => 'blue')));
        $this->assertRegExp('/exporting: \{"buttons":\{"exportButton":\{"backgroundColor":"blue"\}\}\}/', $chart->render());
        $chart->exporting->buttons(array('printButton' => array('backgroundColor' => 'blue')));
        $this->assertRegExp('/exporting: \{"buttons":\{"printButton":\{"backgroundColor":"blue"\}\}\}/', $chart->render());

        // borderColor option
        // borderRadius option
        // borderWidth option
        // enabled option
        // height option
        // hoverBorderColor option
        // hoverSymbolFill option
        // hoverSymbolStroke option
        // menuItems option
        // onclick option
        // symbol option
        // symbolFill option
        // symbolSize option
        // symbolStroke option (color)
        // symbolStrokeWidth option (integer - stroke width in px)
        // symbolX option (float)
        // symbolY option (float)
        // verticalAlign option (string - top/middle/bottom)
        // width option (integer - width in px)
        // x option (integer - horizontal offset in px)
        // y option (integer - vertical offset in px)
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * chartOptions option
     */
    public function testChartOptions()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * enabled option (true/false)
     */
    public function testEnabled()
    {
        $chart = new Highchart();

        $chart->exporting->enabled(true);
        $this->assertRegExp('/exporting: \{"enabled":true\}/', $chart->render());

        $chart->exporting->enabled(false);
        $this->assertRegExp('/exporting: \{"enabled":false\}/', $chart->render());
    }

    /**
     * filename option (string)
     */
    public function testFilename()
    {
        $chart = new Highchart();
        $chart->exporting->filename("graph");

        $this->assertRegExp('/exporting: \{"filename":"graph"\}/', $chart->render());
    }

    /**
     * type option (string - image/png, image/jpeg, application/pdf or image/svg+xml)
     */
    public function testType()
    {
        $chart = new Highchart();

        // We need to use a Json Expr or else the slashes are escaped
        $chart->exporting->type(new Expr('"image/png"'));
        $this->assertRegExp('/exporting: \{"type":"image\/png"\}/', $chart->render());

        $chart->exporting->type(new Expr('"image/jpeg"'));
        $this->assertRegExp('/exporting: \{"type":"image\/jpeg"\}/', $chart->render());

        $chart->exporting->type(new Expr('"application/pdf"'));
        $this->assertRegExp('/exporting: \{"type":"application\/pdf"\}/', $chart->render());

        $chart->exporting->type(new Expr('"image/svg+xml"'));
        $this->assertRegExp('/exporting: \{"type":"image\/svg\+xml"\}/', $chart->render());
    }

    /**
     * url option (string)
     */
    public function testUrl()
    {
        $chart = new Highchart();

        // We need to use a Json Expr or else the slashes are escaped
        $chart->exporting->url(new Expr('"http://www.google.com"'));

        $this->assertRegExp('/exporting: \{"url":"http:\/\/www.google.com"\}/', $chart->render());
    }

    /**
     * width option (integer - width in px)
     */
    public function testWidth()
    {
        $chart = new Highchart();
        $chart->exporting->width(300);

        $this->assertRegExp('/exporting: \{"width":300\}/', $chart->render());
    }
}
