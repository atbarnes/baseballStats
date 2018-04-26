<?php
    //Get variables from the batting, fielding, or pitching page
    $location = $_GET['location']; 
    $id = $_GET['id'];
    $action = $_GET['action'];
    $option = $_GET['option'];
    $yearid = $_GET['yearid'];
    $data = array($id);
    print'<a class="admin" href="info.php?location=' . $location . '&action=delete&id=' . $id .'">Delete Mode</a>' . '<br><br>';
    print'<a class="admin" href="info.php?location=' . $location . '&action=insert&id=' . $id .'">Insert Mode</a>';
    print "<br><br>";
    include "top.php";
    
    //If batting page, display batting info of player
    if($location === 'batting')
    {   
        //If option to delete is yes, delete the record
        if($option === 'yes' && $yearid != '')
        {
            $data[] = $yearid; 
            $query = 'DELETE FROM tblBatting ';
            $query .= 'WHERE fnkPlayerId = ? ';
            $query .= 'AND fnkYearId = ?';
            
            $results = $thisDatabaseWriter->delete($query, $data, 1, 1);
            print '<h3>RECORD DELETED<h3>';
            
        }
        //Used for insert, if it worked
        if(isset($_POST["btnSubmit"])){
        
        $txtYear = htmlentities($_POST["txtYear"], ENT_QUOTES, "UTF-8");
        if ($txtYear !== ''){
            $data[] = $txtYear;
        }    
            
        $txtFirstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
        if ($txtFirstName !== ''){
            $data[] = $txtFirstName;
        }
        $txtLastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
        if($txtLastName !== ''){
           $data[] = $txtLastName;
        }
        $txtGamesPlayed = htmlentities($_POST["txtGamesPlayed"], ENT_QUOTES, "UTF-8");
        if ($txtGamesPlayed !== ''){
            $data[] = $txtGamesPlayed;
        }
        $txtAtBats = htmlentities($_POST["txtAtBats"], ENT_QUOTES, "UTF-8");
        if ($txtAtBats !== ''){
            $data[] = $txtAtBats;
        }
        $txtRuns = htmlentities($_POST["txtRuns"], ENT_QUOTES, "UTF-8");
        if ($txtRuns !== ''){
            $data[] = $txtRuns;
        }
        $txtHits = htmlentities($_POST["txtHits"], ENT_QUOTES, "UTF-8");
        if ($txtHits !== ''){
            $data[] = $txtHits;
        }
        $txtAverage = htmlentities($_POST["txtAverage"], ENT_QUOTES, "UTF-8");
        if ($txtAverage !== ''){
            $data[] = $txtAverage;
        }
        $txtHomerun = htmlentities($_POST["txtHomerun"], ENT_QUOTES, "UTF-8");
        if ($txtHomerun !== ''){
            $data[] = $txtHomerun;
        }
        $txtRBI = htmlentities($_POST["txtRBI"], ENT_QUOTES, "UTF-8");
        if ($txtRBI !== ''){
            $data[] = $txtRBI;
        }
        $txtOBP = htmlentities($_POST["txtOBP"], ENT_QUOTES, "UTF-8");
        if ($txtOBP !== ''){
            $data[] = $txtOBP;
        }
        $txtDoubles = htmlentities($_POST["txtDoubles"], ENT_QUOTES, "UTF-8");
        if ($txtDoubles !== ''){
            $data[] = $txtDoubles;
        }
        $txtTriples = htmlentities($_POST["txtTriples"], ENT_QUOTES, "UTF-8");
        if ($txtTriples !== ''){
            $data[] = $txtTriples;
        }
        $txtStolen = htmlentities($_POST["txtStolen"], ENT_QUOTES, "UTF-8");
        if ($txtStolen !== ''){
            $data[] = $txtStolen;
        }
        $txtCaught = htmlentities($_POST["txtCaught"], ENT_QUOTES, "UTF-8");
        if ($txtCaught !== ''){
            $data[] = $txtCaught;
        }
        $txtWalks = htmlentities($_POST["txtWalks"], ENT_QUOTES, "UTF-8");
        if ($txtWalks !== ''){
            $data[] = $txtWalks;
        }
        $txtStrikeout = htmlentities($_POST["txtStrikeout"], ENT_QUOTES, "UTF-8");
        if ($txtStrikeout !== ''){
            $data[] = $txtStrikeout;
        }
        $txtIBB = htmlentities($_POST["txtIBB"], ENT_QUOTES, "UTF-8");
        if ($txtIBB !== ''){
            $data[] = $txtIBB;
        }
        $txtHBP = htmlentities($_POST["txtHBP"], ENT_QUOTES, "UTF-8");
        if ($txtHBP !== ''){
            $data[] = $txtHBP;
        }
        $txtSacHits = htmlentities($_POST["txtSacHits"], ENT_QUOTES, "UTF-8");
        if ($txtSacHits !== ''){
            $data[] = $txtSacHits;
        }
        $txtSacFlys = htmlentities($_POST["txtSacFlys"], ENT_QUOTES, "UTF-8");
        if ($txtSacFlys !== ''){
            $data[] = $txtSacFlys;
        }
        $txtDoublePlays = htmlentities($_POST["txtDoublePlays"], ENT_QUOTES, "UTF-8");
        if ($txtDoublePlays !== ''){
            $data[] = $txtDoublePlays;
        }
        
        $query = 'INSERT into tblBatting SET';
        $query .= ' fnkPlayerId = ?, ';
        $query .= ' fnkYearId = ?, ';
        $query .= ' fldAtBats = ?, ';
        $query .= ' fldRuns = ?, ';
        $query .= ' fldHits = ?, ';
        $query .= ' fldAverage = ?, ';
        $query .= ' fldHomeruns = ?, ';
        $query .= ' fldRbis = ?, ';
        $query .= ' fldObp = ?, ';
        $query .= ' fldDoubles = ?, ';
        $query .= ' fldTriples = ?, ';
        $query .= ' fldStolen = ?, ';
        $query .= ' fldCaught = ?, ';
        $query .= ' fldWalks = ?, ';
        $query .= ' fldStrikeouts = ?, ';
        $query .= ' fldIntentional = ?, ';
        $query .= ' fldHbp = ?, ';
        $query .= ' fldSh = ?, ';
        $query .= ' fldSf = ?, ';
        $query .= ' fldGidp = ?';
        
        $results = $thisDatabaseWriter->testquery($query, $data);
        $results = $thisDatabaseWriter->insert($query, $data);
        
        if($results != '')
        {
          print '<h3>RECORD INSERTED</h3>';  
        }
        
      }
        
        //If delete mode, and link clicked, confirm that they want to delete
        if ($action === 'delete' && $yearid != '')
        {
            
            print "Are you sure you want to delete this entry?\n";
            print'<a href="info.php?location=' . $location . '&option=yes&id=' . $id . '&yearid=' . $yearid . '">Yes</a>' . "\n \n"; 
            print'<a href="info.php?location=' . $location . '&option=no&id=' . $id . '&yearid=' . $yearid . '">No</a>';    
        }
        
        //Get's all the players individual information
        $query = 'SELECT fnkPlayerId, fldBirthMonth, fldBirthDay, fldBirthYear, ';
        $query .= 'fnkYearId, fldFirstName, fldLastName, ';
        $query .= 'fldBats, fldThrows, fldGames, fldAtBats, fldRuns, ';
        $query .= 'fldHits, fldAverage, fldHomeruns, fldRbis, ';
        $query .= 'fldObp, fldDoubles, fldTriples, fldStolen, ';
        $query .= 'fldCaught, fldWalks, fldStrikeouts, fldIntentional, ';
        $query .= 'fldHbp, fldSh, fldSf, fldGidp ';
        $query .= 'FROM tblBatting ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'WHERE fnkPlayerId = ?';
        
        
        $batting = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
        
        //Prints general player information
        print '<h3>' . $batting[0]['fldFirstName'] . ' '. $batting[0]['fldLastName'] . '</h3>';
        print '<h4>Born: ' . $batting[0]['fldBirthMonth'] . "/" . $batting[0]['fldBirthDay'] . "/" . $batting[0]['fldBirthYear']. '</h4>';
        print '<h4>Bats: ' . $batting[0]['fldBats'] . '</h4>';
        print '<h4>Throws: ' . $batting[0]['fldThrows'] . '</h4><br>';
        if($action === 'delete'){
            print '<h4>Click a year below to delete it</h4>';
        }
        //If insert mode, print the form to enter information
        if($action === 'insert'){
            
        //Insert fields into batting table (DOESNT WORK RIGHT NOW)
        print '<h4>Type the information in the table below and hit submit!</h4>';
        print "<form action=info.php?location=batting&id=" . $id .
                 "method='get'
                 id='frmRegister'>";
        print '<input class="button" type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="100" class="button">';
        }
        print '<table>';
        if($action === 'insert'){
         print '<th><input class="text" type="text" id="txtYear" name="txtYear"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
             
                <th><input class="text" type="text" id="txtFirstName" name="txtFirstName"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><input class="text" type="text" id="txtLastName" name="txtLastName"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th>
                <input class="text" type="text" id="txtGamesPlayed" name="txtGamesPlayed"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th>
                <input class="text" type="text" id="txtAtBats" name="txtAtBats"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th>
                <input class="text" type="text" id="txtRuns" name="txtRuns"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th>
                <input class="text" type="text" id="txtHits" name="txtHits"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
            
                <input class="text" type="text" id="txtAverage" name="txtAverage"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
            
                <input class="text" type="text" id="txtHomeruns" name="txtHomeruns"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtRBI" name="txtRBI"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtOBP" name="txtOBP"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtDoubles" name="txtDoubles"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtTriples" name="txtTriples"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtStolen" name="txtStolen"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtCaught" name="txtCaught"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtWalks" name="txtWalks"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtStrikeout" name="txtStrikeout"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
                <input class="text" type="text" id="txtIBB" name="txtIBB"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
            
                <input class="text" type="text" id="txtSacHits" name="txtSacHits"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
            
                <input class="text" type="text" id="txtSacFlys" name="txtSacFlys"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th>
            <input class="text" type="text" id="txtDoublePlays" name="txtDoublePlays"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
                <th>
            
                <input class="text" type="text" id="txtHBP" name="txtHBP"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>'
    ;
      }
        //Print table headers
        print "<tr>\n<th>Year</th>\n<th>First Name</th>\n<th>Last Name</th>\n
        <th>Games Played</th>\n<th>ABs</th>\n
        <th>Runs</th>\n<th>Hits</th>\n<th>AVG</th>\n
        <th>HR</th>\n<th>RBI</th>\n<th>OBP</th>
        <th>Doubles</th>\n<th>Triples</th>\n<th>SB</th>\n<th>CS</th>\n
        <th>BB</th>\n<th>SO</th>\n<th>IBB</th>\n
        <th>HBP</th>\n<th>Sac Hits</th>\n<th>Sac Flys</th>\n
        <th>Double Plays</th>\n</tr>\n";
        
        //If delete mode, print every first and last name with a link to delete
        if ($action === 'delete')
        {
        foreach ($batting as $player) {
        print "<tr><td><a href='info.php?location=batting" . "&id=" . $id . "&action=delete&yearid=". $player['fnkYearId'] . "'>" . $player['fnkYearId'] 
        . "</a></td>\n<td>". $player['fldFirstName'] . "</td>\n<td>"
        . $player['fldLastName'] ."</td>\n<td>" . $player['fldGames'] . "</td>\n<td>" . $player['fldAtBats'] .
        "</td>\n<td>" . $player['fldRuns'] . "</td>\n<td>" . $player['fldHits'] .
        "</td>\n<td>" . $player['fldAverage'] . "</td>\n<td>" . $player['fldHomeruns'] .
        "</td>\n<td>" . $player['fldRbis'] . "</td>\n<td>" . $player['fldObp'] .
        "</td>\n<td>" . $player['fldDoubles'] . "</td>\n<td>" . $player['fldTriples'] . "</td>\n<td>" . $player['fldStolen'] .        
        "</td>\n<td>" . $player['fldCaught'] . "</td>\n<td>" . $player['fldWalks'] .
        "</td>\n<td>" . $player['fldStrikeouts'] . "</td>\n<td>" . $player['fldIntentional'] .
        "</td>\n<td>" . $player['fldHbp'] . "</td>\n<td>" . $player['fldSh'] . "</td>\n<td>" . 
        $player['fldSf'] . "</td>\n<td>" . $player['fldGidp'] . "</td>\n</tr>\n";
    } 
        }
        
        //Else, just print the individual stats for the player
        else{
        foreach ($batting as $player) {
        print "<tr><td>" . $player['fnkYearId'] . "</td>\n<td>". $player['fldFirstName'] . "</td>\n<td>"
        . $player['fldLastName'] ."</td>\n<td>" . $player['fldGames'] . "</td>\n<td>" . $player['fldAtBats'] .
        "</td>\n<td>" . $player['fldRuns'] . "</td>\n<td>" . $player['fldHits'] .
        "</td>\n<td>" . $player['fldAverage'] . "</td>\n<td>" . $player['fldHomeruns'] .
        "</td>\n<td>" . $player['fldRbis'] . "</td>\n<td>" . $player['fldObp'] .
        "</td>\n<td>" . $player['fldDoubles'] . "</td>\n<td>" . $player['fldTriples'] . "</td>\n<td>" . $player['fldStolen'] .        
        "</td>\n<td>" . $player['fldCaught'] . "</td>\n<td>" . $player['fldWalks'] .
        "</td>\n<td>" . $player['fldStrikeouts'] . "</td>\n<td>" . $player['fldIntentional'] .
        "</td>\n<td>" . $player['fldHbp'] . "</td>\n<td>" . $player['fldSh'] . "</td>\n<td>" . 
        $player['fldSf'] . "</td>\n<td>" . $player['fldGidp'] . "</td>\n</tr>\n";
    }
        }
    print '</table>';
    if ($action === $insert)
    {
        print '</form>';
    
    }
    }
    //If player came from pitching page, print pitching info
    if($location === 'pitching')
    {
        //Get's individual pitching stats
        $query = 'SELECT fnkPlayerId, fldBirthMonth, fldBirthDay, fldBirthYear, fldYearId, ';
        $query .= 'fldBats, fldThrows, fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'fldGames, fldGamesStarted, fldWins, ';
        $query .= 'fldLose, fldERA, fldWhip, fldComplete, ';
        $query .= 'fldShutout, fldSaves, fldInning, fldHits, ';
        $query .= 'fldAverage, fldIntentional, fldWild, fldHBP, ';
        $query .= 'fldBalks, fldBattersFaced, fldGamesFinished, fldRuns, ';
        $query .= 'fldSacrificeH, fldSacrificeF, fldDoubleplays ';
        $query .= 'FROM tblPitching ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'WHERE fnkPlayerId = ?';
        
        $pitching = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
        
        //Prints general information of the pitcher
        print '<h3>' . $pitching[0]['fldFirstName'] . ' '. $pitching[0]['fldLastName'] . '</h3>';
        print '<h4>Born: ' . $pitching[0]['fldBirthMonth'] . "/" . $pitching[0]['fldBirthDay'] . "/" . $pitching[0]['fldBirthYear']. '</h4>';
        print '<h4>Bats: ' . $pitching[0]['fldBats'] . '</h4>';
        print '<h4>Throws: ' . $pitching[0]['fldThrows'] . '</h4>';
        
        //Prints the table headers
        print '<table>';
        print "<tr>\n<th>Year</th>\n<th>First Name</th>\n<th>Last Name</th>\n
        <th>Games Played</th>\n<th>Games Started</th>\n<th>Wins</th>\n
        <th>Loses</th>\n
        <th>ERA</th>\n<th>WHIP</th>\n<th>Complete Games</th>\n
        <th>Shutout</th>\n<th>Saves</th>\n<th>Innings</th>
        <th>Hits</th>\n<th>Opponent Average</th>\n<th>Intentional Walks</th>\n<th>Wild Pitches</th>\n
        <th>HBP</th>\n<th>Balks</th>\n<th>Batters Faced</th>\n
        <th>Games Finished</th>\n<th>Runs</th>\n<th>Sac Hits</th>\n
        <th>Sac Flys</th>\n<th>Double Plays</th>\n</tr>\n";
        
        //Prints the individual pitching stats
        foreach ($pitching as $player) {
        print "<tr><td>" . $player['fldYearId'] . "</td>\n<td>" . $player['fldFirstName'] . "</td>\n<td>" . 
        $player['fldLastName'] . "</td>\n<td>" . 
        $player['fldGames'] . "</td>\n<td>" . $player['fldGamesStarted'] .
        "</td>\n<td>" . $player['fldWins'] . "</td>\n<td>" . $player['fldLose'] .
        "</td>\n<td>" . $player['fldERA'] . "</td>\n<td>" . $player['fldWhip'] .
        "</td>\n<td>" . $player['fldComplete'] . "</td>\n<td>" . $player['fldShutout'] .
        "</td>\n<td>" . $player['fldSaves'] . "</td>\n<td>" . $player['fldInning'] . "</td>\n<td>" . $player['fldHits'] .        
        "</td>\n<td>" . $player['fldAverage'] . "</td>\n<td>" . $player['fldIntentional'] .
        "</td>\n<td>" . $player['fldWild'] . "</td>\n<td>" . $player['fldHBP'] .
        "</td>\n<td>" . $player['fldBalks'] . "</td>\n<td>" . $player['fldBattersFaced'] . "</td>\n<td>" . 
        $player['fldGamesFinished'] . "</td>\n<td>" . $player['fldRuns'] . "</td>\n<td>" .
        $player['fldSacrificeH'] . "</td>\n<td>" . $player['fldSacrificeF'] . "</td>\n<td>" . 
        $player['fldDoubleplays'] . "</td>\n" . "</tr>\n";
    }
    
    print '</table>';
    }
    //If player came from fielding page, print fielding stats
    if($location === 'fielding')
    {
        //Query for individual fielding statistics
        $query = 'SELECT fnkPlayerId, fldBirthMonth, fldBirthDay, fldBirthYear, fldYearId, ';
        $query .= 'fldBats, fldThrows, fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'fldGames, fldGamesStarted, fldInningOuts, ';
        $query .= 'fldPutouts, fldAssists, fldErrors, fldDoubleplays, ';
        $query .= 'fldPassedballs, fldWildPitch, fldStolenBases, fldCaughtStealing, ';
        $query .= 'fldZone FROM tblFielding ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'WHERE fnkPlayerId = ?';
        
        $fielding = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
        
        //Prints general information
        print '<h3>' . $fielding[0]['fldFirstName'] . ' '. $fielding[0]['fldLastName'] . '</h3>';
        print '<h4>Born: ' . $fielding[0]['fldBirthMonth'] . "/" . $fielding[0]['fldBirthDay'] . "/" . $fielding[0]['fldBirthYear']. '</h4>';
        print '<h4>Bats: ' . $fielding[0]['fldBats'] . '</h4>';
        print '<h4>Throws: ' . $fielding[0]['fldThrows'] . '</h4>';
        
        print '<table>';
        
        //Prints table headers
        print "<tr>\n<th>Year</th>\n<th>First Name</th>\n<th>Last Name</th>\n
        <th>Games Played</th>\n<th>Games Started</th>\n<th>Inning Outs</th>\n
        <th>Putouts</th>\n
        <th>Assists</th>\n<th>Errors</th>\n<th>Double Plays</th>\n
        <th>Passed balls</th>\n<th>Wild Pitches</th>\n<th>Stolen Bases</th>
        <th>Caught Stealing</th>\n<th>Zone</th>\n</tr>\n";
    
        //Prints fielding stats
        foreach ($fielding as $player) {
        print "<tr><td>" . $player['fldYearId'] . "</td>\n<td>" .  $player['fldFirstName'] . "</td>\n<td>" . 
        $player['fldLastName'] . "</td>\n<td>" . 
        $player['fldGames'] . "</td>\n<td>" . $player['fldGamesStarted'] .
        "</td>\n<td>" . $player['fldInningOuts'] . "</td>\n<td>" . $player['fldPutouts'] .
        "</td>\n<td>" . $player['fldAssists'] . "</td>\n<td>" . $player['fldErrors'] .
        "</td>\n<td>" . $player['fldDoubleplays'] . "</td>\n<td>" . $player['fldPassedballs'] .
        "</td>\n<td>" . $player['fldWildPitch'] . "</td>\n<td>" . $player['fldStolenBases'] .        
        "</td>\n<td>" . $player['fldCaughtStealing'] . "</td>\n<td>" . $player['fldZone'] .
        "</td>\n</tr>\n";
        }
        
        print '</table>';
    }
    
    
  
    
 ?>

