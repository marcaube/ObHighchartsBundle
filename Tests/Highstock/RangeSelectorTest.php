<?php

namespace Ob\HighchartsBundle\Tests\Highstock;

use Ob\HighchartsBundle\Highcharts\Highstock;

class RangeSelectorTest extends \PHPUnit_Framework_TestCase
{
    protected $chart;
    protected $range;

    protected function setUp()
    {
        $this->chart = new Highstock();
        $this->range = $this->chart->rangeSelector;
    }

    public function testButtonSpacing()
    {
        $spacing = 0;
        $this->range->buttonSpacing($spacing);
        $this->assertEquals($spacing, $this->range->buttonSpacing);
        $this->assertRegExp('/"buttonSpacing":0/', $this->chart->render());
    }

    public function testButtonTheme()
    {
        $this->markTestIncomplete();
    }

    public function testButtons()
    {
        $buttons = array(array(
            'type' => 'month',
                'count' => 3,
                'text' => '3m'
        ));

        $this->range->buttons($buttons);
        $this->assertEquals($buttons, $this->range->buttons);
        $this->assertRegExp('/"buttons":\[{"type":"month","count":3,"text":"3m"}\]/', $this->chart->render());
    }

    public function testEnabled()
    {
        $this->range->enabled(true);
        $this->assertTrue($this->range->enabled);
        $this->assertRegExp('/"enabled":true/', $this->chart->render());

        $this->range->enabled(false);
        $this->assertFalse($this->range->enabled);
        $this->assertRegExp('/"enabled":false/', $this->chart->render());
    }

    public function testInputBoxBorderColor()
    {
        $color = 'silver';
        $this->range->inputBoxBorderColor($color);
        $this->assertEquals($color, $this->range->inputBoxBorderColor);
        $this->assertRegExp('/"inputBoxBorderColor":"silver"/', $this->chart->render());
    }

    public function testInputBoxHeight()
    {
        $height = 16;
        $this->range->inputBoxHeight($height);
        $this->assertEquals($height, $this->range->inputBoxHeight);
        $this->assertRegExp('/"inputBoxHeight":16/', $this->chart->render());
    }

    public function testInputBoxWidth()
    {
        $width = 16;
        $this->range->inputBoxWidth($width);
        $this->assertEquals($width, $this->range->inputBoxWidth);
        $this->assertRegExp('/"inputBoxWidth":16/', $this->chart->render());
    }

    public function testInputDateFormat()
    {
        $format = '%b %e, %Y';
        $this->range->inputDateFormat($format);
        $this->assertEquals($format, $this->range->inputDateFormat);
        $this->assertRegExp('/"inputDateFormat":"%b %e, %Y"/', $this->chart->render());
    }

    public function testInputDateParser()
    {
        $this->markTestIncomplete();
    }

    public function testInputEditDateFormat()
    {
        $format = '%b %e, %Y';
        $this->range->inputEditDateFormat($format);
        $this->assertEquals($format, $this->range->inputEditDateFormat);
        $this->assertRegExp('/"inputEditDateFormat":"%b %e, %Y"/', $this->chart->render());
    }

    public function testinputEnabled()
    {
        $this->range->inputEnabled(true);
        $this->assertTrue($this->range->inputEnabled);
        $this->assertRegExp('/"inputEnabled":true/', $this->chart->render());

        $this->range->inputEnabled(false);
        $this->assertFalse($this->range->inputEnabled);
        $this->assertRegExp('/"inputEnabled":false/', $this->chart->render());
    }

    public function testInputPosition()
    {
        $position= array(
            'align' => 'right'
        );
        $this->range->position($position);
        $this->assertEquals($position, $this->range->position);
        $this->assertRegExp('/"position":{"align":"right"}/', $this->chart->render());
    }

    public function testInputStyle()
    {
        $this->markTestIncomplete();
    }

    public function testLabelStyle()
    {
        $this->markTestIncomplete();
    }

    public function testSelected()
    {
        $index = 3;
        $this->range->selected($index);
        $this->assertEquals($index, $this->range->selected);
        $this->assertRegExp('/"selected":3/', $this->chart->render());
    }
}
