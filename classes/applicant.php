<?php
/**
 * The Applicant class represents an applicant that applies to the position
*/

class applicant
{
    private $_fName;
    private $_lName;
    private $_email;
    private $_state;
    private $_phone;
    private $_bio;
    private $_gitLink;
    private $_experience;
    private $_relocate;


    /**
     * Default constructor for applicant class
     */
    function __construct($fName = "", $lName = "", $email = "", $state = "", $phone = "")
    {
        $this->_fName = $fName;
        $this->_lName = $lName;
        $this->_email = $email;
        $this->_state = $state;
        $this->_phone = $phone;
        $this->_bio = "";
        $this->_gitLink = "";
        $this->_experience = "";
        $this->_relocate = "";
    }

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->_fName;
    }

    /**
     * @param string $fName
     */
    public function setFName(string $fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->_lName;
    }

    /**
     * @param string $lName
     */
    public function setLName(string $lName)
    {
        $this->_lName = $lName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->_state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->_state = $state;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->_bio;
    }

    /**
     * @param string $bio
     */
    public function setBio(string $bio)
    {
        $this->_bio = $bio;
    }

    /**
     * @return string
     */
    public function getGitLink(): string
    {
        return $this->_gitLink;
    }

    /**
     * @param string $gitLink
     */
    public function setGitLink(string $gitLink)
    {
        $this->_gitLink = $gitLink;
    }

    /**
     * @return string
     */
    public function getExperience(): string
    {
        return $this->_experience;
    }

    /**
     * @param string $experience
     */
    public function setExperience(string $experience)
    {
        $this->_experience = $experience;
    }

    /**
     * @return string
     */
    public function getRelocate(): string
    {
        return $this->_relocate;
    }

    /**
     * @param string $relocate
     */
    public function setRelocate(string $relocate)
    {
        $this->_relocate = $relocate;
    }
}

// Test code
//$test = new Applicant();
//$test->setFName("Sam");
//echo $test->getFName();