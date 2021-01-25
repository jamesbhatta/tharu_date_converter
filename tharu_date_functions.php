<?php

/**
 * Get the tharu date
 *
 * @param  int $yy
 * @param  int $mm
 * @param  int $dd
 * @return array
 * array keys (year, month_name, month, day, date)
 */
function get_tharu_date($yy, $mm, $dd)
{
    $cal = new Nepali_Calendar();
    $tharu_date = $cal->eng_to_nep($yy, $mm, $dd);
    $tharu_date = dtn_convert_to_tharu($tharu_date);

    return $tharu_date;
}


/**
 * Convert date to Tharu.
 *
 * @since 1.0.0
 *
 * @param  array $date Date to be converted.
 * @return array Converted date.
 */
function dtn_convert_to_tharu($date)
{
	$tharu_year = $date['year'] + 566;
	if ($date['month'] >= 10 && $date['month'] <= 12) {
		$tharu_year++;
	}
	$date['year']       = dtn_get_tharu_number($tharu_year);
	$date['month_name'] = dtn_get_tharu_mahina($date['month']);
	$date['month']      = dtn_get_tharu_number($date['month']);
	$date['day']        = dtn_get_tharu_baar($date['num_day']);
	$date['date']       = dtn_get_tharu_number($date['date']);
	return $date;
}

/**
 * Get nepali number.
 *
 * @since 1.0.0
 *
 * @param int $num Number.
 * @return string Translated number.
 */
function dtn_get_tharu_number($num)
{
	$str = array();
	$numarr = str_split($num);
	if (1 === count($numarr)) {
		array_unshift($numarr, '0');
	}
	$number = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
	$cnt = count($numarr);
	for ($i = 0; $i < $cnt; $i++) {
		$str[$i] = $number[$numarr[$i]];
	}
	return implode('', $str);
}

/**
 * Get nepali month from number.
 *
 * @since 1.0.0
 *
 * @param int $num Number for month.
 * @return string Month text in Nepali.
 */
function dtn_get_tharu_mahina($num)
{
	$bar = array('बैशाख', 'जेठ', 'असार', 'सावन', 'भादौ', 'कुँवार', 'कार्तिक', 'अगहन', 'पुष', 'माघ', 'फागुन', 'चैत');
	$ret = $bar[$num - 1];
	return  $ret;
}

/**
 * Get nepali day from number.
 *
 * @since 1.0.0
 *
 * @param int $num Number for day.
 * @return string Day text in Nepali.
 */
function dtn_get_tharu_baar($num)
{
	$bar = array('अत्वार', 'सोम्मार', 'मंगर', 'बुध', 'बिफे', 'शुक', 'शनिच्चर');
	$ret = $bar[$num - 1];
	return ($ret);
}

/**
 * Trim array.
 *
 * @since 1.0.0
 *
 * @param array $a Date to be trimmed.
 * @return array Trimmed date.
 */
function array_trim_nil($a)
{
	$j = 0;
	$cnt = count($a);
	for ($i = 0; $i < $cnt; $i++) {
		if (strlen($a[$i]) > 2) {
			$b[$j++] = $a[$i];
		}
	}
	return $b;
}
