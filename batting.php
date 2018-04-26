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
        $AtBatsLogic = htmlentities($_POST["listAtBats"], ENT_QUOTES, "UTF-8");
        $RunsLogic = htmlentities($_POST["listRuns"], ENT_QUOTES, "UTF-8");
        $HitsLogic = htmlentities($_POST["listHits"], ENT_QUOTES, "UTF-8");
        $AverageLogic = htmlentities($_POST["listAverage"], ENT_QUOTES, "UTF-8");
        $HomerunLogic = htmlentities($_POST["listHomerun"], ENT_QUOTES, "UTF-8");
        $RBILogic = htmlentities($_POST["listRBI"], ENT_QUOTES, "UTF-8");
        $OBPLogic = htmlentities($_POST["listOBP"], ENT_QUOTES, "UTF-8");
        $DoublesLogic = htmlentities($_POST["listDoubles"], ENT_QUOTES, "UTF-8");
        $TriplesLogic = htmlentities($_POST["listTriples"], ENT_QUOTES, "UTF-8");
        $StolenLogic = htmlentities($_POST["listStolen"], ENT_QUOTES, "UTF-8");
        $CaughtLogic = htmlentities($_POST["listCaught"], ENT_QUOTES, "UTF-8");
        $WalksLogic = htmlentities($_POST["listWalks"], ENT_QUOTES, "UTF-8");
        $StrikeoutLogic = htmlentities($_POST["listStrikeout"], ENT_QUOTES, "UTF-8");
        $IBBLogic = htmlentities($_POST["listIBB"], ENT_QUOTES, "UTF-8");
        $HBPLogic = htmlentities($_POST["listHBP"], ENT_QUOTES, "UTF-8");
        $SacHitsLogic = htmlentities($_POST["listSacHits"], ENT_QUOTES, "UTF-8");
        $SacFlysLogic = htmlentities($_POST["listSacFlys"], ENT_QUOTES, "UTF-8");
        $DoublePlaysLogic = htmlentities($_POST["listDoublePlays"], ENT_QUOTES, "UTF-8");
        
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
        
        //Select each players accumulative career stats
        $query = 'SELECT fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'SUM(fldGames), SUM(fldAtBats), SUM(fldRuns), ';
        $query .= 'SUM(fldHits), ROUND(AVG(fldAverage), 3), SUM(fldHomeruns), SUM(fldRbis), ';
        $query .= 'ROUND(AVG(fldObp), 3), SUM(fldDoubles), SUM(fldTriples), SUM(fldStolen), ';
        $query .= 'SUM(fldCaught), SUM(fldWalks), SUM(fldStrikeouts), SUM(fldIntentional), ';
        $query .= 'SUM(fldHbp), SUM(fldSh), SUM(fldSf), SUM(fldGidp) ';
        $query .= 'FROM tblBatting ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId';
        
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
        $query .= addquery($txtAtBats,'SUM(fldAtBats)', $AtBatsLogic);
        $query .= addquery($txtRuns,'SUM(fldRuns)', $RunsLogic);
        $query .= addquery($txtHits,'SUM(fldHits)', $HitsLogic);
        $query .= addquery($txtAverage,'AVG(fldAverage)', $AverageLogic);
        $query .= addquery($txtHomerun,'SUM(fldHomeruns)', $HomerunLogic);
        $query .= addquery($txtRBI,'SUM(fldRbis)', $RBILogic);
        $query .= addquery($txtOBP,'AVG(fldObp)', $OBPLogic);
        $query .= addquery($txtDoubles,'SUM(fldDoubles)', $DoublesLogic);
        $query .= addquery($txtTriples,'SUM(fldTriples)', $TriplesLogic);
        $query .= addquery($txtStolen,'SUM(fldStolen)', $StolenLogic);
        $query .= addquery($txtCaught,'SUM(fldCaught)', $CaughtLogic);
        $query .= addquery($txtWalks,'SUM(fldWalks)', $WalksLogic);
        $query .= addquery($txtStrikeout,'SUM(fldStrikeouts)', $StrikeoutLogic);
        $query .= addquery($txtIBB,'SUM(fldIntentional)', $IBBLogic);
        $query .= addquery($txtHBP,'SUM(fldHbp)', $HBPLogic);
        $query .= addquery($txtSacHits,'SUM(fldSh)', $SacHitsLogic);
        $query .= addquery($txtSacFlys,'SUM(fldSf)', $SacFlysLogic);
        $query .= addquery($txtDoublePlays,'SUM(fldGidp)', $DoublePlaysLogic);
        
        $batting = $thisDatabaseReader->select($query, $data, $wheres, $conditions, $quotes, $symbols, false, false);
    }
    //If no button submission, just print all players and all accumulated stats
    else
    {
        $query = 'SELECT fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'SUM(fldGames), SUM(fldAtBats), SUM(fldRuns), ';
        $query .= 'SUM(fldHits), ROUND(AVG(fldAverage), 3), SUM(fldHomeruns), SUM(fldRbis), ';
        $query .= 'ROUND(AVG(fldObp), 3), SUM(fldDoubles), SUM(fldTriples), SUM(fldStolen), ';
        $query .= 'SUM(fldCaught), SUM(fldWalks), SUM(fldStrikeouts), SUM(fldIntentional), ';
        $query .= 'SUM(fldHbp), SUM(fldSh), SUM(fldSf), SUM(fldGidp) ';
        $query .= 'FROM tblBatting ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'GROUP BY fnkPlayerId';
        
        $batting = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
    }
    
    print '<body>';
    print '<h3>Batting</h3>';
    //Form to get query information from user
    print "<form action='batting.php' 
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
           <th><select id="listAtBats"
                name="listAtBats"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtAtBats" name="txtAtBats"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listRuns"
                name="listRuns"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtRuns" name="txtRuns"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listHits"
                name="listHits"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtHits" name="txtHits"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listAverage"
                name="listAverage"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtAverage" name="txtAverage"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listHomeruns"
                name="listHomeruns"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtHomeruns" name="txtHomeruns"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listRBI"
                name="listRBI"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtRBI" name="txtRBI"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listOBP"
                name="listOBP"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtOBP" name="txtOBP"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDoubles"
                name="listDoubles"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtDoubles" name="txtDoubles"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listTriples"
                name="listTriples"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtTriples" name="txtTriples"
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
            <th><select id="listCaughtStealing"
                name="listCaughtStealing"
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
            <th><select id="listWalks"
                name="listWalks"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtWalks" name="txtWalks"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listStrikeout"
                name="listStrikeout"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtStrikeout" name="txtStrikeout"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listIBB"
                name="listIBB"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtIBB" name="txtIBB"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listSacHits"
                name="listSacHits"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtSacHits" name="txtSacHits"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listSacFlys"
                name="listSacFlys"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtSacFlys" name="txtSacFlys"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDoublePlays"
                name="listDoublesPlays"
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
                <th><select id="listHBP"
                name="listHBP"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtHBP" name="txtHBP"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>'
    ;
    //Print headers
    print "<tr>\n<th>First Name</th>\n<th>Last Name</th>\n
    <th>Games Played</th>\n<th>ABs</th>\n
    <th>Runs</th>\n<th>Hits</th>\n<th>AVG</th>\n
    <th>HR</th>\n<th>RBI</th>\n<th>OBP</th>
    <th>Doubles</th>\n<th>Triples</th>\n<th>SB</th>\n<th>CS</th>\n
    <th>BB</th>\n<th>SO</th>\n<th>IBB</th>\n
    <th>HBP</th>\n<th>Sac Hits</th>\n<th>Sac Flys</th>\n
    <th>Double Plays</th>\n</tr>\n";
    
    //Print each players accumulated statistics
    foreach ($batting as $player) {
        print "<tr><td><a href='location=batting&id=". $player['fnkPlayerId'] . "'>" . $player['fldFirstName'] . "</td>\n<td><a href='info.php?location=batting&id=" . $player['fnkPlayerId'] . "'>" 
        . $player['fldLastName'] ."</td>\n<td>" . 
        $player['SUM(fldGames)'] . "</td>\n<td>" . $player['SUM(fldAtBats)'] .
        "</td>\n<td>" . $player['SUM(fldRuns)'] . "</td>\n<td>" . $player['SUM(fldHits)'] .
        "</td>\n<td>" . $player['ROUND(AVG(fldAverage), 3)'] . "</td>\n<td>" . $player['SUM(fldHomeruns)'] .
        "</td>\n<td>" . $player['SUM(fldRbis)'] . "</td>\n<td>" . $player['ROUND(AVG(fldObp), 3)'] .
        "</td>\n<td>" . $player['SUM(fldDoubles)'] . "</td>\n<td>" . $player['SUM(fldTriples)'] . "</td>\n<td>" . $player['SUM(fldStolen)'] .        
        "</td>\n<td>" . $player['SUM(fldCaught)'] . "</td>\n<td>" . $player['SUM(fldWalks)'] .
        "</td>\n<td>" . $player['SUM(fldStrikeouts)'] . "</td>\n<td>" . $player['SUM(fldIntentional)'] .
        "</td>\n<td>" . $player['SUM(fldHbp)'] . "</td>\n<td>" . $player['SUM(fldSh)'] . "</td>\n<td>" . 
        $player['SUM(fldSf)'] . "</td>\n<td>" . $player['SUM(fldGidp)'] . "</td>\n</tr>\n";
    }
    
    print '</table>';
    print '</form>';
    print '</body>';












?>
