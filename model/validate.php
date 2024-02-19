<?php

class Validate {

    static function validName($name){
        return ctype_alpha($name);
    }

    static function validGithub($git){
      return filter_var($git,FILTER_VALIDATE_URL);

    }

    static function validExperience($Years){
        return $Years == null;

    }

    static function validPhone($phone){
        //return preg_grep(([0-9][3])([0-9][3])([0-9][4]));

    }

    static function validEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}