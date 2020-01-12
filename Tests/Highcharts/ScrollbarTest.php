<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;
use PHPUnit\Framework\TestCase;

/**
 * This class hold Unit tests for the series option
 */
class ScrollbarTest extends TestCase
{
    /**
     * @var array
     */
    private $scrollbar;

    /*
     * @var array
     */
    private $usedOptions = array();

    /**
     * Initialises the data
     */
    public function setUp(): void
    {
        $this->scrollbar = array(
            'enabled' => true,
            'barBackgroundColor' => 'gray',
            'barBorderRadius' => 7,
            'barBorderWidth' => 0,
            'buttonBackgroundColor' => 'gray',
            'buttonBorderWidth' => 0,
            'buttonArrowColor' => 'yellow',
            'buttonBorderRadius' => 7,
            'rifleColor' => 'yellow',
            'trackBackgroundColor' => 'white',
            'trackBorderWidth' => 1,
            'trackBorderColor' => 'silver',
            'trackBorderRadius' => 7
        );
    }

    /**
     * Scrollbar config output
     */
    public function testConfig()
    {
        $chart = new Highchart();
        foreach ($this->scrollbar as $key => $value) {
            // Config randomization
            if(mt_rand(0, 5) === 0) continue;

            $this->usedOptions[$key] = $value;
            $chart->scrollbar->$key($value);
        }

        preg_match('|scrollbar: (\{[^\}]+\})+|', $chart->render(), $matches);
        $options = json_decode($matches[1], true);

        $this->assertEquals(count($this->usedOptions), count(array_intersect($this->usedOptions, $options)));
    }
}
