<?php
    include "top.php";
    
    //If button submitted, get the query result
    if(isset($_POST["btnSubmit"])){
        //Initialize array and query conditions
        $data = array();
        $Where = false;
        $Having = false;
        $conditions = 0;
        $quotes = 0;
        $symbols = 0;
        $wheres = 0;
      
        //Get the logic operators from the users submission
        $GamesPlayedLogic = htmlentities($_POST["listGamesPlayed"], ENT_QUOTES, "UTF-8");
        $GamesStartedLogic = htmlentities($_POST["listGamesStarted"], ENT_QUOTES, "UTF-8");
        $InningOutsLogic = htmlentities($_POST["listInningOuts"], ENT_QUOTES, "UTF-8");
        $PutoutsLogic = htmlentities($_POST["listPutouts"], ENT_QUOTES, "UTF-8");
        $AssistsLogic = htmlentities($_POST["listAssists"], ENT_QUOTES, "UTF-8");
        $ErrorsLogic = htmlentities($_POST["listErrors"], ENT_QUOTES, "UTF-8");
        $DoublePlaysLogic = htmlentities($_POST["listDoublePlays"], ENT_QUOTES, "UTF-8");
        $PassedLogic = htmlentities($_POST["listPassed"], ENT_QUOTES, "UTF-8");
        $WildLogic = htmlentities($_POST["listWild"], ENT_QUOTES, "UTF-8");
        $StolenLogic = htmlentities($_POST["listStolen"], ENT_QUOTES, "UTF-8");
        $CaughtLogic = htmlentities($_POST["listCaught"], ENT_QUOTES, "UTF-8");
        $ZoneLogic = htmlentities($_POST["listZone"], ENT_QUOTES, "UTF-8");
        
        $FirstNameLogic = '=';
        $LastNameLogic = '=';
        
        //Get each textbox entry from the user
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
        $txtGamesStarted = htmlentities($_POST["txtGamesStarted"], ENT_QUOTES, "UTF-8");
        if ($txtGamesStarted !== ''){
            $data[] = $txtGamesStarted;
            
        }
        $txtInningOuts = htmlentities($_POST["txtInningOuts"], ENT_QUOTES, "UTF-8");
        if ($txtInningOuts !== ''){
            $data[] = $txtInningOuts;
            print "e";
        }
        $txtPutouts = htmlentities($_POST["txtPutouts"], ENT_QUOTES, "UTF-8");
        if ($txtPutouts !== ''){
            $data[] = $txtPutouts;
            
        }
        $txtAssists = htmlentities($_POST["txtAssists"], ENT_QUOTES, "UTF-8");
        if ($txtAssists !== ''){
            $data[] = $txtAssists;
        }
        $txtErrors = htmlentities($_POST["txtErrors"], ENT_QUOTES, "UTF-8");
        if ($txtErrors !== ''){
            $data[] = $txtErrors;
        }
        $txtDoublePlays = htmlentities($_POST["txtDoublePlays"], ENT_QUOTES, "UTF-8");
        if ($txtDoublePlays !== ''){
            $data[] = $txtDoublePlays;
        }
        $txtPassed = htmlentities($_POST["txtPassed"], ENT_QUOTES, "UTF-8");
        if ($txtPassed !== ''){
            $data[] = $txtPassed;
        }
        $txtWild = htmlentities($_POST["txtWild"], ENT_QUOTES, "UTF-8");
        if ($txtWild !== ''){
            $data[] = $txtWild;
        }
        $txtStolen = htmlentities($_POST["txtStolen"], ENT_QUOTES, "UTF-8");
        if ($txtStolen !== ''){
            $data[] = $txtStolen;
        }
        $txtCaught = htmlentities($_POST["txtCaught"], ENT_QUOTES, "UTF-8");
        if ($txtCaught !== ''){
            $data[] = $txtCaught;
        }
        $txtZone = htmlentities($_POST["txtZone"], ENT_QUOTES, "UTF-8");
        if ($txtZone !== ''){
            $data[] = $txtZone;
        }
        //Select each players accumulative career stats
        $query = 'SELECT fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'SUM(fldGames), SUM(fldGamesStarted), SUM(fldWins), ';
        $query .= 'SUM(fldLose), ROUND(AVG(fldERA), 2), ROUND(AVG(fldWhip), 2), SUM(fldComplete), ';
        $query .= 'SUM(fldShutout), SUM(fldSaves), SUM(fldInning), SUM(fldHits), ';
        $query .= 'ROUND(AVG(fldAverage), 3), SUM(fldIntentional), SUM(fldWild), SUM(fldHBP), ';
        $query .= 'SUM(fldBalks), SUM(fldBattersFaced), SUM(fldGamesFinished), SUM(fldRuns), ';
        $query .= 'SUM(fldSacrificeH), SUM(fldSacrificeF), SUM(fldDoubleplays) ';
        $query .= 'FROM tblPitching ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        
        //Function to decide queries based on the operators and variables
        function addquery($c, $varname, $logicname){
        
        $q = ''; 
        $l = $logicname;
        
        if($c != ''){
       
            global $Where, $Having, $wheres, $conditions, $symbols; 
            if($Where == true)
            {
               if($varname === 'fldLastName')
                {
                    $q = ' AND ' . $varname . ' = ?';
                    $Where = true;
                    $conditions++;
                } 
                
            }
            if($Where == false){
                if($varname === 'fldFirstName')
                {
                    $q = ' WHERE ' . $varname . ' = ?';
                    $Where = true;
                    $wheres++;
                }
                
                if($varname === 'fldLastName')
                {
                    $q = ' WHERE ' . $varname . ' = ?';
                    $Where = true;
                    $wheres++;
                }
            }
           
            if($Having == true && $varname != 'fldFirstName' && $varname != 'fldLastName'){
                
                if($l === '=')
                {
                  $q = ' AND ' . $varname . ' = ?';
                  $conditions++;
                }
                if($l === 'greaterthan')
                {
                  $q = ' AND ' . $varname . ' > ?';
                  $symbols++;
                  $conditions++;
                }
                if($l === 'lessthan')
                {
                  $q = ' AND ' . $varname . ' < ?';
                  $symbols++;
                  $conditions++;
                }
                if($l === 'lesserequal')
                {
                  $q = ' AND ' . $varname . ' <= ?';
                  $symbols++;
                  $conditions++;
                }
                if($l === 'greaterequal')
                {
                  $q = ' AND ' . $varname . ' >= ?';
                  $symbols++;
                  $conditions++;
                }
            }
            if($Having == false && $varname != 'fldFirstName' && $varname != 'fldLastName') {
                
                if($l === '=')
                {
                  $q = ' HAVING ' . $varname . ' = ?';
                  $Having = true;
                }
                if($l === 'greaterthan')
                {
                  $q = ' HAVING ' . $varname . ' > ?';
                  $Having = true;
                  $symbols++;
                }
                if($l === 'lessthan')
                {
                  $q = ' HAVING ' . $varname . ' < ?';
                  $Having = true;
                  $symbols++;
                }
                if($l === 'lesserequal')
                {
                  $q = ' HAVING ' . $varname . ' <= ?';
                  $Having = true;
                  $symbols++;
                }
                if($l === 'greaterequal')
                {
                  $q = ' HAVING ' . $varname . ' >= ?';
                  $Having = true;
                  $symbols++;
                }
            }
           
          }
          
          return $q;
        } 
        
        //Add query results to query
        $query .= addquery($txtFirstName,'fldFirstName', $FirstNameLogic);
        $query .= addquery($txtLastName,'fldLastName', $LastNameLogic);
        $query .= ' GROUP BY fnkPlayerId';
        $query .= addquery($txtGamesPlayed,'SUM(fldGames)', $GamesPlayedLogic);
        $query .= addquery($txtGamesStarted,'SUM(fldGamesStarted)', $GamesStartedLogic);
        $query .= addquery($txtInningsOuts,'SUM(fldInningOuts)', $InningOutsLogic);
        $query .= addquery($txtPutouts,'SUM(fldPutouts)', $PutoutsLogic);
        $query .= addquery($txtAssists,'AVG(fldAssists)', $AssistsLogic);
        $query .= addquery($txtErrors,'AVG(fldErrors)', $ErrorsLogic);
        $query .= addquery($txtDoublePlays,'SUM(fldDoubleplays)', $DoublePlaysLogic);
        $query .= addquery($txtPassed,'AVG(fldPassedballs)', $PassedLogic);
        $query .= addquery($txtWild,'SUM(fldWild)', $WildLogic);
        $query .= addquery($txtStolen,'SUM(fldStolenBases)', $StolenLogic);
        $query .= addquery($txtCaught,'SUM(fldCaughtStealing)', $CaughtLogic);
        $query .= addquery($txtZone,'SUM(fldZone)', $ZoneLogic);
        
        $fielding = $thisDatabaseReader->select($query, $data, $wheres, $conditions, $quotes, $symbols, false, false);
    }
    //If no button submission, just print all players and all accumulated stats
    else
    {
        $query = 'SELECT fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'SUM(fldGames), SUM(fldGamesStarted), SUM(fldInningOuts), ';
        $query .= 'SUM(fldPutouts), SUM(fldAssists), SUM(fldErrors), SUM(fldDoubleplays), ';
        $query .= 'SUM(fldPassedballs), SUM(fldWildPitch), SUM(fldStolenBases), SUM(fldCaughtStealing), ';
        $query .= 'SUM(fldZone) FROM tblFielding ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'GROUP BY fnkPlayerId';
        $fielding = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
    }
    print '<body>';
    print '<h3>Fielding</h3>';
    //Form to get query information from user
    print "<form action='pitching.php' 
                 method='post'
                 id='frmRegister'>";
    print '<h4>Get the info you need and hit submit!</h4>';
    print '<input class="button" type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="100" class="button">';
    print '<table>';
    print '<th><input class="text" type="text" id="txtFirstName" name="txtFirstName"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><input class="text" type="text" id="txtLastName" name="txtLastName"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listGamesPlayed"
                name="listGamesPlayed"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtGamesPlayed" name="txtGamesPlayed"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listGamesStarted"
                name="listGamesStarted"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtGamesStarted" name="txtGamesStarted"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listInningOuts"
                name="listInningOuts"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtInningOuts" name="txtInningOuts"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listPutouts"
                name="listPutouts"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtPutouts" name="txtPutouts"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listAssists"
                name="listAssists"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtAssists" name="txtAssists"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listErrors"
                name="listErrors"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtErrors" name="txtErrors"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDoublePlays"
                name="listDoublePlays"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtDoublePlays" name="txtDoublePlays"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listPassed"
                name="listPassed"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtPassed" name="txtPassed"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listWild"
                name="listWild"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtWild" name="txtWild"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listStolen"
                name="listStolen"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtStolen" name="txtStolen"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listCaught"
                name="listCaught"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtCaught" name="txtCaught"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listZone"
                name="listZone"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtZone" name="txtZone"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>';
    
    //Print headers
    print "<tr>\n<th>First Name</th>\n<th>Last Name</th>\n
    <th>Games Played</th>\n<th>Games Started</th>\n<th>Inning Outs</th>\n
    <th>Putouts</th>\n
    <th>Assists</th>\n<th>Errors</th>\n<th>Double Plays</th>\n
    <th>Passed balls</th>\n<th>Wild Pitches</th>\n<th>Stolen Bases</th>
    <th>Caught Stealing</th>\n<th>Zone</th>\n</tr>\n";
    
    //Print each players accumulated statistics
    foreach ($fielding as $player) {
        print "<tr><td><a href='info.php?location=fielding&id=" . $player['fnkPlayerId'] . "'>" . $player['fldFirstName'] . "</td>\n<td><a href='info.php?location=fielding&id=" . 
        $player['fnkPlayerId'] . "'>" . $player['fldLastName'] . "</td>\n<td>" . 
        $player['SUM(fldGames)'] . "</td>\n<td>" . $player['SUM(fldGamesStarted)'] .
        "</td>\n<td>" . $player['SUM(fldInningOuts)'] . "</td>\n<td>" . $player['SUM(fldPutouts)'] .
        "</td>\n<td>" . $player['SUM(fldAssists)'] . "</td>\n<td>" . $player['SUM(fldErrors)'] .
        "</td>\n<td>" . $player['SUM(fldDoubleplays)'] . "</td>\n<td>" . $player['SUM(fldPassedballs)'] .
        "</td>\n<td>" . $player['SUM(fldWildPitch)'] . "</td>\n<td>" . $player['SUM(fldStolenBases)'] .        
        "</td>\n<td>" . $player['SUM(fldCaughtStealing)'] . "</td>\n<td>" . $player['SUM(fldZone)'] .
        "</td>\n</tr>\n";
    }
    
    print '</table>';
    print '</form>';
    print '</body>';

