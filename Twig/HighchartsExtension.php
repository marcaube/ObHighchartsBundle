<?php
namespace Ob\HighchartsBundle\Twig;

use Ob\HighchartsBundle\Highcharts\ChartInterface;

class HighchartsExtension extends \Twig\Extension\AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new \Twig\TwigFunction('chart', array($this, 'chart'), array('is_safe' => array('html'))),
        );
    }

    public function chart(ChartInterface $chart, $engine = 'jquery')
    {
        return $chart->render($engine);
    }

    public function getName()
    {
        return 'highcharts_extension';
    }
}
