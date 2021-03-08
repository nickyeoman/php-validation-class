<?php
require_once "vendor/autoload.php";

USE Nickyeoman\Validation;
$valid = new Nickyeoman\Validation\Validate();

//Test Clean
$testClean = ['<h1>Title</h1>', '      My Name    ', '</body></html>'];

foreach ($testClean as $value) {

  $clean = $valid->clean($value);
  echo "cleaned: $clean \n";
}

  if( $valid->isEmail($value) ){
    echo "Email: $value is Good\n";
  } else {
    echo "Email: $value is bad\n";
  }

//TEST EMAILS
$testEmails = ['good@email.com', 'alsogood@email.com', 'bad+email.com', 'not@nEmail,com'];

foreach ($testEmails as $value) {

  if( $valid->isEmail($value) ){
    echo "Email: $value is Good\n";
  } else {
    echo "Email: $value is bad\n";
  }

}

exit();
