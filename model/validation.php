<?php

class Validate
{
    public static function validName($name)
    {
        $name = trim($name);
        return ctype_alpha($name);
    }

    public static function validGithub($git)
    {
        return (filter_var($git, FILTER_VALIDATE_URL) || empty($git));
    }

    public static function validExperience($experience)
    {
        return (!empty($experience) && in_array($experience, getExperience()));
    }

    public static function validPhone($phone)
    {
        return ctype_digit($phone);
    }

    public static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validSelectionsVerticals($userVerticals)
    {
        $validVerticals = getVerticals();

        //Check each user condiment against array of valid condiments
        foreach ($userVerticals as $userVertical) {
            if (!in_array($userVertical, $validVerticals)) {
                return false;
            }
        }
        return true;
    }

    public static function validSelectionsJobs($userJobs)
    {
        $validJobs = getJobs();

        //Check each user condiment against array of valid condiments
        foreach ($userJobs as $userJob) {
            if (!in_array($userJob, $validJobs)) {
                return false;
            }
        }
        return true;
    }
}
