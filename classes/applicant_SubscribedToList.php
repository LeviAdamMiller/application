<?php

 class applicant_SubscribedToList extends Applicant{


     private $_JobOpenings;

     private $_VerticalIndustry;

     /**
      * @param $_JobOpenings
      * @param $_VerticalIndustry
      */
     public function __construct($JobOpenings="", $VerticalIndustry="")
     {
         $this->_JobOpenings = $JobOpenings;
         $this->_VerticalIndustry = $VerticalIndustry;
     }

     /**
      * @return mixed
      */


     public function getJobOpenings()
     {
         return $this->_JobOpenings;
     }

     /**
      * @param mixed $JobOpenings
      */
     public function setJobOpenings($JobOpenings): void
     {
         $this->_JobOpenings = $JobOpenings;
     }

     /**
      * @return mixed
      */
     public function getVerticalIndustry()
     {
         return $this->_VerticalIndustry;
     }

     /**
      * @param mixed $VerticalIndustry
      */
     public function setVerticalIndustry($VerticalIndustry): void
     {
         $this->_VerticalIndustry = $VerticalIndustry;
     }





 }
