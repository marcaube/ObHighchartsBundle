<?php

namespace Ob\HighchartsBundle\Highcharts;

use stdClass;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/#chart
 */
class ChartOption
{
    private $option_name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->option_name = $name;
        $this->{$name} = new stdClass();
    }

    /**
     * @param string $name
     * @param array  $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $option_name = $this->option_name;
        $this->{$option_name}->{$name} = $value[0];

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $option_name = $this->option_name;

        return $this->{$option_name}->{$name};
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        $option_name = $this->option_name;
        
        return isset($this->{$option_name}->{$name});
    }
}
