<?php
  /**
   * Utility Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: utility.class.php, v1.00 2016-10-20 18:20:24 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Utility
  {

      /**
       * Utility::__construct()
       * 
       * @return
       */
      function __construct()
      {
      }

      /**
       * Utility::status()
       * 
       * @param mixed $status
       * @param mixed $id
       * @return
       */
      public static function status($status, $id)
      {
          switch ($status) {
              case "y":
                  $display = '<span class="wojo small positive label">' . Lang::$word->ACTIVE . '</span>';
                  break;

              case "n":
			      $icon = '<i class="icon email"></i> ';
                  $display = '<a data-set=\'{"option":[{"action": 1,"page":"resendNotification", "resendNotification": 1,"processItem":1, "id":' . $id . '}], "label":"' . Lang::$word->USR_RESEND . '", "url":"/helper.php", "parent":"#item_' . $id . '", "complete":"highlite","modalclass":"tiny"}\' class="wojo small primary label mAction">' . $icon . Lang::$word->INACTIVE . '</a>';
                  break;

              case "t":
                  $display = '<span class="wojo small secondary label">' . Lang::$word->PENDING . '</span>';
                  break;

              case "b":
                  $display = '<span class="wojo small negative label">' . Lang::$word->BANNED . '</span>';
                  break;
          }

          return $display;
      }

      /**
       * Utility::isPublished()
       * 
       * @param mixed $id
       * @return
       */
      public static function isPublished($id)
      {

          return ($id == 1) ? '<i class="icon positive check"></i>' : '<i class="icon negative ban"></i>';
      }

      /**
       * Utility::userType()
       * 
       * @param mixed $type
       * @return
       */
      public static function userType($type)
      {
          switch ($type) {
              case "owner":
                  $display = '<span class="wojo small positive label">' . $type . '</span>';
                  break;

              case "staff":
                  $display = '<span class="wojo small primary label">' . $type . '</span>';
                  break;

              case "editor":
                  $display = '<span class="wojo small secondary label">' . $type . '</span>';
                  break;

              case "member":
                  $display = '<span class="wojo small black label">' . $type . '</span>';
                  break;
          }

          return $display;
      }

      /**
       * Utility::accountLevelToType()
       * 
       * @param mixed $level
       * @return
       */
      public static function accountLevelToType($level)
      {
          switch ($level) {
              case 9:
                  return '<span class="wojo small bold positive text">' . Lang::$word->OWNER . '</span>';

              case 8:
                  return '<span class="wojo small bold primary text">' . Lang::$word->STAFF . '</span>';

              case 7:
                  return '<span class="wojo small bold secondary text">' . Lang::$word->EDITOR . '</span>';

              case 1:
                  return '<span class="wojo small bold black text">' . Lang::$word->MEMBER . '</span>';
          }
      }
	  
      /**
       * Utility::randName()
       * 
       * @param mixed $char
       * @return
       */
      public static function randName($char = 6)
      {
          $code = '';
          for ($x = 0; $x < $char; $x++) {
              $code .= '-' . substr(strtoupper(sha1(rand(0, 999999999999999))), 2, $char);
          }
          $code = substr($code, 1);
          return $code;
      }

      /**
       * Utility::randNumbers()
       * 
       * @param int $digits
       * @return
       */
      public static function randNumbers($digits = 7)
      {
          $min = pow(10, $digits - 1);
          $max = pow(10, $digits) - 1;
          return mt_rand($min, $max);
      }

      /**
       * Utility::randomString()
       * 
       * @param int $length
       * @return
       */
	  public static function randomString($length = 8) {
		  $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
	      $key = '';
		  for($i=0; $i < $length; $i++) {
			  $key .= $keys[mt_rand(0, count($keys) - 1)];
		  }
		  return $key;
	  }
	  
	  
      /**
       * Utility::getLogo()
       * 
       * @return
       */
      public static function getLogo()
      {
		  $core = App::Core();
          if ($core->logo) {
              $logo = '<img src="' . UPLOADURL . '/' . $core->logo . '" alt="' . $core->company . '" style="border:0;width:150px"/>';
          } else {
              $logo = $core->company;
          }

          return $logo;
      }

      /**
       * Utility::formatMoney()
       * 
       * @param bool $decimal
	   * @param bool $currency
	   * @param bool $decimal
       * @return
       */
      public static function formatMoney($amount, $currency = false, $decimal = true)
      {
		  $code = $currency ? $currency : App::Core()->currency;
		  
          $fmt = new NumberFormatter(App::Core()->locale, NumberFormatter::CURRENCY);
          if ($decimal == false) {
              $fmt->setTextAttribute(NumberFormatter::CURRENCY_CODE, $code);
              $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
          }
          return $fmt->formatCurrency($amount, $code);
      }

      /**
       * Utility::currencySymbol()
       * 
       * @param bool $currency
       * @return
       */
      public static function currencySymbol($currency = '')
      {
          $fmt = new NumberFormatter(App::Core()->locale, NumberFormatter::CURRENCY);
		  $fmt->setTextAttribute(NumberFormatter::CURRENCY_CODE, App::Core()->currency);
		  
		  return $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
      }
	  
      /**
       * Utility::formatNumber()
       * 
       * @param bool $number
       * @return
       */
      public static function formatNumber($number)
      {
		  $fmt = new NumberFormatter(App::Core()->locale, NumberFormatter::DECIMAL);
		  
		  $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
		  $fmt->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
		  $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
		  $fmt->setAttribute(NumberFormatter::DECIMAL_ALWAYS_SHOWN, 2);

          return $fmt->format($number);
      }

      /**
       * Utility::numberParse()
       * 
       * @param bool $number
       * @return
       */
      public static function numberParse($number)
      {
		  $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);

          return $fmt->parse($number);
      }

	  
      /**
       * Utility::loopOptions()
       * 
       * @param mixed $array
       * @return
       */
      public static function loopOptions($array, $key, $value, $selected = false)
      {
          $html = '';
          if (is_array($array)) {
              foreach ($array as $row) {
                  $html .= "<option value=\"" . $row->$key . "\"";
                  $html .= ($row->$key == $selected) ? ' selected="selected"' : '';
                  $html .= ">" . $row->$value . "</option>\n";
              }
              return $html;
          }
          return false;
      }

      /**
       * Utility::loopOptionsMultiple()
       * 
       * @param mixed $array
       * @return
       */
      public static function loopOptionsMultiple($array, $key, $value, $selected = false)
      {
		  $arr = array();
		  if ($selected) {
			  $arr = explode(",", $selected);
			  reset($arr);
		  }
          $html = '';
          if (is_array($array)) {
              foreach ($array as $row) {
                  $html .= "<option value=\"" . $row->$key . "\"";
                  $html .= (in_array($row->$key, $arr)) ? ' selected="selected"' : '';
                  $html .= ">" . $row->$value . "</option>\n";
              }
              return $html;
          }
          return false;
      }

      /**
       * Utility::loopOptionsSimpleMultiple()
       * 
       * @param mixed $array
       * @return
       */
      public static function loopOptionsSimpleMultiple($array, $selected = false)
      {
		  $arr = array();
		  if ($selected) {
			  $arr = explode(",", $selected);
			  reset($arr);
		  }
          $html = '';
          if (is_array($array)) {
              foreach ($array as $row) {
                  $html .= "<option value=\"" . $row . "\"";
                  $html .= (in_array($row, $arr)) ? ' selected="selected"' : '';
                  $html .= ">" . $row . "</option>\n";
              }
              return $html;
          }
          return false;
      }
	  
      /**
       * Utility::loopOptionsSimple()
       * 
       * @param array $array
       * @param bool $selected
       * @return
       */
      public static function loopOptionsSimple($array, $selected = false)
      {
          $html = '';
          if (is_array($array)) {
              foreach ($array as $row) {
                  $html .= "<option value=\"" . $row . "\"";
                  $html .= ($row == $selected) ? ' selected="selected"' : '';
                  $html .= ">" . $row . "</option>\n";
              }
              return $html;
          }
          return false;
      }
	  
      /**
       * Utility::loopOptionsSimpleAlt()
       * 
       * @param array $array
       * @param bool $selected
       * @return
       */
      public static function loopOptionsSimpleAlt($array, $selected = false)
      {
          $html = '';
          if (is_array($array)) {
              foreach ($array as $key => $row) {
                  $html .= "<option value=\"" . $key . "\"";
                  $html .= ($key == $selected) ? ' selected="selected"' : '';
                  $html .= ">" . $row . "</option>\n";
              }
              return $html;
          }
          return false;
      }

      /**
       * Utility::loopSingleLine()
       * 
       * @param array $array
       * @return
       */
      public static function loopSingleLine($array)
      {
          $html = '';
          if (is_array($array)) {
              foreach ($array as $row) {
                  $html .= $row . PHP_EOL;
              }
              return $html;
          }
          return false;
      }
	  
      /**
       * Utility::groupToLoop()
       * 
       * @param array $array
       * @param str $key
       * @return
       */
      public static function groupToLoop($array, $key)
      {
          $result = array();
          if (is_array($array)) {
              foreach ($array as $i => $val) {
                  $itemName = $val->{$key};
                  if (!array_key_exists($itemName, $result)) {
                      $result[$itemName] = array();
                  }
                  $result[$itemName][] = $val;
              }
          }
          return $result;
      }

	  /**
	   * Utility::implodeFields()
	   * 
	   * @param arr $array
	   * @param mixed $sep
	   * @param bool $is_string
	   * @return
	   */
	  public static function implodeFields($array, $sep = ',', $is_string = true)
	  {
          if (is_array($array)) {
			  $result = array();
			  foreach ($array as $row) {
				  if ($row != '') {
					  array_push($result, Validator::sanitize($row));
				  }
			  }
			  return $is_string ? sprintf('"%s"', implode('","', $result)) : implode($sep, $result);
          }
		  return false;
	  }
	  
	  /**
	   * Utility::findInArray()
	   * 
	   * @param array $array
	   * @param mixed $key
	   * @param mixed $value
	   * @return
	   */
	  public static function findInArray($array, $key, $value)
	  {
		  if($array) {
			  $result = array();
			  foreach ($array as $val) {
				  if ((is_object($val) ? ($val->$key == $value) : ($val[$key] == $value))) {
					  $result[] = $val;
				  }
			  }
			  return ($result) ? $result : 0;
		  }
	  }
  
	  /**
	   * Utility::searchForValue()
	   * 
	   * @param mixed $key
	   * @param mixed $value
	   * @param mixed $array
	   * @return
	   */
	  public static function searchForValue($key, $value, $array) {
		  if (is_array($array)) {
			 foreach ($array as $k => $val) {
				 if ($val->$key == $value) {
					 return $val->$key;
				 }
			 }
		  }
		 return false;
	  }

	  /**
	   * Utility::searchForValueName()
	   * 
	   * @param mixed $key
	   * @param mixed $value
	   * @param mixed $return value
	   * @param mixed $array
	   * @param fullkey bool
	   * @return
	   */
	  public static function searchForValueName($k, $v, $r, $array, $fullkey = false) {
		  if (is_array($array)) {
			 foreach ($array as $key => $val) {
				 if ($val->$k == $v) {
					 return $fullkey ? $array[$key] : $val->$r;
				 }
			 }
		  }
		 return false;
	  }

	  /**
	   * Utility::countInArray()
	   * 
	   * @param arr $data
	   * @param str $key
	   * @param str $value
	   * @return
	   */
	  public static function countInArray($array, $key, $value)
	  {
		  $i = 0;
		  if (is_array($array)) {
			 foreach ($array as $k => $v) {
				 if ((is_object($v) ? ($v->$key == $value) : ($v[$key] == $value))) {
					 $i++;
				 }
			 }
		  }
		 return $i;
	  }
  
	  /**
	   * Utility::sortArray()
	   * 
	   * @param mixed $data
	   * @param mixed $field
	   * @sortArray($data, 'age');
	   * @sortArray($data, array('lastname', 'firstname'));
	   * @return
	   */
	  public static function sortArray($data, $field) {
		  $field = (array)$field;
		  uasort($data, function($a, $b) use($field) {
			  $retval = 0;
			  foreach( $field as $fieldname ) {
				  if($retval == 0) $retval = strnatcmp($a[$fieldname], $b[$fieldname]);
			  }
			  return $retval;
		  });
		  return array_values($data);
	  }

      /**
       * Utility::unserialToArray()
       * 
       * @param array $array
       * @return
       */
      public static function unserialToArray($array)
      {
          if ($array) {
              $data = unserialize($array);
              return $data;
          }
          return false;
      }

      /**
       * Utility::jSonToArray()
       * 
       * @param array $string
       * @return
       */
      public static function jSonToArray($string)
      {
          if ($string) {
              $data = json_decode($string);
              return $data;
          }
          return false;
      }

      /**
       * Utility::jSonMergeToArray()
       * 
       * @param array $array
	   * @param string $jstring
       * @return
       */
      public static function jSonMergeToArray($array, $jstring)
      {
		  if ($array) {
			  $allData = array();
			  foreach ($array as $row) {
				  $data = self::jSonToArray($row->{$jstring});
				  if ($data != null) {
					  $allData = array_merge($allData, $data);
				  }
			  }
			  return $allData;
			  
		  }
		  return false;
      }
	  

      /**
       * Utility::parseJsonArray()
       * 
       * @param array $array
	   * @param string $jstring
       * @return
       */
      public static function parseJsonArray($jsonArray, $parent_id = 0)
      {
          $data = array();
          foreach ($jsonArray as $subArray) {
              $returnSubSubArray = array();
              if (isset($subArray['children'])) {
                  $returnSubSubArray = self::parseJsonArray($subArray['children'], $subArray['id']);
              }
              $data[] = array('id' => $subArray['id'], 'parent_id' => $parent_id);
              $data = array_merge($data, $returnSubSubArray);
          }

          return $data;
      }

	  /**
	   * Utility::array_key_exists_wildcard()
	   * 
	   * @param mixed $array
	   * @param mixed $search
	   * @param string $return
	   * @return
	   */
	  public static function array_key_exists_wildcard($array, $search, $return = '')
	  {
		  $search = str_replace('\*', '.*?', preg_quote($search, '/'));
		  $result = preg_grep('/^' . $search . '$/i', array_keys($array));
		  if ($return == 'key-value')
			  return array_intersect_key($array, array_flip($result));
		  return $result;
	  }
	
	  /**
	   * Utility::array_value_exists_wildcard()
	   * 
	   * @param mixed $array
	   * @param mixed $search
	   * @param string $return
	   * @return
	   */
	  public static function array_value_exists_wildcard($array, $search, $return = '')
	  {
		  $search = str_replace('\*', '.*?', preg_quote($search, '/'));
		  $result = preg_grep('/^' . $search . '$/i', array_values($array));
		  if ($return == 'key-value')
			  return array_intersect($array, $result);
		  return $result;
	  }

      /**
       * Utility::encode()
       * 
       * @param array $string
       * @return
       */
      public static function encode($string)
      {
		  return base64_encode(openssl_encrypt($string, "AES-256-CBC", hash('sha256', INSTALL_KEY), 0, substr(hash('sha256', INSTALL_KEY), 0, 16)));
      }

      /**
       * Utility::decode()
       * 
       * @param array $string
       * @return
       */
      public static function decode($string)
      {
		  return openssl_decrypt(base64_decode($string), "AES-256-CBC", hash('sha256', INSTALL_KEY), 0, substr(hash('sha256', INSTALL_KEY), 0, 16));
      }
	  
	  /**
	   * Utility::in_array_any()
	   * 
	   * @param mixed $needles
	   * @param mixed $haystack
	   * @return
	   */
	  public static function in_array_any($needles, $haystack) {
		 return !!array_intersect($needles, $haystack);
	  }

	  /**
	   * Utility::in_array_all()
	   * 
	   * @param mixed $needles
	   * @param mixed $haystack
	   * @return
	   */
	  public static function in_array_all($needles, $haystack) {
		 return !array_diff($needles, $haystack);
	  }
	  
      /**
       * Utility::getInitials()
       * 
       * @param mixed $string
       * @return
       */
      public static function getInitials($string)
      {
		  
		  $result = '';
		  foreach (explode(' ', $string) as $word)
			  $result .= strtoupper(substr($word, 0, 1));
		  return $result;
      }

      /**
       * Utility::getColors()
       * 
       * @return
       */
      public static function getColors()
      {
		  
		  static $colorCounter = -1;
		  $colorArray = array('#f44336', '#673ab7', '#e91e63', '#3f51b5', '#9c27b0', '#2196f3', '#009688', '#03a9f4', '#4caf50', '#00bcd4', '#cddc39', '#8bc34a', '#ffc107', '#795548', '#607d8b');
		  $colorCounter++;
		  
		  return $colorArray[$colorCounter % count($colorArray)];
      }

      /**
       * Utility::getCssClasses()
       * 
       * @return
       */
      public static function getCssClasses()
      {
		  
		  static $colorCounter = -1;
		  $colorArray = array('red', 'pink', 'purple', 'indigo', 'blue', 'cyan', 'teal', 'green', 'lime', 'amber', 'orange', 'brown', 'grey');
		  $colorCounter++;
		  
		  return $colorArray[$colorCounter % count($colorArray)];
      }
	  
      /**
       * Utility::getExplodedValue()
       * 
       * @param mixed $string
	   * @param mixed $value
	   * @param mixed $sep
       * @return
       */
      public static function getExplodedValue($string, $value, $sep = ",")
      {
		  $result = explode($sep, $string);
		  return $result[$value];
      }
	  
      /**
       * Utility::doPercent()
       * 
       * @param string $number
	   * @param string $total
       * @return
       */
      public static function doPercent($number, $total)
      {

          return ($number > 0 and $total > 0) ? round(($number/$total)*100) : 0;
      }

      /**
       * Utility::decimalToHour()
       * 
       * @param string $number
       * @return
       */
      public static function decimalToHour($number)
      {
          $number = number_format($number, 2);
          return str_replace(".", ":", $number);
      }

      /**
       * Utility::decimalToReadableHour()
       * 
       * @param string $number
       * @return
       */
      public static function decimalToReadableHour($number)
      {
          $data = explode(".", $number);
		  $hour = isset($data[0]) ? $data[0] : 0;
		  $min = isset($data[1]) ? $data[1] : 0;
		  
          return [$hour, $min];
      }
	  
      /**
       * Utility::shortName()
       * 
       * @param string $fname
	   * @param string $lname
       * @return
       */
      public static function shortName($fname, $lname)
      {
		  
          return $fname.' '.substr($lname, 0, 1).'.';
      }
	  
      /**
       * Utility::decimalToHumanHour()
       * 
       * @param string $number
       * @return
       */
      public static function decimalToHumanHour($number)
      {
          $data = explode(".", $number);
		  $hour = isset($data[0]) ? $data[0] . ' ' . strtolower(Lang::$word->_HOURS) : 0;
		  $min = (isset($data[1]) and $data[1] > 0) ? $data[1] . ' ' . strtolower(Lang::$word->_MINUTES) : '';
		  
          return $hour . ' ' . $min;
      }
	  
      /**
       * Utility::splitCurrency()
       * 
       * @param mixed $currency
       * @return
       */
      public static function splitCurrency($currency)
      {
		  $data['currency'] = '';
		  $data['country'] = '';
		  
		  if (!empty($currency)) {
			  $iso = explode(",", $currency);
			  $data['currency'] = $iso[0];
			  $data['country'] = $iso[1];
		  } else {
			  $data['currency'] = App::Core()->currency;
			  $data['country'] = isset($_POST['country']) ? Validator::sanitize($_POST['country'], "string") : "";
		  }
		  
		  return $data;
      }
	  
      /**
       * Utility::getSnippets()
       * 
       * @param array $filename
       * @return
       */
	  public static function getSnippets($filename, $data = '')
	  {
		  if (File::is_File($filename)) {
			  ob_start();
			  if(is_array($data)) {
			     extract($data, EXTR_SKIP);
			  }
			  require($filename);
			  $html = ob_get_contents();
			  ob_end_clean();
			  return $html;
		  } else {
			  return false;
		  }
	  }

      /**
       * Utility::renderTimeRecordHeader()
       * 
       * @param str $date
       * @return
       */
	  public static function renderTimeRecordHeader($date = '')
	  {
		  $firstWeekDay = App::Core()->weekstart ? 'Sunday' : 'Monday';
		  $dateTime = new DateTime($date);
		  if ($dateTime->format('l') !== $firstWeekDay) {
			  $dateTime->modify("last {$firstWeekDay}");
		  }
		  $period = new DatePeriod($dateTime, new DateInterval('P1D'), 6);
	
		  return $period;
	  }
	  
	  /**
	   * Utility::doRange()
	   * 
	   * @param mixed $min
	   * @param mixed $max
	   * @param mixed $step
	   * @return
	   */
	  public static function doRange($min, $max, $step, $selected = false)
	  {
		  $html = '';
          foreach (range($min, $max, $step) as $number) {
			  $html .= "<option value=\"" . $number . "\"";
			  $html .= ($number == $selected) ? ' selected="selected"' : '';
			  $html .= ">" . $number . "</option>\n";
          }
		  
		  return $html;
	  }
	  
      /**
       * Utility::sayHello()
       * 
       * @return
       */
      public static function sayHello()
      {
          $welcome = Lang::$word->HI . " ";
          if (date("H") < 12) {
              $welcome .= Lang::$word->HI_M;
          } else
              if (date('H') > 11 && date("H") < 18) {
                  $welcome .= Lang::$word->HI_A;
              } else
                  if (date('H') > 17) {
                      $welcome .= Lang::$word->HI_E;
                  }

          return $welcome;
      }

	  /**
	   * Utility::getHeaderBg()
	   * 
	   * @return
	   */
	  public static function getHeaderBg()
	  {

		  return isset($_COOKIE['headerBgColor']) ? ' style="background-color:' . $_COOKIE['headerBgColor'] . '"' : '' ;
	  }

	  /**
	   * Utility::getSidearrBg()
	   * 
	   * @return
	   */
	  public static function getSidearrBg()
	  {

		  return isset($_COOKIE['sidebarBgColor']) ? ' style="background-color:' . $_COOKIE['sidebarBgColor'] . '"' : '' ;
	  }

	  /**
	   * Utility::getImageUrl()
	   * 
	   * @param mixed $ext
	   * @param mixed $name
	   * @return
	   */
	  public static function getImageUrl($ext, $name)
	  {

		  return ($ext == "jpg" || $ext == "png" || $ext == "gif") ? UPLOADURL . 'files/' . $name : UPLOADURL . 'mime/' . $ext . '.png';
		  
	  }
  }