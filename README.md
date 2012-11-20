# ObHighchartsBundle

`ObHighchartsBundle` aims to ease the use of highcharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions and PHP objects to do the heavy lifting. The bundle uses the excellent JS library [Highcharts](http://www.highcharts.com).

[![Build Status](https://secure.travis-ci.org/marcaube/ObHighchartsBundle.png?branch=master)](http://travis-ci.org/marcaube/ObHighchartsBundle)

## Content
* The Why
* How to get started / Installation
* Usage
    * Make a basic line-chart
    * use js anonymous functions
* Cookbook
    * Pie chart with legend (like [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend))

## Why ?

Because I grew tired of defining data series in php and then doing the exact same thing with a different syntax in 
javascript to display the graph. I needed something to do the heavy lifting for me and take care of the boilerplate 
code.

## How to get started

### Installation

1. Add `"ob/highcharts-bundle": "dev-master"` to your `composer.json` file

   This bundle depends on Zend's Json module, and because composer does not load repositories recursively, you may want
   to add this to your composer to load only the Json module (200k) instead of the complete Zend Framework (95M). 
   See [why can't composer load repositories recursively](http://getcomposer.org/doc/faqs/why-can%27t-composer-load-repositories-recursively.md)
   
   ``` json
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.zendframework.com/"
        }
    ]
   ```

   Your Symfony2 composer file would look like
   ``` json
   {
       "name": "symfony/framework-standard-edition",
       "description": "The \"Symfony Standard Edition\" distribution",
       "autoload": {
           "psr-0": { "": "src/" }
       },
       "require": {
           "php": ">=5.3.3",
           "symfony/symfony": "2.1.*",
           "doctrine/orm": ">=2.2.3,<2.4-dev",
           "doctrine/doctrine-bundle": "1.0.*",
           "twig/extensions": "1.0.*",
           "symfony/assetic-bundle": "2.1.*",
           "symfony/swiftmailer-bundle": "2.1.*",
           "symfony/monolog-bundle": "2.1.*",
           "sensio/distribution-bundle": "2.1.*",
           "sensio/framework-extra-bundle": "2.1.*",
           "sensio/generator-bundle": "2.1.*",
           "jms/security-extra-bundle": "1.2.*",
           "jms/di-extra-bundle": "1.1.*",
           "ob/highcharts-bundle": "dev-master"
       },
       "scripts": {
           "post-install-cmd": [
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile"
           ],
           "post-update-cmd": [
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
               "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile"
           ]
       },
       "minimum-stability": "dev",
       "extra": {
           "symfony-app-dir": "app",
           "symfony-web-dir": "web"
       },
       "repositories":[
           {
               "type":"composer",
               "url":"http://packages.zendframework.com/"
           }
       ]
   }
   ```

2. Run `php composer.phar install`

3. Register the bundle in your `app/AppKernel.php`:

   ``` php
       <?php
       ...
       public function registerBundles()
       {
           $bundles = array(
               ...
               new Ob\HighchartsBundle\ObHighchartsBundle(),
               ...
           );
       ...
   ```

## Usage

### Basic Line Chart

In your controller ...

``` php
    <?php
    use Ob\HighchartsBundle\Highcharts\Highchart;

    // ...
    public function chartAction()
    {
        // Chart
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        return $this->render('::your_template.html.twig', array(
            'chart' => $ob
        ));
    }
```

In your template ...

``` html
    <script src="{{ asset('bundles/obhighcharts/js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('bundles/obhighcharts/js/highcharts/modules/exporting.js') }}"></script>
    <script type="text/javascript">
        {{ chart(chart) }}
    </script>

    <div id="linechart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
```

Voilà !

### Use a Javascript anonymous function
There are several use case where you need to define a js function, let's see how to use one for a tooltip formatter

``` php
// ...
$func = new Zend\Json\Expr("function() {
    return 'The value for <b>'+ this.x +
    '</b> is <b>'+ this.y +'</b>';
}");

$ob = new Highchart();
$ob->tooltip->formatter($func);
// ...
```

## Cookbook

### Pie chart with legend
This is a simple recipe to re-create the pie-chart demo with legend at [highcharts.com/demo/pie-legend](http://www.highcharts.com/demo/pie-legend)

```php
$ob = new Highchart();
$ob->chart->renderTo('linechart');
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
```
