<?php
/**
 * @author: Levi Miller
 * description: represents an applicant_SubscribedToList for AIcompany
 * applicant_SubscribedToList.php
 */
 class applicant_SubscribedToList extends Applicant{


     private $_JobOpenings;

     private $_IndustryVertical;

     /**
      * constructor
      * @param $_JobOpenings
      * @param $_IndustryVertical
      */
     public function __construct($JobOpenings="", $IndustryVertical="")
     {
         $this->_JobOpenings = $JobOpenings;
         $this->_IndustryVertical = $IndustryVertical;
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
     public function setJobOpenings($JobOpenings)
     {
         $this->_JobOpenings = $JobOpenings;
     }

     /**
      * @return mixed
      */
     public function getIndustryVertical()
     {
         return $this->_IndustryVertical;
     }

     /**
      * @param mixed|string $IndustryVertical
      */
     public function setIndustryVertical($IndustryVertical)
     {
         $this->_IndustryVertical = $IndustryVertical;
     }





 }
