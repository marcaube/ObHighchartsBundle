<?php

namespace Ob\HighchartsBundle\Tests\Highstock;

use Ob\HighchartsBundle\Highcharts\Highstock;
use PHPUnit\Framework\TestCase;

class ChartTest extends TestCase
{
    protected $chart;

    protected function setUp(): void
    {
        $this->chart = new Highstock();
    }

    public function testAlignTicks()
    {
        $this->chart->chart->alignTicks(true);
        $this->assertTrue($this->chart->chart->alignTicks);
        $this->assertRegExp('/"alignTicks":true/', $this->chart->render());

        $this->chart->chart->alignTicks(false);
        $this->assertFalse($this->chart->chart->alignTicks);
        $this->assertRegExp('/"alignTicks":false/', $this->chart->render());
    }

    public function testAnimation()
    {
        $this->chart->chart->animation(true);
        $this->assertTrue($this->chart->chart->animation);
        $this->assertRegExp('/"animation":true/', $this->chart->render());

        $this->chart->chart->animation(false);
        $this->assertFalse($this->chart->chart->animation);
        $this->assertRegExp('/"animation":false/', $this->chart->render());
    }

    public function testBackgroundColor()
    {
        $color = '#ffffff';
        $this->chart->chart->backgroundColor($color);
        $this->assertEquals($color, $this->chart->chart->backgroundColor);
        $this->assertRegExp('/"backgroundColor":"#ffffff"/', $this->chart->render());
    }

    public function testBorderColor()
    {
        $color = '#4572a7';
        $this->chart->chart->borderColor($color);
        $this->assertEquals($color, $this->chart->chart->borderColor);
        $this->assertRegExp('/"borderColor":"#4572a7"/', $this->chart->render());
    }

    public function testBorderRadius()
    {
        $radius = 5;
        $this->chart->chart->borderRadius($radius);
        $this->assertEquals($radius, $this->chart->chart->borderRadius);
        $this->assertRegExp('/"borderRadius":5/', $this->chart->render());
    }

    public function testBorderWidth()
    {
        $width = 0;
        $this->chart->chart->borderWidth($width);
        $this->assertEquals($width, $this->chart->chart->borderWidth);
        $this->assertRegExp('/"borderWidth":0/', $this->chart->render());
    }

    public function testClassName()
    {
        $class = 'extraClass';
        $this->chart->chart->className($class);
        $this->assertEquals($class, $this->chart->chart->className);
        $this->assertRegExp('/"className":"extraClass"/', $this->chart->render());
    }

    public function testEvents()
    {
        $this->markTestIncomplete();
    }

    public function testHeight()
    {
        $height = '300px';
        $this->chart->chart->height($height);
        $this->assertEquals($height, $this->chart->chart->height);
        $this->assertRegExp('/"height":"300px"/', $this->chart->render());
    }

    public function testIgnoreHiddenSeries()
    {
        $this->chart->chart->ignoreHiddenSeries(true);
        $this->assertTrue($this->chart->chart->ignoreHiddenSeries);
        $this->assertRegExp('/"ignoreHiddenSeries":true/', $this->chart->render());

        $this->chart->chart->ignoreHiddenSeries(false);
        $this->assertFalse($this->chart->chart->ignoreHiddenSeries);
        $this->assertRegExp('/"ignoreHiddenSeries":false/', $this->chart->render());
    }

    public function testMargin()
    {
        $this->markTestIncomplete();
    }

    public function testMarginBottom()
    {
        $margin = '150px';
        $this->chart->chart->marginBottom($margin);
        $this->assertEquals($margin, $this->chart->chart->marginBottom);
        $this->assertRegExp('/"marginBottom":"150px"/', $this->chart->render());
    }

    public function testMarginLeft()
    {
        $margin = '150px';
        $this->chart->chart->marginLeft($margin);
        $this->assertEquals($margin, $this->chart->chart->marginLeft);
        $this->assertRegExp('/"marginLeft":"150px"/', $this->chart->render());
    }

    public function testMarginRight()
    {
        $margin = '150px';
        $this->chart->chart->marginRight($margin);
        $this->assertEquals($margin, $this->chart->chart->marginRight);
        $this->assertRegExp('/"marginRight":"150px"/', $this->chart->render());
    }

    public function testMarginTop()
    {
        $margin = '150px';
        $this->chart->chart->marginTop($margin);
        $this->assertEquals($margin, $this->chart->chart->marginTop);
        $this->assertRegExp('/"marginTop":"150px"/', $this->chart->render());
    }

    public function testPanning()
    {
        $this->chart->chart->panning(true);
        $this->assertTrue($this->chart->chart->panning);
        $this->assertRegExp('/"panning":true/', $this->chart->render());

        $this->chart->chart->panning(false);
        $this->assertFalse($this->chart->chart->panning);
        $this->assertRegExp('/"panning":false/', $this->chart->render());
    }

    public function testPlotBackgroundColor()
    {
        $this->markTestIncomplete();
    }

    public function testPlotBackgroundImage()
    {
        $this->markTestIncomplete();
    }

    public function testPlotBorderColor()
    {
        $this->markTestIncomplete();
    }

    public function testPlotBorderWidth()
    {
        $this->markTestIncomplete();
    }

    public function testPlotShadow()
    {
        $this->markTestIncomplete();
    }

    public function testReflow()
    {
        $this->markTestIncomplete();
    }

    public function testRenderTo()
    {
        $this->markTestIncomplete();
    }

    public function testSelectionMarkerFIll()
    {
        $this->markTestIncomplete();
    }

    public function testShadow()
    {
        $this->markTestIncomplete();
    }

    public function testSpacing()
    {
        $this->markTestIncomplete();
    }

    public function testSpacingBottom()
    {
        $spacing = 15;
        $this->chart->chart->spacingBottom($spacing);
        $this->assertEquals($spacing, $this->chart->chart->spacingBottom);
        $this->assertRegExp('/"spacingBottom":15/', $this->chart->render());
    }

    public function testSpacingLeft()
    {
        $spacing = 10;
        $this->chart->chart->spacingLeft($spacing);
        $this->assertEquals($spacing, $this->chart->chart->spacingLeft);
        $this->assertRegExp('/"spacingLeft":10/', $this->chart->render());
    }

    public function testSpacingRight()
    {
        $spacing = 10;
        $this->chart->chart->spacingRight($spacing);
        $this->assertEquals($spacing, $this->chart->chart->spacingRight);
        $this->assertRegExp('/"spacingRight":10/', $this->chart->render());
    }

    public function testSpacingTop()
    {
        $spacing = 10;
        $this->chart->chart->spacingTop($spacing);
        $this->assertEquals($spacing, $this->chart->chart->spacingTop);
        $this->assertRegExp('/"spacingTop":10/', $this->chart->render());
    }

    public function testStyle()
    {
        $this->markTestIncomplete();
    }

    public function testType()
    {
        $this->markTestIncomplete();
    }

    public function testWidth()
    {
        $width = '800px';
        $this->chart->chart->width($width);
        $this->assertEquals($width, $this->chart->chart->width);
        $this->assertRegExp('/"width":"800px"/', $this->chart->render());
    }

    public function testZoomType()
    {
        $this->markTestIncomplete();
    }
}
