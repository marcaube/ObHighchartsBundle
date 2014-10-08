# Installation

1. Run `composer require ob/highcharts-bundle`

2. Register the bundle in your `app/AppKernel.php`:

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
