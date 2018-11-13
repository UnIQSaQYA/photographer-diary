<?php
/**Redirects to the location sent through parameter
 * @param $location
 */

function redirect_to($location = "")
{
    if (empty($location)) return false;

    header("Location: main_layout.php?page=" . $location);
    exit;
}


function validationErrors($className = '', $particular = null)
{
    $output = "";
    if (!isset($particular)) {
        if (Session::exists('validationErrors')) {
            foreach (Session::get('validationErrors') as $error) {
                $output .= "<div class='{$className}'>";
                $output .= $error;
                $output .= "</div>";
            }
            Session::delete('validationErrors');
            return $output;
        }
        return "";
    } else {
        if (Session::exists('validationErrors')) {

            $sessionErrors = Session::get('validationErrors');
            if (isset($sessionErrors[$particular])) {
                $output .= "<p class='$className'>&nbsp;&nbsp;&nbsp; ";
                $output .= $sessionErrors[$particular];
                $output .= "</p>";
                unset($_SESSION['validationErrors'][$particular]);
                return $output;
            }

        }
    }
}

function hasError($particular = NULL)
{
    if(isset($particular)) {
        if(Session::exists("validationErrors")) {
            $sessionErrors = Session::get('validationErrors');
            if(isset($sessionErrors[$particular])) {
                return true;
            }
            return false;
        }
    }
}

function errorFields($fieldName = "")
{
    $output = '';
    if (Session::exists($fieldName)) {
        $output .= $_SESSION[$fieldName];
        Session::delete($fieldName);
    }
    return $output;
}


function selectErrorField($fieldName = "", $selectName = "")
{

    if (isset($_SESSION[$selectName])) {
        if ($fieldName == $_SESSION[$selectName]) {
            Session::delete($selectName);
            return "selected";
        } else {
            return "";
        }
    } else {
        return "";
    }
}


function sessionDisplayMessage()
{
    $output = '';
    if (Session::exists('success')) {
        $output .= "<div class='alert alert-success'>";
        $output .= Session::get('success');
        $output .= "</div>";
        Session::delete('success');
    } else if (Session::exists('error')) {
        $output .= "<div class='alert alert-danger'>";
        $output .= Session::get('error');
        $output .= "</div>";
        Session::delete('error');
    }
    return $output;
}


function uploadErrors($className)
{
    $output = "";
    if (Session::exists('uploadErrors')) {
        $sessionErrors = Session::get('uploadErrors');
        foreach ($sessionErrors as $error) {
            $output .= "<div class='{$className}'> 
                            <i class='glyphicon glyphicon-warning-sign'></i>&nbsp;&nbsp;&nbsp; ";
            $output .= $error;
            $output .= "</div>";
        }
        Session::delete('uploadErrors');
    }
    return $output;
}

function activeClass($requestUri)
{
    $current_file_name = $_SERVER['REQUEST_URI'];
    if ($current_file_name == $requestUri) {
        die("Test");
        echo 'class="active"';
    }

    echo "expression";
}

/**
 * This function is to use to render html characters, useful in preventing xss attack
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function html_substr($string, $length) 
{ 
    if( !empty( $string ) && $length>0 ) { 
        $isText = true; 
        $ret = ""; 
        $i = 0; 
        $currentChar = ""; 
        $lastSpacePosition = -1; 
        $lastChar = ""; 
        $tagsArray = array(); 
        $currentTag = ""; 
        $tagLevel = 0; 
        $noTagLength = strlen( strip_tags( $string ) ); 
    // Parser loop 
        for( $j=0; $j<strlen( $string ); $j++ ) { 
            $currentChar = substr( $string, $j, 1 ); 
            $ret .= $currentChar; 
    // Lesser than event 
            if( $currentChar == "<") $isText = false; 
    // Character handler 
            if( $isText ) { 
    // Memorize last space position 
                if( $currentChar == " " ) { $lastSpacePosition = $j; } 
                else { $lastChar = $currentChar; } 
                $i++; 
            } else { 
                $currentTag .= $currentChar; 
            } 
    // Greater than event 
            if( $currentChar == ">" ) { 
                $isText = true; 
    // Opening tag handler 
                if( ( strpos( $currentTag, "<" ) !== FALSE ) && 
                    ( strpos( $currentTag, "/>" ) === FALSE ) && 
                    ( strpos( $currentTag, "</") === FALSE ) ) { 
    // Tag has attribute(s) 
                    if( strpos( $currentTag, " " ) !== FALSE ) { 
                        $currentTag = substr( $currentTag, 1, strpos( $currentTag, " " ) - 1 ); 
                    } else { 
    // Tag doesn't have attribute(s) 
                        $currentTag = substr( $currentTag, 1, -1 ); 
                    } 
                    array_push( $tagsArray, $currentTag ); 
                } else if( strpos( $currentTag, "</" ) !== FALSE ) { 
                    array_pop( $tagsArray ); 
                } 
                $currentTag = ""; 
            } 
            if( $i >= $length) { 
                break; 
            } 
        } 
    // Cut HTML string at last space position 
        if( $length < $noTagLength ) { 
            if( $lastSpacePosition != -1 ) { 
                $ret = substr( $string, 0, $lastSpacePosition ); 
            } else { 
                $ret = substr( $string, $j ); 
            } 
        } 
    // Close broken XHTML elements 
        while( sizeof( $tagsArray ) != 0 ) { 
            $aTag = array_pop( $tagsArray ); 
            $ret .= "</" . $aTag . ">\n"; 
        } 
    } else { 
        $ret = ""; 
    } 
    return( $ret ); 
} 

function slugify($text)
{ 
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
}