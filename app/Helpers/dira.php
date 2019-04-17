<?php

if(!function_exists('format_price_id')){
    function format_price_id($value, $currency = 'Rp'){
        return $currency.' '.number_format($value, 0, ',', '.');
    }
}

if(!function_exists('image_url')){
    function image_url($file, $default = ''){
        if (!empty($file)) {
            return Storage::disk('public')->url($file);
        }

        return $default;
    }
}

if(!function_exists('image_name')){
    function image_name($path, $extension){
        $fileName = str_random(20);
        while (Storage::disk('public')->exists($path.$fileName.$extension)){
            $fileName = str_random(20);
        }

        return $path.$fileName.'.'.$extension;
    }
}
