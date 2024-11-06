<?php

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }
}

if (!function_exists('calculateAge')) {
    function calculateAge($birthdate)
    {
        return \Carbon\Carbon::parse($birthdate)->age;
    }
}
