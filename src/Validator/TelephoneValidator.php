<?php
// src/Validator/TelephoneValidator.php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TelephoneValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint) {

        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneNumberUtil->parse($value, 'BE');

            if ($phoneNumberUtil->isValidNumber($phoneNumberObject) === false ){
                return $this->context
                    ->buildViolation($constraint->message)
                    ->addViolation()
                    ;
            }
        }
        catch(\Exception $e){
            return $this->context
                ->buildViolation($constraint->message)
                ->addViolation()
                ;
        }
    }
}
