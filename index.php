<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    function validPart($part)
    {
        $pieces = explode('-', $part);
        $categories = array('hw', 'sg', 'ap');
        if(in_array(strtolower(trim($pieces[0])), $categories)) {
            if(is_numeric($pieces[1])) {
                if(strlen(trim($pieces[1])) == 2) {
                    if(ctype_alnum(strtolower(trim($pieces[2])))) {
                        if(strlen(trim($pieces[2])) == 4)
                            return true;
                        else {
                            echo "<p>$part: Invalid part number - must be 4 characters.</p>";
                            return false;
                        }
                    }
                    else{
                        echo "<p>$part: Invalid part number - must be alphanumeric.</p>";
                        return false;
                    }
                }
                else{
                    echo "<p>$part: Invalid warehouse – must be 2 digits.</p>";
                    return false;
                }
            }
            else{
                echo "<p>$part: Invalid warehouse – must be numeric.</p>";
                return false;
            }
        }
        else{
            echo "<p>$part: Invalid category – must be HW, SG, or AP.</p>";
            return false;
        }
    }

    function validPartRx($part)
    {
        $regEx = "/^\s*(hw|sg|ap)\s*-?\s*\d{2}\s*-?\s*\w{4}\s*$/i";
        return preg_match($regEx, $part);
    }

    $parts = array("AP-12-3507", "  ap-99-X109  ", "SG-05-ab20",
        "ab-22-N250", "SG-xx-N250", "SG-22-250", "SG-22-250*");

    echo "<h1>Part I</h1>";
    foreach ($parts as $part) {
        if (validPart($part))
            echo "<p>$part is valid.</p>";
        else
            echo "<p>$part is not valid.</p>";
    }


    echo "<h1>Part II</h1>";
    foreach ($parts as $part) {
        if (validPartRx($part))
            echo "<p>$part is valid.</p>";
        else
            echo "<p>$part is not valid.</p>";
    }