<?php

namespace Ob\HighchartsBundle\Tests;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

/**
 * This class hold Unit tests for the exporting option
 */
class ExportingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * buttons option (true/false)
     */
    // TODO: write test

    
    /**
     * chartOptions option (true/false)
     */
    // TODO: write test


    /**
     * enabled option (true/false)
     */
    public function testEnabled()
    {
        $chart = new Highchart();

        $chart->exporting->enabled(true);
        $this->assertRegExp('/exporting: \{"enabled":true\},/', $chart->render());

        $chart->exporting->enabled(false);
        $this->assertRegExp('/exporting: \{"enabled":false\},/', $chart->render());
    }


    /**
     * filename option (string)
     */
    public function testFilename()
    {
        $chart = new Highchart();
        $chart->exporting->filename("graph");

        $this->assertRegExp('/exporting: \{"filename":"graph"\},/', $chart->render());
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

        $this->assertRegExp('/exporting: \{"width":300\},/', $chart->render());
    }
}