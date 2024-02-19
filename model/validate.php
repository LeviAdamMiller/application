<?php
/*
Levi Miller
2/16/24
validator.php  validating name, Github, experience years, phone and email.
*/
class Validate {
    static function validName($name){
        return ctype_alpha($name);
    }

    static function validGithub($git){
       if($git == null){return true;}
        return filter_var($git,FILTER_VALIDATE_URL);
    }

    static function validExperience($Years){
        return $Years != null;

    }

    static function validPhone($phone){
        return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone);

    }

    static function validEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
