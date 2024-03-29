<?php 

class Formater
{

	/**
	 * Formatting number 1420 -> 1.4K
	 */
	public static function getFormattedNumber($value, $locale = 'en_US'){
		$style = NumberFormatter::PADDING_POSITION;
		$formatter = new NumberFormatter($locale, $style);

		return $formatter->format($value);
	}

/////////////////////////////////////////////////////////////////////////////

	/**
	 * Time ago formatting
	 */
	public static function timeAgo($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = [
		    'y' => 'year',
		    'm' => 'month',
		    'w' => 'week',
		    'd' => 'day',
		    'h' => 'hour',
		    'i' => 'minute',
		    's' => 'second',
		];
		foreach ($string as $k => &$v) {
		    if ($diff->$k) {
		        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		    } else {
		        unset($string[$k]);
		    }
		}

		if (!$full) $string = array_slice($string, 0, 1);

		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

/////////////////////////////////////////////////////////////////////////////

	/**
	 * format number - 1420 -> 1,420
	 */
	public static function numberFormat($number)
	{
		return number_format($number, 0, ",", ",");
	}

/////////////////////////////////////////////////////////////////////////////

	/**
	 * format date - 2022-07-31 17:29:43 -> 31 Jul 2022
	 */
	public static function dateFormat($date)
	{
		return date("j M Y", strtotime($date));
	}

/////////////////////////////////////////////////////////////////////////////






} // end class



?>