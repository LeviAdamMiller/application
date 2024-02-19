<?php

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
        return $phone;

    }

    static function validEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}