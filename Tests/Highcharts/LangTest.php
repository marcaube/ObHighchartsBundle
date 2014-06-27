<?php

namespace Ob\HighchartsBundle\Tests\Highcharts;

use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * This class hold Unit tests for the lang option
 */
class LangTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set localized month names
     */
    public function testMonths()
    {
        $chart = new Highchart();
        $chart->lang->months(array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin',  'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'));

        $this->assertRegExp(
            '/lang: \{"months":\["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"\]\}/',
            $chart->render()
        );
    }

    /**
     * Set abbreviated localized month names
     */
    public function testShortMonths()
    {
        $chart = new Highchart();
        $chart->lang->shortMonths(array('Jan', 'Fev', 'Mars', 'Avril', 'Mai', 'Juin',  'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'));

        $this->assertRegExp(
            '/lang: \{"shortMonths":\["Jan","Fev","Mars","Avril","Mai","Juin","Juil","Aout","Sept","Oct","Nov","Dec"\]\}/',
            $chart->render()
        );
    }

    /**
     * Set localized weekday names
     */
    public function testWeekDays()
    {
        $chart = new Highchart();
        $chart->lang->weekdays(array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'));

        $this->assertRegExp(
            '/lang: \{"weekdays":\["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"\]\}/',
            $chart->render()
        );
    }
}
