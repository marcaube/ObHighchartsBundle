# Installation

1. Add the following to your `composer.json` file

   ```json
    "require": {
        ...
        "ob/highcharts-bundle": "1.1.*"
        ...
    }
   ```

2. Run `php composer.phar update "ob/highcharts-bundle"`

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
