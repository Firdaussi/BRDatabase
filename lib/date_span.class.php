<?php
/* clase_date_span.inc.php -   Date Span Calculator.
 * Copyright (C) 2004 Victor Hugo Cardenas Varon <victor_hugo_cardenas@yahoo.com>
 *
 * This  library  is  free  software;  you can redistribute it and/or modify it
 * under  the  terms  of the GNU Library General Public License as published by
 * the  Free  Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 *
 * This  library is distributed in the hope that it will be useful, but WITHOUT
 * ANY  WARRANTY;  without  even  the  implied  warranty  of MERCHANTABILITY or
 * FITNESS  FOR  A  PARTICULAR  PURPOSE.  See  the  GNU  Library General Public
 * License for more details.
 *
 * You  should  have  received a copy of the GNU Library General Public License
 * along  with  this  library;  if  not, write to the Free Software Foundation,
 * Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
*/

/**
 * Date Span Calculator.
 * This is a class, that calculates the span between a date and the current system date
 * or between two dates.
 * it is calculated not in mere numbers, but in common phrase.
 * example: 1 year, 6 months and 12 days
 * or
 * 3 months and 1 day
 *
 *
 * 
 * @author Victor Hugo Cardenas Varon <victor_hugo_cardenas@yahoo.com>
 * @version 1.0
 */
 
 /* March 24, 2005
	Addedd fix to Negative days displayed
	Bug found by Greg Sloman
	The bug was in function days_in_month($month,$year)
	returning 0 days in month when the number of the month was zero (0)
*/
class date_span {
	
	/**
	 * Holds the words for the days,
	 * months and years in plural and singular tense.
	 */
	var $day_plural;
	var $day_singular;
	var $month_plural;
	var $month_singular;
	var $year_plural;
	var $year_singular;
	
	/**
	 * Holds the word o phrase for when the span is zero, it means that the initial and final dates are the same.
	 */
	var $today;
	
	/**
	 * Holds the word "and" that connect two phrases.
	 */
	var $and;
	
	/**
	 * Holds the phrase for when the dates cannot be processed, and there is no a span to return.
	 */
	var $incorrect;
	
	/**
	* Constructor of class
	* @param string $language Optional. two letters especifying the language to use inside the class
	*/
	function date_span($language = "en") {
		$this->set_language($language);	
	}//end function date_span
//==============================================================================================
	
	/**
	* Calculates the span between a past date and a second earlier date.
	* if the second date is omitted, the current system date is used
	* 
	* @param string $given_date string containing a past date
	* @param string $given_date_2 Optional. string containing the second date which to calculate span. must be earlier than $given_date
	* @return string $ret_value Returns the text of the span	
	*/
	function  calculate_span($given_date, $given_date_2 = "", $digitval ="N") {
		if (intval(substr($given_date,0, 4)) < 1920)
		{
          $year_correction = 1920 - intval(substr($given_date, 0, 4));
		  $given_date = "1920" . substr($given_date, 4);
		}
		else
		  $year_correction = 0;

		$temp = explode("-",date("Y-m-j",strtotime($given_date)));
		
	//print_r($temp) . "<br />";

		$past_date[0] = intval($temp[0]);	//the year
		$past_date[1] = intval($temp[1]);	//the month
		$past_date[2] = intval($temp[2]);	//the day

		//if a second date is not given, the current system date is used
		if(!strcmp($given_date_2,""))
			$temp = explode("-",date("Y-m-j"));
		else
			$temp = explode("-",date("Y-m-j",strtotime($given_date_2)));

	//print_r($temp) . "<br />";
		
		//now on, the current date is the second given date or the system date
		//however, is expected to be earlier than past date
		$current_date[0] = intval($temp[0]);
		$current_date[1] = intval($temp[1]);
		$current_date[2] = intval($temp[2]);

	//print_r($past_date) . "<br />";
	//print_r($current_date) . "<br />";
			
		//the difference between the years, months, and days of the past dates and the current date
//		echo "diffyears: ".$diff_years = $current_date[0] - $past_date[0];	echo "<br />";
//		echo "diffmonths: ".$diff_months = $current_date[1] - $past_date[1]; echo "<br />";
//		echo "diffdays: ".$diff_days = $current_date[2] - $past_date[2]; echo "<br />";
		$diff_years  = $current_date[0] - $past_date[0] + $year_correction;
		$diff_months = $current_date[1] - $past_date[1];
		$diff_days   = $current_date[2] - $past_date[2];

// return sprintf("%3d:%02d:%02d", $diff_years, $diff_months, $diff_days);

    if ($digitval == "Y")
    {
      return ($diff_years*365) + ($diff_months*12) + $diff_days;
    }

		//initialize return var
		$ret_value = "";
		
		if($diff_years == 0) 
    {
			if($diff_months==0) 
      {
				if($diff_days==0)
        {
					$ret_value = $this->today;
//          $rv = $this->short_val(0,0,0);
        }
				else
        if($diff_days > 0)
        {
					$ret_value = $this->to_string($diff_days, "d");
//          $rv = $this->short_val(0,0,$diff_days);
        }
			}
			else
      if($diff_months > 0) 
      {
				if($diff_days==0)
        {
					$ret_value = $this->to_string($diff_months, "m");
        }
				else
        if($diff_days > 0)
        {
					$ret_value = $this->to_string($diff_months, "m"). " " .
                       $this->and. " " .$this->to_string($diff_days, "d");
        }
				else
        if($diff_days < 0)
        {
					if($diff_months == 1)
          {
						$ret_value = $this->to_string($this->days_in_month($current_date[1]-1, $current_date[0])
                                        - $past_date[2] + $current_date[2], "d");
          }
					else
          {
						$ret_value = $this->to_string($diff_months-1, "m") . " " . $this->and . 
                       " " . $this->to_string($this->days_in_month($current_date[1]-1,
                                              $current_date[0]) - $past_date[2] + $current_date[2],
                                              "d");
          }
				}
			}	
		}
		else
    if($diff_years > 0) 
    {
			if($diff_months==0) 
      {
				if($diff_days==0)
        {
					$ret_value = $this->to_string($diff_years, "y");
        }
				else
        if($diff_days > 0)
        {
					$ret_value = $this->to_string($diff_years, "y") . " " . $this->and . " " .
                       $this->to_string($diff_days, "d");
        }
				else
        if($diff_days < 0) 
        {
					if($diff_years == 1)
          {
						$ret_value = "11 " . $this->month_plural. " " .$this->and. " " .
                         $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0])
                       - $past_date[2] + $current_date[2], "d");
          }
					else
          {
						$ret_value = $this->to_string($diff_years-1, "y") . ", 11 " . $this->month_plural . 
                         " " .$this->and. " " .
                         $this->to_string($this->days_in_month($current_date[1]-1, $current_date[0])
                                        - $past_date[2] + $current_date[2], "d");
          }
				}
			}
			else
      if($diff_months > 0) 
      {
				if($diff_days==0)
        {
					$ret_value = $this->to_string($diff_years, "y"). " " .$this->and. " " .
                       $this->to_string($diff_months, "m");
        }
				else
        if($diff_days > 0)
        {
					$ret_value = $this->to_string($diff_years, "y") . ", " . 
                       $this->to_string($diff_months, "m"). " " .
                       $this->and . " " . $this->to_string($diff_days, "d");
        }
				else
        if($diff_days < 0) 
        {
					if(($diff_months) == 1)
          {
						$ret_value = $this->to_string($diff_years, "y") . " " . $this->and. " " .
                         $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0]) 
                                        - $past_date[2] + $current_date[2], "d");
          }
					else
          {
						$ret_value = $this->to_string($diff_years, "y") . ", " . 
                         $this->to_string($diff_months-1, "m"). " " . $this->and. " " .
                         $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0]) 
                                        - $past_date[2] + $current_date[2], "d");
          }
				}
			}
			else
      if($diff_months < 0) 
      {
				if($diff_years == 1) 
        {
					if($diff_days==0)
          {
						$ret_value = $this->to_string(12 - $past_date[1] + $current_date[1], "m");
          }
					else
          if($diff_days > 0)
          {
						$ret_value = $this->to_string(12 - $past_date[1] + $current_date[1], "m") . " " .
                         $this->and. " " .$this->to_string($diff_days, "d");
          }
					else
          if($diff_days < 0) 
          {
						$ret_value = $this->to_string(11 - $past_date[1] + $current_date[1], "m") . " " .
                         $this->and. " " .
                         $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0])
                                        - $past_date[2] + $current_date[2], "d");
          }
				}
				else 
        {
					if($diff_days==0)
          {
						$ret_value = $this->to_string($diff_years-1, "y"). " " .$this->and. " " .
                         $this->to_string(12 - $past_date[1] + $current_date[1], "m");
          }
					else
          if($diff_days > 0)
          {
						$ret_value = $this->to_string($diff_years-1, "y") . ", " .
                         $this->to_string(12 - $past_date[1] + $current_date[1], "m") . " " .
                         $this->and. " " .$this->to_string($diff_days, "d");
          }
					else
          if($diff_days < 0)
          {
						if(($diff_months) == -11)
            {
							$ret_value = $this->to_string($diff_years-1, "y") . " " . $this->and . " " .
                           $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0])
                                          - $past_date[2] + $current_date[2], "d");
            }
						else
            {
							$ret_value = $this->to_string($diff_years-1, "y") . ", " . 
                           $this->to_string(11 - $past_date[1] + $current_date[1], "m") . " " .
                           $this->and. " " .
                           $this->to_string($this->days_in_month($current_date[1]-1,$current_date[0])
                                          - $past_date[2] + $current_date[2], "d");
            }
          }
				}
			}
		}
	
		if(empty($ret_value))
			$ret_value = $this->incorrect;
				
		return $ret_value;
	}//end function calculate_span
//==============================================================================================
	/**
	* Converts a integer value into a string which concatenate with the unit in plural o singular
	* 
	* @param integer $value numeric integer value
	* @param string $unit string the unit to concatenate. 
			"d" - days
			"m" - months
			"y" - years
	* @return string $ret the $value converted to string and the unit corresponding
	*/
	function to_string($value,$unit) {
		$ret = strval($value)." ";
		switch($unit) {
			case "y":				
				$ret .= ($value==1)?$this->year_singular:$this->year_plural;
				break;
			case "m":
				$ret .= ($value==1)?$this->month_singular:$this->month_plural;
				break;
			case "d":
				$ret .= ($value==1)?$this->day_singular:$this->day_plural;
				break;
		}
		return $ret;
	}//end function to_string
//==============================================================================================
	/**
	* it determine if a given year is leap or not
	* 
	* @param integer $year the year to determine
	* @return boolean TRUE if the year is leap, FALSE otherwise
	*/
	function is_leapyear($year) {
		if ($year%4 == 0) {
			if ($year%100 == 0 && $year%400 <>0)
				return false;
			else
				return true;
		}
		else
			return false;
	}//end function is_leapyear
//==============================================================================================
	/**
	* it determine the number of days in a given month
	* 
	* @param integer $month the month to determine the number of days
	* @param integer $year the year of the used month (is used to know if the year is leap or not)
	* @return integer the number of days of the month
	*/	
	function days_in_month($month,$year) {
		/* March 24, 2005
			Addedd to fix Negative days displayed bug
			Bug found by Greg Sloman
			The bug was in function days_in_month($month,$year)
			returning 0 days in month when the number of the month was zero (0),
			because it was returning the element with index -1 in array $ndays 
		*/
		if($month==0) {
			$month=12;			
		}
		/****** End of Addedd to fix Negative days displayed bug **********/
		$ndays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if ($month==2 && $this->is_leapyear($year)) {
			return 29;
		}
		else return $ndays[$month-1];
	}//end function days_in_month
//==============================================================================================
	/**
	* it set the language to use in the texdt messages of the class
	* 
	* @param string $language Optional. two letters of the language to use.
			the language must be implemented to be used, by now, it supports
			 english (en),
			 german (de),
			 french (fr)
			 spanish (sp), spanish is by default.
	*/	
	function set_language($language = "sp") {
		switch($language) {
			//*** French language added thanks to "Benoit Dausse"
			case "fr":
				$this->day_plural = "jours";
				$this->day_singular = "jour";
				$this->month_plural = "mois";
				$this->month_singular = "mois";
				$this->year_plural = "ans";
				$this->year_singular = "an";
				
				$this->today = "aujourd'hui";
				$this->and = "et";
				$this->incorrect = "La première date donnée n'est pas inférieure à la date actuelle ou la seconde date donnée.";
				break;
			
			//*** german terms added thanks to "Jürgen Fehr" and "jo t"
			case "de":
				$this->day_plural = "Tage";
				$this->day_singular = "Tag";
				$this->month_plural = "Monate";
				$this->month_singular = "Monat";
				$this->year_plural = "Jahre";
				$this->year_singular = "Jahr";

				$this->today = "heute";
				$this->and = "und";
				$this->incorrect = "Das erste angegebene Datum ist nicht kleiner als das aktuelle oder das zweite angegebene Datum.";
				break;
			case "en":
				$this->day_plural = "dys";
				$this->day_singular = "dy";
				$this->month_plural = "mths";
				$this->month_singular = "mth";
				$this->year_plural = "yrs";
				$this->year_singular = "yr";
				
				$this->today = "today";
				$this->and = ",";
				$this->incorrect = "The first given date is not lesser than current or than second given date";
				break;
			
			case "sp":
			default:
				$this->day_plural = "dias";
				$this->day_singular = "dia";
				$this->month_plural = "meses";
				$this->month_singular = "mes";
				$this->year_plural = "años";
				$this->year_singular = "año";
				
				$this->today = "hoy mismo";
				$this->and = "y";
				$this->incorrect = "La primera fecha dada no es menor que la fecha actual o que la segunda fecha dada";
		}//end switch
	}//end function set_language
}//end class date_span

?>