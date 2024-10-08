<?php
namespace Nickyeoman\Validation;

/**
* Validation Class
* v6.0.0
* Last Updated: September 12, 2024
* URL: https://github.com/nickyeoman/php-validation-class
*
* Changelog:
* v6 Added some better error checking
* v5 Added max length checker
* v4 PHP8 support, NickYeoman Framework supported, added namespace, composer support
* v3 is easy to intergrate into CI as a library (renamed) + bug fixes
* v2 now works with PHP 5.3 and up
**/

class Validate {

  /**
  * Trims and strips html
  * returns clean variable
  **/
  public function clean($var)
  {
      return trim(strip_tags($var)) ?: null; 
  }

  /**
  * If an email is Valid it returns the parameter
  * other wise it will return false
  * $email is the email address
  **/
  public function isEmail($email) {

    $email = $this->clean($email);

    //email is not case sensitive make it lower case
    $email =  strtolower($email);

    //check if email seems valid
    if (preg_match("/^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+(\\.[a-z0-9-]+)*(\\.[a-z]{2,3})$/", $email)) {
      return $email;
    }

    return false;

  }

  /**
  * Check length
  * if equal to or greater than length returns strlen
  * false if too short
  **/
  public function minLength($str1, $length) {

    if (!is_int($length)) {
      throw new InvalidArgumentException('Validation Class: Length must be an integer. minLength(string, number)');
    }

    $str1 = $this->clean($str1);
    $count = strlen($str1);

    if( $count >= $length) {
      return $count;
    } else {
      return false;
    }

  }

  /**
  * Check length
  * if equal to or greater than length return true
  * false if too short
  **/
  public function maxLength($str1, $length) {

    if( strlen($str1) <= $length) {
      return true;
    } else {
      return false;
    }

  }

  /**
  * Checks that two paramters match
  **/
  public function isMatch($term1, $term2) {
    $this->clean($term1);
    $this->clean($term2);

    if ($term1 == $term2) {
      return true;
    } else {
      return false;
    }

  }

  /**
  * Checks if there are 7 or 10 numbers, if so returns cleaned parameter(no formating just numbers)
  * other wise it will return false
  * $phone is the phone number
  * $ext if set to true return an array with extension separated
  **/
  public function isPhone($phone, $ext = false) {

    $phone = $this->clean($phone);

    //remove everything but numbers
    $numbers = preg_replace("%[^0-9]%", "", $phone );

    //how many numbers are supplied
    $length = strlen($numbers);

    if ( $length == 10 || $length == 7 ) { //Everything is find and dandy

      $cleanPhone = $numbers;

      if ( $ext ) {
        $clean['phone'] = $cleanPhone;
        return $clean;
      } else {
        return $cleanPhone;
      }

    } elseif ( $length > 10 ) { //must be extension

      //checks if first number is 1 (this may be a bug for you)
      if ( substr($numbers,0,1 ) == 1 ) {
        $clean['phone'] = substr($numbers,0,11);
        $clean['extension'] = substr($numbers,11);
      } else {
        $clean['phone'] = substr($numbers,0,10);
        $clean['extension'] = substr($numbers,10);
      }

      if (!$ext) { //return string

        if (!empty($clean['extension'])) {
          $clean = implode("x",$clean);
        } else {
          $clean = $clean['phone'];
        }

        return $clean;


      } else { //return array

        return $clean;
      }
    }

    return false;

  }

  /**
  * Canadian Postal code
  * thanks to: https://roshanbh.com.np/2008/03/canda-postal-code-validation-php.html
  **/
  public function isPostalCode($postal) {

    $postal = $this->clean($postal);

    $regex = "/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i";

    //remove spaces
    $postal = str_replace(' ', '', $postal);

    if ( preg_match( $regex , $postal ) ) {
      return $postal;
    } else {
      return false;
    }

  }

  /**
  * Checks for a 5 digit zip code
  * Clears extra characters
  * returns clean zip
  **/
  public function isZipCode($zip) {

    $zip = $this->clean($zip);

    //remove everything but numbers
    $numbers = preg_replace("[^0-9]", "", $zip );

    //how many numbers are supplied
    $length = strlen($numbers);

    if ($length != 5) {
      return false;
    } else {
      return $numbers;
    }
  }

  /**
  * Contains spammy words
  * spammy words should be csv
  **/
  public function checkSpam($content = '', $spammywords = 'viagra,cialis') {

    $spamarry = array_map('trim', explode(",", strtolower($spammywords)) ); //strtolower, trim spaces, put in array
    $checkme = strtolower(trim($content));
    $wordsfound = '';

    foreach ($spamarry as $v){
      if ( strpos($checkme, $v) ) {
        $wordsfound .= "$v ";
      }
    }

    trim($wordsfound);

    if (empty($wordsfound)) {
      return false; //no bad words
    } else {
      return $wordsfound; // bad words
    }
  }
}
//end checkSpam

/** End Validation **/
