<?php
namespace TwigExtensions;
use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

class TimeExtension extends Twig_Extension {

    public function getName()
    {
        return 'timely';
    }

    public function getFilters() 
    {
        return array(
            new Twig_SimpleFilter('currency', array($this, 'currency'), array('is_safe' => array('html'))),
            new Twig_SimpleFilter('currency_with_sign', array($this, 'currencyWithSign'), array('is_safe' => array('html')))
        );
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('diffrence_years', array($this, 'diffrence_years')),
            new Twig_SimpleFunction('diffrence_days', array($this, 'diffrence_days')),
            new Twig_SimpleFunction('diffrence_hours', array($this, 'diffrence_hours')),
            new Twig_SimpleFunction('diffrence_minutes', array($this, 'diffrence_minutes')),
            new Twig_SimpleFunction('diffrence_seconds', array($this, 'diffrence_seconds')),
            new Twig_SimpleFunction('diffrence_nicetime', array($this, 'diffrence_nicetime')),
        );
    }

    /*
     |
     | FILTERS
     |
     */
    function currency($value, $iso=null) {
        return Currency::format($value, $iso);
    }
    function currencyWithSign($value, $iso=null) {
        return Currency::formatWithSign($value, $iso);
    }

    /*
     |
     | FUNCTIONS
     |
     */
    function diffrence_years($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->years;
    }

    function diffrence_days($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->days;    
    }

    function diffrence_hours($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->hours;    
    }

    function diffrence_minutes($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->minutes;   
	}

    function diffrence_seconds($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->seconds;
    }

    function diffrence_nicetime($now, $then) {
    	$diff = new Diffrence($now, $then);
    	return $diff->niceTime();
    }   
}
