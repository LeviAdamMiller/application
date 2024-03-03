<?php
/**
Levi Miller
3/2/24
Description: controller for application
controller.php
 */
class controller
{

    private $_f3; //Fat-free router

    /**
     * @param $f3
     * constructor
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Home page
     * displaying home page
     */
    function home()
    {
        // display views page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * validates personal info and if there are no errors then checks if mailing lists is checked
     * then instantiates proper applicant object
     */
    function personalInformation()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!Validate::validName($_POST['firstName'])) {
                $this->_f3->set('errors["firstName"]', "Invalid first name");
            }

            if (!Validate::validName($_POST['lastName'])) {
                $this->_f3->set('errors["lastName"]', "Invalid last name");
            }

            if (!Validate::validEmail($_POST['email'])) {
                $this->_f3->set('errors["email"]', "Invalid email");

            }
            if (!Validate::validPhone($_POST['phone'])) {
                $this->_f3->set('errors["phone"]', "Invalid Phone format");
            }


            //validate the data
            // If there are no errors
            if (empty($this->_f3->get('errors'))) {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $state = $_POST['state'];

                if (isset($_POST['mailing'])) {
                    $JobOpenings = [];
                    $IndustryVertical = [];
                    $applicant = new applicant_SubscribedToList($JobOpenings, $IndustryVertical);
                    $applicant->setFname($firstName);
                    $applicant->setLname($lastName);
                    $applicant->setEmail($email);
                    $applicant->setPhone($phone);
                    $applicant->setState($state);
                    $this->_f3->set('SESSION.applicant', $applicant);
                } else {
                    $applicant = new Applicant($firstName, $lastName, $email, $phone, $state, $relocate = "", $years = "", $bio = "", $git = "");
                    $this->_f3->set('SESSION.applicant', $applicant);
                }
                $this->_f3->reroute('experience');
            }
        }

        // display views page
        $view = new Template();
        echo $view->render('views/personalInformation.html');
    }
    /**
     * Collects and validates data from experience page if there are no errors
     * sets data to applicant session array
     */
    function experience()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            echo isset($_POST['mailing']);

            if (!Validate::validExperience($_POST['years'])) {
                $this->_f3->set('errors["years"]', "Invalid Years ");
            }

            if (!Validate::validGithub($_POST['Github'])) {
                $this->_f3->set('errors["Github"]', "Invalid Github Link");
            }

            if (empty($this->_f3->get('errors'))) {
                // Validate the data
                $years = implode(", ", $_POST['years']);

                if (isset($_POST['relocate'])) {
                    $relocate = implode(", ", $_POST['relocate']);
                } else {
                    $relocate = "None selected";
                }

                $this->_f3->get('SESSION.applicant')->setRelocate($relocate);
                $this->_f3->get('SESSION.applicant')->setExperience($years);

                $bio = $_POST['biography'];
                $git = $_POST['Github'];

                // Put the data in the session array
                $applicant = $this->_f3->get('SESSION.applicant');
                $applicant->setBio($bio);
                $applicant->setGithub($git);
                $this->_f3->set('SESSION.applicant', $applicant);

                if ($applicant instanceof applicant_SubscribedToList) {
                    $this->_f3->reroute('jobOpenings');
                } else {
                    $this->_f3->reroute('summary');
                }

            } else {
                $this->_f3->reroute('experience');
            }
        }

        $this->_f3->set('years', checkedData::getYears());
        $this->_f3->set('relocate', checkedData::getRelocate());

        // Get data from the model and add to the F3 "hive"
        // display views page
        $view = new Template();
        echo $view->render('views/experience.html');

    }

    /**
     * Only shows up for applicant_SubscribedToList
     * collects job mailing list selections and then stores in the applicant_SubscribedToList
     * object
     */
    function jobOpenings()
    {
        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Validate the data
            if (isset($_POST['mail'])) {
                $mail = implode(", ", $_POST['mail']);
            } else {
                $mail = "None selected";
            }

            // Validate the data
            if (isset($_POST['vertical'])) {
                $vertical = implode(", ", $_POST['vertical']);
            } else {
                $vertical = "None selected";
            }

            // Put the data in the application object session array
            $this->_f3->get('SESSION.applicant')->setJobOpenings($mail);
            $this->_f3->get('SESSION.applicant')->setIndustryVertical($vertical);

            // Redirect to summary route
            $this->_f3->reroute('summary');
        }

        $this->_f3->set('JobOpenings', checkedData::getJobOpenings());
        $this->_f3->set('IndustryVerticals', checkedData::getIndustryVerticals());

        // display views page
        $view = new Template();
        echo $view->render('views/jobOpenings.html');
    }

    /**
     * displays summary page
     */
    function summary()
    {
        // Display a view page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}