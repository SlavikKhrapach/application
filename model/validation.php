<?php

function validName($name) {
    $name = trim($name);
    return ctype_alpha($name);
}

function validGithub($git) {
    return (filter_var($git, FILTER_VALIDATE_URL) || empty($git));
}

function validExperience($experience) {
    return (!empty($experience) && in_array($experience, getExperience()));
}

function validPhone($phone) {
    return ctype_digit($phone);
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validSelectionsJobs() {

}

function validSelectionsVerticals() {

}