<?php

if (!function_exists('successMsg')) {
    function successMsg($type, $message) {
        if($type == "insert") {
            session()->flash("message", $message);
        } else if($type == "update") {
            session()->flash("message", $message);
        } else if($type == "delete") {
            session()->flash("message", $message);
        } else if($type == 'custom') {
            session()->flash("message", $message);
        }  else if($type == 'error') {
            session()->flash("error", $message);
        }
    }
}

