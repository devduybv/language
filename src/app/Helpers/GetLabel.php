<?php

if (!function_exists('getLabel')) {
    function getLabel($labels, $key)
    {
        $found = array_filter($labels, function ($v, $k) use ($key) {
            return $v['key'] == $key;
        }, ARRAY_FILTER_USE_BOTH);
        $label = array_values($found);
        if (!empty($label)) {
            return $label[0]['value'];
        }
        return '';

    }
}
