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
        // Create a new Kernel
        $kernel = $this->createKernel();

        // Add some configuration
        $kernel->addConfigFile(__DIR__.'/Resources/services.yml');

        // Boot the kernel.
        $this->bootKernel();

        // Get the container
        $container = $this->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('test.ob_highcharts.twig.highcharts_extension'));
        $service = $container->get('test.ob_highcharts.twig.highcharts_extension');
        $this->assertInstanceOf(HighchartsExtension::class, $service);
    }

}