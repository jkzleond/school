<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-22
 * Time: 上午1:31
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['module']['achievement'] = array
(
    'module' => 'Achievement',
    'name' => '成绩',
    'description' => '成绩查询模块',
    'author' => 'jkzleond',
    'version' => '1.0',
    'uri' =>'achievement',
    'has_admin' => true,
    'has_frontend' => true,
);

return $config['module']['achievement'];