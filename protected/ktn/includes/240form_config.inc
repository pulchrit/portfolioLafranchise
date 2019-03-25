<?php 
/* 240form_config.inc
* Configuration file to use with 240form_handler.php
* Date created: 25 July 2008
* Last modified: 3 March 2009 to be used with version 1.2 of 240form_handler.php
*
* Demo form handler for libr240 course at SJSU School of Library & Info. Science
*
* Copyright 2008-2009 Heather Ebey for SJSU SLIS
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
* This form handler package consists of 9 files.
*
* The only files that are needed for a basic form are:
*   HTML form file - You create a standard form page in (X)HTML
*   240form_handler.php - used for processing form
*   240form_config.inc  - You edit this to to configure - 
*     customize / localize the form handler
*
* For simplicity put the about three files in the same directory.
* If you know what you are doing, you can put the 
* 240form_handler.php and 240form_config.inc together in a 
* different directory. Or, you can put the 240form_handler.php in a
* global location and put the form and the 240form_config.inc 
* together in another directory. Doing it this way means multiple forms
* can use the same form handler (stored once on the system), where each 
* form, 240form_config.inc and the output.txt (or whatever you name the
* output file) are placed together in a subdirectory.
* 
*  1. 240form_handler.php - The form handler itself.
*     Does the form processing. Use it in the action part of the HTML
*     file that contains the form: 
*          form id="someid" name="somename" method="post"     action="240form_handler.php" 
*        Do NOT edit the 240form_handler.php file unless you know PHP.
*     2. 240form_config.inc - The form handler configuration file
*         The 240form_config.inc is where you customize -- the 
*          configuration file -- the actions performed by the form
*         handler 240form_handler.php.
*     3. 240form_example.html - example of using the 
*        240form_handler.php with default settings in the same 
*        directory as the form.
*     4. 240form_readme.txt - how to use the form (this file)
*     5. output.txt - output file to save the data to in addition 
*        to or instead of emailing it to the form creator.
*     6. form_confirm.php - Optional file to configure to
*        wrap reply page in style of web site
*     7. 240form_fullexample.shtml - example using advanced features
*     8. 240form_fullconfig.inc - used with 240form_fullexample.shtml
*     9. 240form_style.css - not needed. Used in the example.   
* 
*/

  /* 0.
   * displayErrors is set to 0 by default. If you need to debug 
   * the code and see what is happening, set it to 1. 
   *  Absolutely NEVER set this to 1 in a production
   *  environment if you use this code in production. 
   *  The displayErrors will give the end-user too much information 
   *   and may make it easier for someone to hack your
   * site.
   */
  
  $displayErrors = 0;

/* 1.
  * formPath = "path to form";
  * If it is set, it will be used to find the location of the 
  * $saveDataFilename. The $formPath must relative to the
  * form handler and tells it the path where the form output
  * file is kept.
  * You need this only if you are using the 240form_handler.php
  * in a directory other than the same directory as the form and
  * the config file. This is the preferred way to use this form.
  * Place it once in the system and use the 240form_config.inc
  * file in the same directory as the form to do local configuration.
  * Default: formPath = "./"; (means form output file and handler
  *  are in the same directory)
  */
  
  $formPath = "./";


/* ***REQUIRED FIELDS configuration section */
  
  /* 2.
  * $allFields = ""; (default)
  * THIS IS A REQUIRED FIELD IF there are any radio, checkbox, or select menus
  * in the form.
  * All fields in form. This will make it possible to check for
  * checkboxes and radio buttons that are not set and should be set.
  * Example: $allFields = "lastname,firstname,email,best_use,comment";
  * NOTE: be vary careful not to introduce spaces or carriage returns
  * make the field names comma separated and DO NOT put a space after the comma
  * in the string. It can softwrap, but no hardwrap (enter or return key)
  */
  
  $allFields = "name,emailaddress,phone,preferredcontact,kids,pets,fosterpreferences,comments";


   /* 3.
  * $requiredFields = ""; (default)
  * REQUIRED FIELDS.
  * To designate a field as required, add it below in a comma separated list.
  * Example: $requiredFields = "aviname,reaction,visited";
  */

  $requiredFields = "name,phone";
  
  /* 3b
   * Default: $ignoreFields = "submit,reset"; 
   * Use this to remove fields (like submit), that the form handler may pick up.
   */
   
  $ignoreFields = "submit,reset";

 /* 4.
  * $errorMessage is displayed on screen at top of the error page 
  * if all of the required fields are not completed. It can
  * have html code, but be careful about quotes. PHP requires
  * that quotes are escaped with \ as below. Example:
  * $errorMessage = "<span style=\"color: red; font-size: 1.3em; font-weight: bold;\">Error - form not submitted.</span>
  * 
  */

  $errorMessage = "<span style=\"color: #0f0; font-size: 1.3em; font-weight: bold;\">Error - form not saved.</span><br />Some required fields were not completed.<br>You must fill in all the required fields.<br />Use the browser <em>back</em> arrow or the button below to return to the form.";


 /* NOTE: COLLECTING FORM RESPONSES -  Email or output file or both?
  * You can set $saveData = 1; to have the submitted data stored in a 
  * file on the server.
  * Or, you can set $emailData = 1; to have it mailed to 
  * yourself or the person who is collecting the form data.
  * Or, you can set both and have data both emailed and stored on the server.
  */ 


/* ***OUTPUT FILE configuration section */

 /* 5.
  * Set $saveData = 1; (default) to save the data to an output file; otherwise, set
  *  $saveData = 0; if you do not want to use an output file.
  * Be careful not to add a space before or after the filename with in the quotes.
  * Obviously, for a form to be useful, you need to set either $saveData = 1;
  *  or $emailData = 1; and $emailDateTo = "some email address"; (see below)
  */
   
  $saveData = 0;
   
 /* 6.
  * Data output file: $saveDataFilename is name of output file. 
  * Default: $saveDataFilename = 'output.txt';
  * It must have permissions 666 (rw-rw-rw-) on Senna.
  * It must be created BEFORE you process the form and must be in the 
  *     SAME directory as the form handler: 240form_handler.php.
  * Unix: touch file_name, where file_name is whatever you 
  *     use in $saveDataFilename
  */
  
   $saveDataFilename = 'output.txt';
   
  /* 7.
   * $dataSeparator is how data from each form will be separated in the
   * output file. Pipe symbol '|' (default); comma ',', or tab "\t" are common
   */
   
   $dataSeparator = '|';
   
 
/* ***EMAIL configuration section. 
 * Part 1, send data to person collecting data. 
 * Part 2, send data to person who submitted the form.
 */


// Part 1 FORM SUBMITTED - send data to form owner

/* Sending an acknowledgment to the user. 
 * Decide if you want to send email or display the results only on the screen.
 * You can set $sendResponse = 1; to have the submitted data sent to the person
 *  who filled out the form. IMPORTANT: If you do this, you must also have
 *  a REQUIRED field for the email address on your form to collect 
 *  their email address.
 */ 
 
 
 /* 8.
  * Send email to ---person collecting the data---.
  *  set the $emailData = 1; to email the data to the person collecting it; 
  *  otherwise, set it $emailData = 0; (zero) (default).
  *  These are numbers. Do NOT put them in quotes.
  *  You can both save data to a file and email the data one form at a time.
  * ***WARNING*** if you set $emailData = 1, then you MUST set  $emailDataTo
  *
  */

	$emailData = 1;

 /* 9.
  * Set $emailDataTo to email addresses that will receive the form data
  * Default $emailDataTo = "";
  * If you want more than one addressee, insert all of them using a comma to 
  * separate them like the following example:
  * emailDataTo = "Mary Smith <MarySmith@hotmail.com>, Tom Jones <tj@somedomain.org>";
  * Alternately, you can send email to one of two people collecting data based on
  * the setting of a radio button. Set $emailDataTo = "" and then set 
  * $emailDataTo1 = "email for first radio button if selected"
  * AND $emailDataTo2 = "email for second radio button if selected"
  */

	$emailDataTo = "Melissa Lafranchise <pulchrit@gmail.com>";
	$emailDataTo1 = "";
	$emailDataTo2 = "";

 /* 9b.
  * Set $emailToFieldAlternate to the form field to check when determining which person of 
  * two should get the email. The $emailToFieldAlternate should be set to a radio button
  * group that has 2 states only. Code will send email to the $emailDataTo1 above in
  * if the first radio button is selected by the person submitting the form, 
  * or email is sent to $emailDataTo2 if the second radio button is selected.
  * 
  */
       $emailToFieldAlternate = "";
       $connectEmailTo1 = "";
       $connectEmailTo2 = "";
      
 /* 10.
  * subject line in email sent to both the person submitting 
  *  the data and the data collector 
  * $emailSubject = "--Form submitted--"; (default)
  */
  
	$emailSubject = "--Foster Application submitted--";

// Part 2 FORM SUBMITTED - Send email to person who submitted the form

 /* 11.
  * $sendReply = 0; (default); $sendReply = 1; will cause email to be
  * sent from $emailFrom to value in $submitterEmailField with the subject line
  * $emailSubject (above) and with the $emailMessage in the body, along with 
  * a list of all the form field names and values submitted.
  */
  
  $sendReply = 0;
  
 /* 12.
  * $summitterEmailField is the name of a field in the form that has the 
  * form submitter's email address. 
  * Default: $submitterEmailField = "email"
  * Example: if the form contains <input type="text" name="emailaddress"> 
  * set $submitterEmailField to "emailaddress"; 
  * You MUST also set the email address to a required field in order 
  * for this to work. If this field is set and not  $sendReply,
  * this field will be ignored.
  */

	$submitterEmailField = "emailaddress";

 /* 13.
  * Submitter Names - For more personalized email.
  *	Specify one or more fields to use as form submitter (sendee) name. 
  * Default: $submitterNames = "";
  *	Example: if the form has
  * <input type="text" name="fname" /> and <input type="text" name="lname" /> 
  * then define $submitterNames ="fname, lname". 
  *	Please use a comma between each setting and remember to use " "
  */

	$submitterNames = "";

 /* 14.
  * $emailFrom = ""; (default)
  * Name and email of the person acknowledging receipt of the form.
  * If it is set to an empty string and $sendReply is set to 1, then
  * the system will assign a bogus name - like "NFS Annonymous".
  * example: $emailFrom = "Mary Smith <MarySmith@hotmail.com>";
  * Some may want to use something like do-not-reply@yourdomain.name
  * where domain.name is the real domain of the system that has the form.
  */

	$emailFrom = "Melissa Lafranchise <pulchrit@gmail.com>";

/* 15.
  * $emailMessageSubmitter = "Thank you for submitting the form. Below is what 
  *    you submitted."; (default).
  * Change this to what you want in the body of the email sent to person who submitted the form. 
  * Keep it short. Do NOT use HTML or CSS. It must be ASCII text only.
  */

	$emailMessageSubmitter = "Thank you for applying to foster. Below is a copy of your application.";

// ***FORM SUBMITTED RESPONSE (on screen reply page)
  
 /* 16. 
  * $successMessage - to be displayed on the on screen confirmation page
  * Default:
  * $successMessage = "<span style=\"color: navy; font-size: 1.5em; font-weight: bold; text-align: center;\">Form data submitted.</span>";
  */

//$successMessage = "<span style=\"color: navy; font-size: 1.5em; font-weight: bold; text-align: center;\">Form data submitted.</span>";

	$successMessage = "We have received your application.";
  
 /* 17.
  * displayEnteredData will cause the data to be displayed in a table on
  * the response page that the user sees after a successful submission.
  * Set displayEnteredData = 1; (default) to display the data.
  * Set displayEnteredData = 0; to print only the message in $successMessage.
  */

	$displayEnteredData = 1;


 /* 18.
  * Set stripHTML = 1; if all tags should be stripped using the 
  * PHP strip_tags() function.
  * http://www.php.net/manual/en/function.strip-tags.php
  * Set to 0 if every HTML tag is allowed. Note. This is NOT SECURE.
  * For the best security, set stripHTML = 1; and then specify 
  * the limited set of tags that can be allowed in the following 
  * $tagsAllowed string.
  */

	$stripHTML = 1;

 /* 19.
  * $tagsAllowed specifies which HTML tag is allowed. 
  * Used only if stripHTML is set to 1 
  * Set tagsAllowed to all the tags you will allow. Formatting tags
  * bold <b>, italics <i>, and <br /> are safe.
  * Default: stripHTML = 1; tagsAllowed = "<b><i>";
  */

	$tagsAllowed = "<b><i>";

 /* 20.
  * Settings for files to include to wrap the output
  * of the form confirmation (reply) and error pages.
  * Optional. If you don't use this, you will get 
  * a default reply or error page that does not include your
  * site look and style.
  * Defaults:
  *  $replyURL = "";
  *  $errorURL = "";
  * Examples:
  * $replyURL = "http://somesite.domain/test/form_confirm.php";
  * $errorURL = "http://somesite.domain/test/form_error.php";
  */
  
  $replyURL = "http://senna.sjsu.edu/rdean/mlafranchise/final/form_confirm.php";
  $errorURL = "";

 /* 21.
  * $tableWidth = "600px"; (default) CSS value for style="width: xx";
  * Width in pixels or % of table displayed in both error and reply page.
  * Example: $tableWidth = "90%";
  */
  
  $tableWidth = "600px";

 /* 22.
  * date and time stamps
  * Default: $time_stamp = 1; output will have a date and timestamp.
  */
 $timeStamp = 1;

?>
