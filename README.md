# ObHighchartsBundle

`ObHighchartsBundle` aims to ease the use of highcharts to display rich graph and charts in your Symfony2 application by
providing Twig extensions and PHP objects to do the heavy lifting. The bundle uses the excellent JS library Highcharts.


## Quicknav
* [Why](#why-)
* [How to get started](#how-to-get-started)
* [Usage](#usage)
* [List of things to do](#todo)

## Why ?

Because I grew tired of defining data series in php and then doing the exact same thing with a different syntax in 
javascript to display the graph. I needed something to do the heavy lifting for me and take care of the boilerplate 
code.

When I found HighRoller, a PHP wrapper for Highcharts, I just had to make a bundle I could reuse accross my projects. This project is
in a ***really*** early stage as I don't know yet how this bundle is going to evolve.

## How to get started

### Installation

Add the following lines to your `deps` file:

    [ObHighchartsBundle]
        git=git://github.com/marcaube/ObHighchartsBundle.git
        target=/bundles/Ob/HighchartsBundle

Now, run the vendors script to download the bundle:

``` bash
    $ php bin/vendors install
```

Then configure the Autoloader

``` php
    <?php
    ...
    'Ob' => __DIR__.'/../vendor/bundles',
```

And finally register the bundle in your `app/AppKernel.php`:

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

## Todo
* Look how other chart-rendering bundles do and evaluate the best way to do things
* Ease the conversion of a Collection of entities to an associative array Highcharts can use. Provide functions to do it.
* Try not to ship with with Highcharts.
