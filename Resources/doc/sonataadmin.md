# Sonata Admin Integration

Requirements
- SonataAdminBundle (4.x)
- ObHighChartsBundle (https://github.com/mpescador1/ObHighchartsBundle)

templates/Form/chart_block_single.html.twig
```twig
{% extends sonata_block.templates.block_base %}
{% block block %}
    <script src="//code.highcharts.com/4.1.8/highcharts.js"></script>
    <script src="//code.highcharts.com/4.1.8/modules/exporting.js"></script>

    <div class="box box-primary">
        <div class="box-body with-border"  style="height: 410px">
            <div class="col-md-10 chart">
                <script type="text/javascript">{{ chart(chart) }}</script>
                <div id="{{ chart.chart.renderTo }}" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
{% endblock %}
```
config/packages/sonata_admin.yaml
```yaml
sonata_admin:
  dashboard:
    ....
    blocks:
      ....
      - { type: admin.block.service.registrations_chart, position: left }
sonata_block:
  blocks:
    admin.block.service.registrations_chart: #This is the chart block - RegistrationsChartBlockService (below)
            contexts: [ admin ]
```

src/Block/Service/RegistrationsChartService.php
```php
<?php

namespace App\Block\Service;

use App\Service\ChartService;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolver as OptionsResolverInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Twig\Environment;

class RegistrationsChartService extends AbstractBlockService
{
//Services are injected in the abstract class
    //Register class as a service in the container e.g. admin.block.service.registrations_chart
    //$chartbuilder is a service that has our default chart configuration, which in turn uses the ObHighCharts bundle to render the charts.
    /**
     * @var Pool
     */
    private $pool;
    private $chartBuilder;

    public function __construct(Environment $twig, Pool $pool,ChartService $chartBuilder )
    {
        parent::__construct($twig);

        $this->pool = $pool;
        $this->chartBuilder = $chartBuilder;
    }
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, ?Response $response = null): Response
    {

        $end = new \DateTime();
        $start = new \DateTime('7 days ago');

        $chart = $this->chartBuilder->getRegistrationsChart($start, $end);

        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'chart' =>  $chart,
            'block'  => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings(),
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Users Chart';
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'title' => 'Users',
            'summaries' => false,
            'template' => 'Form/chart_block_single.html.twig',
        ));
    }
}
```

src/Service/ChartService.php
```php
<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ob\HighchartsBundle\Highcharts\Highchart;

class ChartService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getRegistrationsChart(\DateTime $start,\DateTime $end){
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Firefox', 45.0),
            array('IE', 26.8),
            array('Chrome', 12.8),
            array('Safari', 8.5),
            array('Opera', 6.2),
            array('Others', 0.7),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $ob;
    }
}
```

config/services.yaml
```yaml
services:
  ....
    admin.block.service.chart:
        class: App\Service\ChartService
        arguments: ['@doctrine.orm.entity_manager']
        public: true
    admin.block.service.registrations_chart:
        class: App\Block\Service\RegistrationsChartService
        arguments:
            - "@twig"
            - "@sonata.admin.pool"
            - "@admin.block.service.chart"
        tags:
            - { name: sonata.block }
        public: true
  ....
```
