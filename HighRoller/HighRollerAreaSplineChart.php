<?php
namespace Ob\HighchartsBundle\HighRoller;
/**
 * Author: jmac
 * Date: 9/14/11
 * Time: 5:46 PM
 * Desc: HighRoller Area Chart SubClass
 *
 * Licensed to Gravity.com under one or more contributor license agreements.
 * See the NOTICE file distributed with this work for additional information
 * regarding copyright ownership.  Gravity.com licenses this file to you use
 * under the Apache License, Version 2.0 (the License); you may not this
 * file except in compliance with the License.  You may obtain a copy of the
 * License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an AS IS BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

class HighRollerAreaSplineChart extends HighRoller {

  function __construct(){
    parent::__construct();
    $this->chart->type = 'areaspline';
//    $this->xAxis = new HighRollerXAxis();
//    $this->yAxis = new HighRollerYAxis();
//    $this->plotOptions->areaspline = new HighRollerPlotOptionsByChartType($this->chart->type);
  }

}
?>