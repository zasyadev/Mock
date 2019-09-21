<?php

//global helper function to send email
if (! function_exists('sendMail') ) {
    function sendMail($company) {
        try{
            \Mail::to($company->email)->send(New App\Mail\NewCompanyNotification);
        } catch(\Exception $e) {
            $error = sprintf('[%s][%d] Error: Something went wrong while sending email. Reason: [%s]', __METHOD__, __LINE__, $e->getMessage());
             \Session::flash('error', $error);
        }
    }
}