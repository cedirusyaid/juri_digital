<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_score_label')) {
    function get_score_label($score) {
        $labels = [
            '100' => 'Sangat Baik (5★)',
            '80' => 'Baik (4★)',
            '60' => 'Cukup (3★)', 
            '40' => 'Kurang (2★)',
            '20' => 'Sangat Kurang (1★)'
        ];
        return isset($labels[$score]) ? $labels[$score] : 'Belum dinilai';
    }
}