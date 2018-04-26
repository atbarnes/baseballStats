<?php
include "top.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){  // later you can uncomment the if statement
// }
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$thisURL = $domain . $phpSelf;
print $thisURL;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
$firstName = "";
$lastName = "";
$email = "youremail@uvm.edu";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c. We are keeping track of the
// first mistake we make so we can set autofocus to it.
$firstMistake = "";
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();
// have we mailed the information to the user?
$mailed = false;
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;
    $gender = $_POST["gender"];
    $dataRecord[] = $gender;
    if($_POST["experience"][0] != ''){
        $exp1 = $_POST["experience"][0];
        $dataRecord[] = $exp1;
    }
    if($_POST["experience"][1] != ''){
        $exp2 = $_POST["experience"][1];
        $dataRecord[] = $exp2;
    }
    if($_POST["experience"][2] != ''){
        $exp3 = $_POST["experience"][2];
        $dataRecord[] = $exp3;
    }
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } 
    if ($firstMistake == "" and $emailERROR) {
        $firstMistake = "email";
    }
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } 
    elseif (!ctype_alnum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }
    if ($firstMistake == "" and $firstNameERROR) {
        $firstMistake = "firstname";
    }
    if ($lastName == "") {
        $errorMsg[] = "Please enter your first name";
        $lastNameERROR = true;
    } elseif (!ctype_alnum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra character.";
        $lastNameERROR = true;
    }
    if ($firstMistake == "" and $lastNameERROR) {
        $firstMistake = "lastname";
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        $message="Thank you for registering to purestats.com! We will review your information";
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $subject = "Pure Stats Registration";
        $mailed = mail($to, $subject, $message);
    } // end form is valid
}    // ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>
<article id="main">
    <?php
//####################################
//
    // SECTION 3a. 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit 
        print "<h2>Thank you for providing your information.</h2>";
        print "<p>For your records a copy of this data has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent:</p>";
        print "<p>To: " . $email . "</p>";
        print $message;
        
        $query = 'INSERT INTO tblAdmin SET ';
        $query .= 'pmkEmail = ?, ';
        $query .= 'fldFirstName = ?, ';
        $query .= 'fldLastName = ?';
        if($gender != '')
        {
            $query .= ', fldGender = ?';
        }
        if($exp1 != '')
        {
            $query .= ', fldInfoOne = ?';
        }
        if($exp2 != '')
        {
            $query .= ', fldInfoTwo = ?';
        }
        if($exp3 != '')
        {
            $query .= ', fldInfoThree = ?';
        } 
        $results = $thisDatabaseWriter->insert($query, $dataRecord); 
        
        print '<p>Your records have been saved in our database</p>';
        
    } else {
        print "<h2>Admin Registration</h2>";
        print "<p>Become an Admin today and help us collect more data!</p>";
        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
        if ($errorMsg) {
            print '<div id="errors">' . "\n";
            print "<h2>Your form has the following mistakes that need to be fixed.</h2>\n";
            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print "</div>\n";
        }
        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line ??)
          or the value they typed in (line ??)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>
        <form action="admin.php"
              id="frmRegister"
              method="post">
            <fieldset class="contact">
                <legend>Contact Information</legend>
                <label class="required" for="txtEmail">Email
                    <input <?php
                    if ($firstMistake == "email")
                        print ' autofocus ';
                    if ($emailERROR)
                        print 'class="mistake"';
                    ?>
                        id="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        onfocus="this.select()"
                        placeholder="Enter a valid email address"
                        tabindex="120"
                        type="text"
                        value="<?php print $email; ?>"
                        ><br><br>
                </label>
                <label class="required" for="txtFirstName">First Name
                    <input <?php
                    if ($firstMistake == "firstname" or $firstMistake == "")
                        print ' autofocus ';
                    if ($firstNameERROR)
                        print 'class="mistake"';
                    ?>
                        id="txtFirstName"
                        maxlength="45"
                        name="txtFirstName"
                        onfocus="this.select()"
                        placeholder="Enter your first name"
                        tabindex="100"
                        type="text" 
                        value="<?php print $firstName; ?>"
                        ><br>
                </label>
                <label class="required" for="txtLastName">Last Name
                    <input <?php
                    if ($firstMistake == "lastname" or $firstMistake == "")
                        print ' autofocus ';
                    if ($lastNameERROR)
                        print 'class="mistake"';
                    ?>
                        id="txtLastName"
                        maxlength="45"
                        name="txtLastName"
                        onfocus="this.select()"
                        placeholder="Enter your last name"
                        tabindex="100"
                        type="text" 
                        value="<?php print $lastName; ?>"
                        >
                </label><br><br>
                <label for="gender">Gender<br>
                <input type="radio" name="gender" value="male"> Male<br>
                <input type="radio" name="gender" value="female"> Female<br>
                <input type="radio" name="gender" value="other"> Other<br>
                </label><br>
                <label for="gender">Baseball Experience<br>
                <input type="checkbox" name="experience[]" value="played">I played baseball<br>
                <input type="checkbox" name="experience[]" value="watched">I watched baseball<br>
                <input type="checkbox" name="experience[]" value="love stats">I just love stats<br> 
                </label>
            </fieldset> <!-- ends contact -->
            <fieldset class="buttons">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset> <!-- ends buttons -->
        </form>
        <?php
    } // end body submit
    ?>   
</article>
<?php include "footer.php"; ?>
</body>
</html>