<?php
// set up session. Will be used to pass data to reply/error pages
session_start();
/*
* slisform_handler.php  version 1.2
* Date created: 25 July 2008
* Last modified: 03 March 2009, hhe
* Demo form handler for libr240 course at SJSU School of Library & Info. Science
*
* Copyright 2008 Heather Ebey for SJSU SLIS
* Form handler used for teaching form processing in the San Jose State
* University School of Library and Information Science program. It
* is specifically designed as a teaching aid for LIBR 240.
*
* Use: Permission is granted to any faculty or instructor in a
* SJSU SLIS LIBR 240 course to copy and distribute this form 
* package within a SJSU SLIS LIBR 240 class.  In no circumstances
* may this package or any part of it be used in a commercial environment.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
*
*
* This is a demo only. Do not use in a production system.
* 
* This form handler consists of 4 or 5 parts that for simplicity should be 
* put in the same directory. If you know what you are doing, you can put
* the 240form_handler.php and 240form_config.inc together in a different 
* directory.
* 
*   1. 240form_handler.php The form handler itself
       Does the form processing. Use it in the action part of the HTML file
       that contains the form: 
 form id="someid" name="somename" method="post" action="240form_handler.php" 
       Do NOT edit 240form_handler.php unless you know PHP.
   2. 240form_config.inc - The default form handler configuration file. 
       The 240form_config.inc is where you localize the configuration
       for the 240form_handler.php
   3. 240form_example1.html - example with only $allFields set and the rest of the configuration settings are at the default setting
   4. 240form_readme.txt - how to use the form
   5. output.txt - output file to save the data to in addition to or 
      instead of emailing it to the form creator.
   6. form_confirm.php - optional example to wrap reply page in style of web site
   7. 240form_example2.shtml - example using advanced features
   8. 240form_ex2config.inc - used with 240form_example2.shtml
* 
*/

/****
 * ++++CAUTION++++: The following 2 lines are only for use while developing
 *  the code. DO NOT use on real or public web sites. Security issue. 
*/
// ini_set('display_errors',1);
// error_reporting(E_ALL);

// Uncomment the following to make sure no errors are displayed to the end user
error_reporting(0);

// The configuaration file -- all configuration should be done in the
// configuration file. You should not have to touch this
// 240form_handler.php script.

$version = '1.2';
$hidden = 'configFile';
$config_file = "";

if ( isset($_POST['configFile']) && !empty($_POST['configFile']) ) {
  $config_file = trim($_POST['configFile']);
  include_once $config_file;
} else {
  // automatically include the default 240form_config.inc
  // it must be in the same directory as the form and this 240form_handler.php
  include_once '240form_config.inc';
}

// Set variables to defaults
$debug = 0;  // Set to 1 to get more information during debugging
$clean_array = array();
$keys = array();
$values = array();
$missing_data_keys = array();
$missing_num = -1;
$errors = array();
$allfields_array = array();
$ignore_fields = array();
$configfields_array = array();
$ignore_array = array();
$numerrs = 0;
$output_data = "";
$output_file = "";
$email_body = "";
$submitterNames = array($submitterNames);
$mail_name = "";
$emailSubject = "";
$emailSubjectCollector = "Here is the data recently submitted.";
$form_path = "";
$today = 0;
$timestamp = 0;

// Don't uncomment following unless you are debugging
// and know what you are doing.
//echo "<p>DEBUG<br><pre>\n";
//var_dump($_POST);
//echo "</pre>";

/* clean up data passed in for security reasons and to remove
   spaces at begin and end of data
*/
$clean_array = cleanData($_POST);

/* $allFields must exist in the external form configuration file for
empty radio buttons  and empty checkboxes to be listed in the 
confirmation page and output files. If all text input boxes, it 
is not required.
*/
if ( isset($allFields) && $allFields != "" ) {
  $allfields_array = explode(',', $allFields);
}

if ( isset($ignoreFields) ) {
  $ignore_array = explode(',',$ignoreFields);

  /* if $allfields_array is used, then we want to remove the ignore 
     field values from the $allfields_array.
   */
  if ( count($allfields_array) > 0 ) {
     for ( $i = 0; $i < count($allfields_array); $i++ ) {
         $this_key = $allfields_array[$i]; 
           if ( !in_array($this_key, $ignore_array ) ) {
                if ( isset($_POST[$this_key] ) ) {
  	          $configfields_array[$this_key] =  $clean_array[$this_key];
                } else {
                  $configfields_array[$this_key] = "";
                }
           }
       }
    }
}


if ( count($configfields_array) > 0 ) {
   $datafields_array = $configfields_array;
} else {
   $datafields_array = $clean_array;
}

foreach ($datafields_array as $this_key => $this_value ) {

   // requiredMissing returns true if data is missing, else returns false
   if ( requiredMissing( $this_key, $this_value) === true ) {
      $missing_num++;
      $missing_data_keys[$missing_num] = $this_key;
   }

   // radio, select options, and checkboxes are arrays
   $value = "";
   if ( is_array( $this_value ) ) {
     if ( isset( $this_value ) ) {
        foreach ( $this_value as $str ) {
         if ( $value == "" ) {
           $value .= $str;
         } else {
           $value .= ",".$str;
         }
       }
     } else {
        $value = '';
     }
     $this_value = $value;
   }

   if ( $this_key != $hidden ) {
     array_push ($keys, $this_key);
     array_push ($values, $this_value);
   }

   // Set mail variables if data should be sent to the person 
   // collecting the form output, or to the form submitter
   if ( $emailData || $sendReply ) {
     if ( !empty ($submitterNames) ) {
        for ($i = 0; $i < count ($submitterNames); $i++) {
          if ( $this_key == $submitterNames[$i] ) {
            $mail_name .= $this_value." ";
          }
        }
    }
    
    if ( !empty ($submitterEmailField) && $this_key == $submitterEmailField) {
       $reply_to = $this_value;
    }
  }
  
  
}
// end foreach processing $_POST


// Were any required values missing?
// If so, print page showing data entered with required data marked.
if ( count( $missing_data_keys ) > 0 ) {
  echo createHeading();
  if ( $errorMessage ) {
    echo "<p>".$errorMessage."</p>\n";
  } else {
    echo "<p>Use the browser back button or the back button below to return to previous page to complete the form. The missing required values are in red preceded by an asterisk.</p>\n";
  }
  echo "<form><p><input  type=\"button\" value=\"Return to Form\" onclick=\"history.back();\" /></p></form><br />\n";
  
  echo createHtmlOutput($keys, $values, $missing_data_keys);
  echo createFooter();
  exit(1);
}


// If required fields are filled in, process form
// Look at values in 240form_config.inc file to see what is wanted.

  // Set up date and time stamps
  if ( $timeStamp ) {
    $unixdate = date("U");
    $today = get_date_now($unixdate);
    $timestamp = get_time_now($unixdate);
  }
  
// Output file location check
// Make sure output file is set up correctly if data goes to output
  if ( $formPath != "" ) {
    $form_path = trim($formPath);
  } else {
    $form_path = "./";
  }

  $output_file = $form_path.$saveDataFilename;
  if ( $saveData == 1 && dataFileOK( $output_file ) ) {
    if ( $dataSeparator == "" ) {
      $dataSeparator = "|";
    }
  
    // need to save data to an output file
    // each line in the output file will have one completed form
    /* if ( $ignore_fields == "" ) { */
      for ($i = 0; $i < count($values); $i++ ) {
          $output_data .= $values[$i].$dataSeparator;
      }
    /* } else {
       for ($i = 0; $i < count($values) -1 ; $i++ ) {
        if ( $keys[$i] != $ignore_fields ) {
          $output_data .= $values[$i].$dataSeparator;
        }
      }
    }
  */
    
    if ( $timeStamp ) {
      $output_data .= $today.$dataSeparator.$timestamp.$dataSeparator;
    }
  
    $result = appendToFile( $output_file, $output_data );
    if ( $result != 0 ) {  // 0 means there were no processing errors
      $errors[$numerrs] = "Error writing data to output file.";
      $numerrs++;
    }
  
  }
  
// Make sure email is set up correctly. 
if ( $emailData || $sendReply ) {

  if ( ! empty($emailSubjectSubmitter) ) {
    $emailSubject = trim($emailSubjectSubmitter);
  } else {
    $emailSubject = "Form submitted";
  }

  $header_extras = ( $emailFrom ) ? 'From: '.$emailFrom : '';
       
  for ($i = 0; $i < count($keys); $i++ ) {
     if ( $debug ) {
        echo "i=$i, keys=$keys[$i], values=$values[$i]<br />\n";
     }
     
     if ( $ignoreFields != "" && $keys[$i] != $ignore_fields ) {
        $email_body .= strtoupper($keys[$i]).": ".$values[$i]."\n";
     }
  }
  if ( $timeStamp ) {
    $email_body .= "Today: ".$today.", ".$timestamp;
  } else {
    $email_body .= "\n";
  }
 
  // Form creator wants data mailed to them, possibly in addition to 
  // saving it to a file.
  if  ( $emailData ) {
      // $emailDataTo, if filled in is not checked to see if it is valid 
      // email address.
      if ( $emailDataTo == "" && $emailDataTo1 == "" && $emailDataTo2 == "" ) {
        $errors[$numerrs] = "Email address for person collecting data is not set correctly in
        config options 9 and 9b. Please notify webmaster.";
        $numerrs++;
      } else {
        // Need to find out if data should be mailed to different people based on
        // a form radio button selection
        //  $emailToFieldAlternate = "tasktype";
        // $connectEmailTo1 = "archival";
        // $connectEmailTo2 = "nonarchival";
        //
        if ( $emailData && $emailDataTo == "" && $emailToFieldAlternate != "" ) {
            // find the radio button setting
            if ( $_POST[$emailToFieldAlternate] ===  $connectEmailTo1 ) {
              $emailDataTo = $emailDataTo1;
            } else {
              if ( $_POST[$emailToFieldAlternate] ===  $connectEmailTo2 ) { 
                $emailDataTo = $emailDataTo2;
              }
            }
        }
        // Send mail to person collecting this data
        mail($emailDataTo, $emailSubjectCollector, $email_body, $header_extras);
  
      // send reply with data to person who submitted form
      if  ( $sendReply && $reply_to != "" ) {
        if ( $emailMessageSubmitter != "" ) {
          $email_body = "Hello ".$mail_name.",\n".$emailMessageSubmitter."\n\n".$email_body;
        } else {
          $email_body .= "Hello ".$mail_name.",\nThank you for filling out this form. Below is what you submitted.\n\n".$email_body;
        }
        mail($reply_to, $emailSubject, $email_body, $header_extras);
      }
    }
  }
}


// Display on screen confirmation that the data form was 
// successfully submitted. Optionally, if $displayEnteredData = 1
// in config file, also show the data submitted.

if ( count($errors) <=  0 ) {

  if ( $displayEnteredData ) {
    if ( ! isset($replyURL) || $replyURL == "" ) {
        // if there is not output file, then just create
        // one with out web site specific style
        echo createHeading();
        echo isset($successMessage) && $successMessage != "" ? $successMessage: "Data submitted successfully!";
        echo createHtmlOutput( $keys, $values, $missing_data_keys);
        echo "<form><p><input  type=\"button\" value=\"Return to Form\" onclick=\"history.back();\" /></p></form><br />\n";
        echo createFooter();
        
    } else {
       if ( isset($replyURL) && $replyURL != "" ) {
        $html_output = createHtmlOutput( $keys, $values, $missing_data_keys );
        $_SESSION['htmlOutput'] = $html_output;
        $_SESSION['successMessage'] = isset($successMessage) && $successMessage != ""  ? $successMessage: "Data submitted successfully!";
        header("location:". $replyURL.'?'.session_name().'='.session_id());
        exit;
      }
   }
  } else {
    // no displayEnteredData set!
    if ( isset($replyURL) && $replyURL != "" ) {
      $_SESSION['successMessage'] = isset($successMessage) && $successMessage != ""  ? $successMessage: "Data submitted successfully!";
      header("location:". $replyURL.'?'.session_name().'='.session_id());
      exit;
    } else {
        echo createHeading();
        echo isset($successMessage) && $successMessage != "" ? $successMessage: "Data submitted successfully!";
        echo createFooter();
    }
  }
  
} else {
  
   // $displayErrors is set in included form configuration file. Use it only for
   // debugging. Once the form works, set $displayErrors = 0 in config file.
   if ( $displayErrors && count($errors) > 0 ) {
     echo "<p>DEBUG: Errors found<br />\n";
     for ( $i = 0; $i <= count($errors) ; $i++ ) {
       if ($errors[$i] != "") {
         echo $errors[$i]."<br />\n";
       }
     }
     echo "</p>";
   }
}



// **********************************************************************
// ********  Internal functions start here.      

/* requiredMissing()
 * $key, $value are single values passed 
 * $requiredFields is a string of values set in 240form_config.inc file.
 * loops through $post_data and makes sure that all fields with
 * the prefix has been submitted.
 * Return: true if date is missing, else return false
 */
function requiredMissing ( $key, $value )
{
  global $requiredFields;
  $missing_data = false;
  
  // isRequired is function in this file
   
  if ( isRequired($key, $requiredFields ) ) {
    if ( empty($value) ) {
      $missing_data = true;
    }
  }
  return $missing_data;
}


/* cleanData()
 * trim space at beginning and end of data and stripslashes if required
 * $form is array of all form values from $_POST
 */
function cleanData ( $form )
{
  foreach ($form as $key => $value ) {
    // Check only scalar values for magic quotes and do data cleaning
    if ( is_scalar( $value )) {
      if ( ini_get( 'magic_quotes_gpc' )) {
        $form[$key] = trim( stripslashes( $value ));
      } else {
        $form[$key] = trim( $value );
      }
    }
  }
  return ($form);
}

/* isRequired()
 * Checks that all required fields - those listed in $requiredFields
 * in the 240form_config.inc  have been filled in with data.
 * This does NOT confirm that the data is the correct type for the field.
 */
function isRequired ( $value_name, $required_list )
{
   if ( eregi($value_name, $required_list) ) {
      return true;
   }
      return false;
}


/* dataFileOK()
 * returns true if $dataFilename exists and file is correctly
 * set up on Unix.
 */
function dataFileOK ( $outputFilename ) 
{
  global $errors;
  global $numerrs;
  
  if ( $outputFilename != "" ) {
    if ( file_exists($outputFilename) ) {
         if ( ! is_writable($outputFilename) ) {
          $errors[$numerrs] = $outputFilename." is not writable. Permissions need to be rw-rw-rw-.";
          $numerrs++;
          return false;
        }
    } else {
          $errors[$numerrs] = $outputFilename." does not exist.";
          $numerrs++;
          return false;
   }
  } 

  return true;
}
    
   
/* appendToFile()
 * $appendFileName is relative path and file name
 * $string is the single line to append to the file
 */
function appendToFile ( $appendFileName, $string )
{
  @ $fp = fopen("$appendFileName", 'a+');    // Open for Appending
  if ( !$fp ) {
    //echo "<p>DEBUG: error opening $appendFileName</p>\n";
    return (1);
  }
  
  // Lock file so two or more will not try to modify it at the
  // same time.
  flock($fp, LOCK_EX);
  
  fwrite($fp, $string);
  fwrite($fp, "\n");
  
   // Unlock file
  flock($fp, LOCK_UN);
  
  @ fclose($fp);
  return (0);
}


/* createHtmlOutput()
 * Creates HTML table showing all table keys (name= in form) and values
 * submitted. 
 * $keys are the form field names
 * $values are the content
 * $required is the array of required keys that were missed
 * Returns table to calling program
 */
function createHtmlOutput ($keys, $values, $required="" )
{
  // stripHTML and tagsAllowed globals are set in the slisform_config.inc file.
  global $stripHTML;
  global $tagsAllowed;
  global $tableWidth;
  $output_data = "";
  
  $output_data .= "<div style=\"width: 600px;\">\n";

  $output_data .= "<fieldset style=\"color: #6B6B6B; font-weight: bold; border: 0; background-color: #fff;\">\n";
  
  $output_data .= "<legend></legend>\n";

  if ( $tableWidth != "" ) {
    $output_data .= "<table cellpadding=\"3\" cellspacing=\"5\" style=\"border-collapse: collapse; width: $tableWidth;\" >\n";
  } else {
    $output_data .= "<table cellpadding=\"3\" cellspacing=\"5\" style=\"border-collapse: collapse;\" >\n";
  }
  
  $output_data .= "<colgroup span=\"1\" style=\"background-color: #fff; \"></colgroup>\n";

  for ( $i = 0; $i < count ($keys); $i++ ) {
    //$values[$i] = eregi_replace ("\n", "<br />", $values[$i]);

    if ( $stripHTML ) {
      $values[$i] = strip_tags ($values[$i], $tagsAllowed);
    }

    if ( in_array($keys[$i], $required) ) {
      $output_data .= "<tr><td style=\"color: red; width: 36%; border: 0;\">*".$keys[$i].": </td>\n<td style=\"border: 0;color: #6B6B6B;\">&nbsp;</td></tr>\n";
    } else {
        $output_data .= "<tr><td style=\"width: 36%; border:0;\">".$keys[$i].": </td>\n<td style=\"border: 0; color: #6B6B6B;\">".$values[$i]."</td></tr>\n";
    }
  }

  $output_data .= "</table></fieldset>\n</div>";

  return $output_data;
}

/* createHeading() */
function createHeading()
{
   $heading =<<<EOT
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
     <head>
     <title>Form Reply</title>
     <meta http-equiv="content-language" content="en" />
     <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style type="text/css">
    body {
      font-family: Verdana,Arial,sans-serif;
      font-size: small;
      color: #6B6B6B;
      background: #fff;
    }
    </style>
     </head>
    <body>
EOT;

 return $heading;
}

/* createFooter () */
function createFooter()
{
   $footer = "</body></html>";
   return $footer;
}

/* get_date_now takes current time in UNIX format and
 * returns formatted date
 */
function get_date_now ( $mydate )
{
  // set timezone
  putenv('TZ=PST8PDT');
  if ( $mydate ) {
    $unix_now = $mydate;
  } else {
    $unix_now = date("U");
  }
  // timestamp is Unix time (since Jan. 1, 1970)
  $date_now = date('Y-m-d', $mydate);

  // RETURN DATE TODAY
  return $date_now;
}

/* get_time_now takes a Unix timestamp for current time and
 * returns the formatted time. Note (need to generalize to any zone).
 */
function get_time_now ( $mydate )
{
  // set timezone 
  putenv('TZ=PST8PDT');
  if ( $mydate ) {
    $unix_now = $mydate;
  } else {
    $unix_now = date("U");
  }

  // The following should work. Time stored is Unix timestamp. hhe, 3/24/08
  $time_now = date('H:i:s', $mydate);

  // RETURN TIME NOW
  return $time_now;
}

?>
