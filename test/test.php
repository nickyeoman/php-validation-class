<?php
require_once "vendor/autoload.php";

$valid = new Nickyeoman\Validation\Validate();

$testEmails = ['good@email.com', 'alsogood@email.com', 'bad+email.com', 'not@nEmail,com'];

foreach ($testEmails as $value) {

  if( $valid->isEmail($email) ){
    echo "Email: $value is Good";
  } else {
    echo "Email: $value is bad";
  }

}

exit();
