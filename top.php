<?php
include "lib/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Google Link text so put something relevant here</title>
        <meta charset="utf-8">
        <meta name="author" content="Alex Barnes">
        <meta name="description" content="Baseball Stats Site">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="style.css" type="text/css" media="screen">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. 
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

        print "<!-- require Database.php -->";

        require_once(BIN_PATH . '/Database.php');

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //
        // generally you dont need the admin on the web

        print "<!-- make Database connections -->";
        $dbUserName = get_current_user() . '_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);
        ?>	

    </head>

    <!-- **********************     Body section      ********************** -->
<?php
//Function to find first and last name
function ldapName($uvmID) {
    if (empty($uvmID))
        return "no:netid";

    $name = "not:found";

    $ds = ldap_connect("ldap.uvm.edu");

    if ($ds) {
        $r = ldap_bind($ds);
        $dn = "uid=$uvmID,ou=People,dc=uvm,dc=edu";
        $filter = "(|(netid=$uvmID))";
        $findthese = array("sn", "givenname");

        // now do the search and get the results which are stored in $info
        $sr = ldap_search($ds, $dn, $filter, $findthese);

        // if we found a match (in this example we should actually always find just one
        if (ldap_count_entries($ds, $sr) > 0) {
            $info = ldap_get_entries($ds, $sr);
            $name = $info[0]["givenname"][0] . ":" . $info[0]["sn"][0];
        }
    }

    ldap_close($ds);

    return $name;
}

$username = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
/*
$StudentName = ldapName($username);
$namearray = explode(':', $StudentName);
$StudentFirstName = $namearray[0];
$StudentLastName = $namearray[1];
$emailRecord = array($username);
$emailQuery = 'SELECT pmkEmail FROM tblAdmin WHERE pmkEmail = ?';
$top = $thisDatabaseReader->select($emailQuery, $emailRecord, 1, 0, 0, 0, false, false);
print'<a class="admin" href="spec.pdf">Spec Document</a>';
print '<body id="' . $PATH_PARTS['filename'] . '">';
if ($top === '')
{
    print'<a class="admin" href="admin.php">Admin Registration</a>';
}
 */
include "header.php";
//print'<h3 class="login">'. 'Hi ' . $StudentFirstName . '!' . '</h3>';
include "nav.php";
?>