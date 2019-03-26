<?php
define('SUCCESS', 'Request completed successfully.');
define('FAIL', 'Request failed.');
define('INVALID_RRQUEST', 'Request is invalid.');
define('INVALID_PIN', 'Invalid Pin provided.');
define('INSUFFICIENT_FUND', 'Do not have sufficient fund.');

/**
 * Generate a url slug
 */
if (!function_exists('isAdmin')) {
    function isAdmin()
    {
    	if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin'){
    		return true;
    	}
    	return false;
    }
}

if (!function_exists('isReseller')) {
    function isReseller()
    {
        if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'reseller'){
            return true;
        }
        return false;
    }
}

if (!function_exists('provideFundType')) {
    function provideFundType()
    {
        return ['Mobile Recharge', 'Mobile Money', 'Indian Rupee', 'Pakistan Rupee'];
    }
}

if (!function_exists('getBdOperator')) {
    function getBdOperator($number)
    {
        if($number == '17' || $number == '13'){
            return 'Grameenphone';
        }elseif($number == '16' || $number == '18'){
            return 'Robi';
        }elseif($number == '14' || $number == '19'){
            return 'Banglalink';
        }elseif ($number == '15') {
            return 'TeleTalk';
        }else{
            return 'invalid_number';
        }
        
    }
}