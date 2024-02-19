<?php
/*
Levi Miller
1/20/24
data-layer.php: data for  boxes
*/
class checkedData{

    static function getYears(){
        return array('0-2', '2-4', '4+');
    }

    static function getRelocate(){
        return array('yes','no','maybe');
    }

    static function getJobOpenings(){
        return array('javascript','PHP','java','python','HTML','CSS','reactUS','NodeJs','saaS','health tech','ag tech','hr tech','industrial tech','cyber security');
    }


}