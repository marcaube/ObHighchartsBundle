<?php

namespace Ob\HighchartsBundle\Tests\Highstock;

use Ob\HighchartsBundle\Highcharts\Highstock;
use PHPUnit\Framework\TestCase;

class CreditsTest extends TestCase
{
    protected $chart;
    protected $credits;

    protected function setUp(): void
    {
        $this->chart = new Highstock();
        $this->credits = $this->chart->credits;
    }

    public function testEnabled()
    {
        $this->credits->enabled(true);
        $this->assertTrue($this->credits->enabled);
        $this->assertRegExp('/"enabled":true/', $this->chart->render());

        $this->credits->enabled(false);
        $this->assertFalse($this->credits->enabled);
        $this->assertRegExp('/"enabled":false/', $this->chart->render());
    }

    public function testHref()
    {
        $link = "http://www.highcharts.com";
        $this->credits->href($link);
        $this->assertEquals($link, $this->credits->href);
//        $this->assertRegExp('/"href":"http:\/\/www\.highcharts\.com"/', $this->chart->render());
    }

    public function testPosition()
    {
        $position = array(
            'align' => 'right',
            'x' => -10,
            'verticalAlign' => 'bottom',
            'y' => -5
        );

        $this->credits->position($position);
        $this->assertEquals($this->credits->position, $position);
        $this->assertRegExp('/"position":{"align":"right","x":-10,"verticalAlign":"bottom","y":-5}/', $this->chart->render());
    }

    public function testStyle()
    {
        $style = array(
            'cursor' => 'pointer',
            'color' => '#909090',
            'fontSize' => '10px'
        );

        $this->credits->style($style);
        $this->assertEquals($style, $this->credits->style);
        $this->assertRegExp('/"style":{"cursor":"pointer","color":"#909090","fontSize":"10px"}/', $this->chart->render());
    }

    public function testText()
    {
        $text = "Highcharts.com";
        $this->credits->text($text);
        $this->assertEquals($text, $this->credits->text);
        $this->assertRegExp('/"text":"Highcharts.com"/', $this->chart->render());
    }
}
