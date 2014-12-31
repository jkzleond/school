<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 上午1:44
 */

$route['default_controller'] = 'achieve';
$route['(:num)/(:any)/(:num)'] = 'achieve/get_list/$1/$2/$3';
$route['subject'] = 'achieve/get_subject';
$route['exam'] = 'achieve/get_exam';
$route['(.*)'] = 'achieve/index/$1';