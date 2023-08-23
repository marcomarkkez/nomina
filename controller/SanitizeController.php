<?php 
class SanitizeController{
    public function sanitize($input){
        $output = strip_tags($input);
        $output = addslashes($output);
        return $output;
    }
}