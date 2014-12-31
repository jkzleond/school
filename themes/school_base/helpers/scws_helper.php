<?php
/**
 * Created by PhpStorm.
 * User: jkzleond
 * Date: 14-12-21
 * Time: 上午4:08
 */

if(!function_exists('get_scws_words'))
{
    /**
     * @param array $options
     * @param bool $network
     * @return mixed
     */
    function get_scws_words(array $options, $network=false)
    {
        if($network === true)
        {
            $url = 'http://www.xunsearch.com/scws/api.php';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        else
        {
            $CI = get_instance();
            $CI->load->library('pscws/PSCWS4', 'utf8', 'pscws');
            $scws = $CI->pscws;
            $scws->set_ignore(false);
            $scws->set_dict();
            $scws->set_rule();
            $scws->send_text($options['data']);
            $result = $scws->get_tops(10, $options['attr']);
            $scws->close();
            return $result;
        }
    }
}
