# Changelog


## [Unreleased]

TBD

### [1.5.0] - 2016-07-26

* Improve Travis configuration, test on PHP 7
* Add support for zend-json ~3.0
* Fix Symfony 3.1 deprecation notice for YAML scalars starting with `%`


### [1.4.0] - 2016-01-10

* Update version constraint to support Symfony 3


### [1.3.0] - 2015-10-10

* Update to PSR-4 autoloading
* Add support for colorAxis
* Add support for noData


### [1.2.0] - 2014-08-04

* Refactor deprecated Twig_Function_Method to Twig_SimpleFunction
* Add support for lang
* Test on more PHP versions and also HHVM
* Add support for drilldown
* Add support for setOptions
* Drop support for deprecated versions of Symfony
* Add support for scrollbar


### [1.1.0] - 2014-06-26

This release fixes a security issue. You are encouraged to update to it as soon
as possible. See http://framework.zend.com/security/advisory/ZF2014-01

* Add support for pane option
* Add support for Highstock
* Extract a common interface from Highchart and Highstock
* Add support for rangeSelector
* Add a branch alias to composer.json
* Update to Highcharts v4
* Update Zend\Json for a security issue
* Remove bundled assets in favor of Highcharts' CDN (http://code.highcharts.com/)


### [1.0.1] - 2013-11-08

* Make the JS wrapper optional
* Add support for multiple x-axis
* Update to Highcharts v3.0.6
* Add license to composer.json
* Add docblocks for IDE type hinting
* Configure Travis to test on Symfony 2.1, 2.2 and 2.3


### 1.0.0 - 2013-08-06

* Initial release


[Unreleased]: https://github.com/marcaube/ObHighchartsBundle/compare/1.5...HEAD
[1.5.0]: https://github.com/marcaube/ObHighchartsBundle/compare/1.4...1.5
[1.4.0]: https://github.com/marcaube/ObHighchartsBundle/compare/1.3...1.4
[1.3.0]: https://github.com/marcaube/ObHighchartsBundle/compare/1.2...1.3
[1.2.0]: https://github.com/marcaube/ObHighchartsBundle/compare/1.1...1.2
[1.1.0]: https://github.com/marcaube/ObHighchartsBundle/compare/1.0.1...1.1
[1.0.1]: https://github.com/marcaube/ObHighchartsBundle/compare/1.0...1.0.1
