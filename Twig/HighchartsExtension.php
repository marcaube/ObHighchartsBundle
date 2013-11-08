<?php
namespace Ob\HighchartsBundle\Twig;

use Ob\HighchartsBundle\Highcharts\HighChart;

class HighchartsExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'chart' => new \Twig_Function_Method($this, 'chart', array('is_safe' => array('html'))),
        );
    }

    public function chart(HighChart $chart, $engine = 'jquery')
    {
        return $chart->render($engine);
    }

    public function getName()
    {
        return 'highcharts_extension';
    }
}
