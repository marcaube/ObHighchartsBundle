<?php
namespace Ob\HighchartsBundle\HighRoller;
/**
 * Author: jmac
 * Date: 9/21/11
 * Time: 1:11 PM
 * Desc: HighRoller Series Data Class
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
 
class HighRollerSeriesData {

  public $name;
  public $data = array();
  
  public function addName($name){
    $this->name = $name;
    return $this;
  }

  public function addType($type){
    $this->type = $type;
    return $this;
  }

  public function addData($data){
    $this->data = $data;
    return $this;
  }

  public function addColor($color){
    $this->color = $color;
    return $this;
  }

}
?>