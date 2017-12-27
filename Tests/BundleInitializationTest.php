<?php

namespace Ob\HighchartsBundle\Tests;

use Nyholm\BundleTest\BaseBundleTestCase;
use Ob\HighchartsBundle\ObHighchartsBundle;
use Ob\HighchartsBundle\Twig\HighchartsExtension;

class BundleInitializationTest extends BaseBundleTestCase
{
    protected function getBundleClass()
    {
        return ObHighchartsBundle::class;
    }

    public function testInitBundle()
    {
        // Boot the kernel.
        $this->bootKernel();

        // Get the container
        $container = $this->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('ob_highcharts.twig.highcharts_extension'));
        $service = $container->get('ob_highcharts.twig.highcharts_extension');
        $this->assertInstanceOf(HighchartsExtension::class, $service);
    }

}