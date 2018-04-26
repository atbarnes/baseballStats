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
        $WinsLogic = htmlentities($_POST["listWins"], ENT_QUOTES, "UTF-8");
        $LosesLogic = htmlentities($_POST["listLoses"], ENT_QUOTES, "UTF-8");
        $ERALogic = htmlentities($_POST["listERA"], ENT_QUOTES, "UTF-8");
        $WHIPLogic = htmlentities($_POST["listWHIP"], ENT_QUOTES, "UTF-8");
        $CompleteLogic = htmlentities($_POST["listComplete"], ENT_QUOTES, "UTF-8");
        $ShutoutLogic = htmlentities($_POST["listShutout"], ENT_QUOTES, "UTF-8");
        $SavesLogic = htmlentities($_POST["listSaves"], ENT_QUOTES, "UTF-8");
        $InningsLogic = htmlentities($_POST["listInnings"], ENT_QUOTES, "UTF-8");
        $HitsLogic = htmlentities($_POST["listHits"], ENT_QUOTES, "UTF-8");
        $OpponentLogic = htmlentities($_POST["listOpponent"], ENT_QUOTES, "UTF-8");
        $IntentionalLogic = htmlentities($_POST["listIntentional"], ENT_QUOTES, "UTF-8");
        $WildLogic = htmlentities($_POST["listWild"], ENT_QUOTES, "UTF-8");
        $HBPLogic = htmlentities($_POST["listHBP"], ENT_QUOTES, "UTF-8");
        $BalksLogic = htmlentities($_POST["listBalks"], ENT_QUOTES, "UTF-8");
        $BattersLogic = htmlentities($_POST["listBatters"], ENT_QUOTES, "UTF-8");
        $GamesFinishedLogic = htmlentities($_POST["listGamesFinished"], ENT_QUOTES, "UTF-8");
        $RunsLogic = htmlentities($_POST["listRuns"], ENT_QUOTES, "UTF-8");
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
        $txtGamesStarted = htmlentities($_POST["txtGamesStarted"], ENT_QUOTES, "UTF-8");
        if ($txtGamesStarted !== ''){
            $data[] = $txtGamesStarted;
        }
        $txtWins = htmlentities($_POST["txtWins"], ENT_QUOTES, "UTF-8");
        if ($txtWins !== ''){
            $data[] = $txtWins;
        }
        $txtLoses = htmlentities($_POST["txtLoses"], ENT_QUOTES, "UTF-8");
        if ($txtLoses !== ''){
            $data[] = $txtLoses;
        }
        $txtERA = htmlentities($_POST["txtERA"], ENT_QUOTES, "UTF-8");
        if ($txtERA !== ''){
            $data[] = $txtERA;
        }
        $txtWHIP = htmlentities($_POST["txtWHIP"], ENT_QUOTES, "UTF-8");
        if ($txtWHIP !== ''){
            $data[] = $txtWHIP;
        }
        $txtComplete = htmlentities($_POST["txtComplete"], ENT_QUOTES, "UTF-8");
        if ($txtComplete !== ''){
            $data[] = $txtComplete;
        }
        $txtShutout = htmlentities($_POST["txtShutout"], ENT_QUOTES, "UTF-8");
        if ($txtShutout !== ''){
            $data[] = $txtShutout;
        }
        $txtSaves = htmlentities($_POST["txtSaves"], ENT_QUOTES, "UTF-8");
        if ($txtSaves !== ''){
            $data[] = $txtSaves;
        }
        $txtInnings = htmlentities($_POST["txtInnings"], ENT_QUOTES, "UTF-8");
        if ($txtInnings !== ''){
            $data[] = $txtInnings;
        }
        $txtHits = htmlentities($_POST["txtHits"], ENT_QUOTES, "UTF-8");
        if ($txtHits !== ''){
            $data[] = $txtHits;
        }
        $txtOpponent = htmlentities($_POST["txtOpponent"], ENT_QUOTES, "UTF-8");
        if ($txtOpponent !== ''){
            $data[] = $txtOpponent;
        }
        $txtIntentional = htmlentities($_POST["txtIntentional"], ENT_QUOTES, "UTF-8");
        if ($txtIntentional !== ''){
            $data[] = $txtIntentional;
        }
        $txtWild = htmlentities($_POST["txtWild"], ENT_QUOTES, "UTF-8");
        if ($txtWild !== ''){
            $data[] = $txtWild;
        }
        $txtHBP = htmlentities($_POST["txtHBP"], ENT_QUOTES, "UTF-8");
        if ($txtHBP !== ''){
            $data[] = $txtIBB;
        }
        $txtBalks = htmlentities($_POST["txtBalks"], ENT_QUOTES, "UTF-8");
        if ($txtBalks !== ''){
            $data[] = $txtBalks;
        }
        $txtBattersFaced = htmlentities($_POST["txtBattersFaced"], ENT_QUOTES, "UTF-8");
        if ($txtBattersFaced !== ''){
            $data[] = $txtBattersFaced;
        }
        $txtGamesFinished = htmlentities($_POST["txtGamesFinished"], ENT_QUOTES, "UTF-8");
        if ($txtGamesFinished !== ''){
            $data[] = $txtGamesFinished;
        }
        $txtRuns = htmlentities($_POST["txtRuns"], ENT_QUOTES, "UTF-8");
        if ($txtRuns !== ''){
            $data[] = $txtRuns;
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
        $query .= addquery($txtWins,'SUM(fldWins)', $WinsLogic);
        $query .= addquery($txtLoses,'SUM(fldLoses)', $LosesLogic);
        $query .= addquery($txtERA,'AVG(fldERA)', $ERALogic);
        $query .= addquery($txtWHIP,'AVG(fldWHIP)', $WHIPLogic);
        $query .= addquery($txtComplete,'SUM(fldComplete)', $CompleteLogic);
        $query .= addquery($txtShutout,'AVG(fldShutout)', $ShutoutLogic);
        $query .= addquery($txtSaves,'SUM(fldSaves)', $SavesLogic);
        $query .= addquery($txtInnings,'SUM(fldInning)', $InningsLogic);
        $query .= addquery($txtHits,'SUM(fldHits)', $HitsLogic);
        $query .= addquery($txtOpponent,'SUM(fldOpponent)', $OpponentLogic);
        $query .= addquery($txtIntentional,'SUM(fldIntentional)', $IntentionalLogic);
        $query .= addquery($txtWild,'SUM(fldWild)', $WildLogic);
        $query .= addquery($txtHBP,'SUM(fldHBP)', $HBPLogic);
        $query .= addquery($txtBalks,'SUM(fldBalks)', $BalksLogic);
        $query .= addquery($txtBattersFaced,'SUM(fldBattersFaced)', $BattersFacedLogic);
        $query .= addquery($txtGamesFinished,'SUM(fldGamesFinished)', $GamesFinishedLogic);
        $query .= addquery($txtRuns,'SUM(fldRuns)', $RunsLogic);
        $query .= addquery($txtSacHits,'SUM(fldSacrificeH)', $SacHitsLogic);
        $query .= addquery($txtSacFlys,'SUM(fldSacrificeF)', $SacFlysLogic);
        $query .= addquery($txtDoublePlays,'SUM(fldDoubleplays)', $DoublePlaysLogic);
        
        $pitching = $thisDatabaseReader->select($query, $data, $wheres, $conditions, $quotes, $symbols, false, false);
    }
    //If no button submission, just print all players and all accumulated stats
    else{
        $query = 'SELECT fnkPlayerId, fldFirstName, fldLastName, ';
        $query .= 'SUM(fldGames), SUM(fldGamesStarted), SUM(fldWins), ';
        $query .= 'SUM(fldLose), ROUND(AVG(fldERA), 2), ROUND(AVG(fldWhip), 2), SUM(fldComplete), ';
        $query .= 'SUM(fldShutout), SUM(fldSaves), SUM(fldInning), SUM(fldHits), ';
        $query .= 'ROUND(AVG(fldAverage), 3), SUM(fldIntentional), SUM(fldWild), SUM(fldHBP), ';
        $query .= 'SUM(fldBalks), SUM(fldBattersFaced), SUM(fldGamesFinished), SUM(fldRuns), ';
        $query .= 'SUM(fldSacrificeH), SUM(fldSacrificeF), SUM(fldDoubleplays) ';
        $query .= 'FROM tblPitching ';
        $query .= 'JOIN tblMaster ON pmkPlayerId = fnkPlayerId ';
        $query .= 'GROUP BY fnkPlayerId';
        $pitching = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
    }
    print '<body>';
    print '<h3>Pitching</h3>';
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
           <th><select id="listWins"
                name="listWins"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtWins" name="txtWins"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listLoses"
                name="listLoses"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtLoses" name="txtLoses"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listERA"
                name="listERA"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtERA" name="txtERA"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listWHIP"
                name="listWHIP"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtWHIP" name="txtWHIP"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listComplete"
                name="listComplete"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtComplete" name="txtComplete"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listShutout"
                name="listShutout"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtShutout" name="txtShutout"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listSaves"
                name="listSaves"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtSaves" name="txtSaves"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listInnings"
                name="listInnings"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtInnings" name="txtInnings"
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
            <th><select id="listOpponent"
                name="listOpponent"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtOpponent" name="txtOpponent"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listIntentional"
                name="listIntentional"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtIntentional" name="txtIntentional"
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
                           ></th>
            <th><select id="listBalks"
                name="listBalks"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtBalks" name="txtBalks"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listBattersFaced"
                name="listBattersFaced"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtBattersFaced" name="txtBattersFaced"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listGamesFinished"
                name="listGamesFinished"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
            
                <input class="text" type="text" id="txtGamesFinished" name="txtGamesFinished"
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
            <th><select id="listDoubleplays"
                name="listDoubleplays"
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
                           ></th>'
    ;
    //Print headers
    print "<tr>\n<th>First Name</th>\n<th>Last Name</th>\n
    <th>Games Played</th>\n<th>Games Started</th>\n<th>Wins</th>\n
    <th>Loses</th>\n
    <th>ERA</th>\n<th>WHIP</th>\n<th>Complete Games</th>\n
    <th>Shutout</th>\n<th>Saves</th>\n<th>Innings</th>
    <th>Hits</th>\n<th>Opponent Average</th>\n<th>Intentional Walks</th>\n<th>Wild Pitches</th>\n
    <th>HBP</th>\n<th>Balks</th>\n<th>Batters Faced</th>\n
    <th>Games Finished</th>\n<th>Runs</th>\n<th>Sac Hits</th>\n
    <th>Sac Flys</th>\n<th>Double Plays</th>\n</tr>\n";
    
    //Print each players accumulated statistics
    foreach ($pitching as $player) {
        print "<tr><td><a href='info.php?location=pitching&id=" . $player['fnkPlayerId'] . "'>" . $player['fldFirstName'] . "</td>\n<td><a href='info.php?location=pitching&id=" . 
        $player['fnkPlayerId'] . "'>" . $player['fldLastName'] . "</td>\n<td>" . 
        $player['SUM(fldGames)'] . "</td>\n<td>" . $player['SUM(fldGamesStarted)'] .
        "</td>\n<td>" . $player['SUM(fldWins)'] . "</td>\n<td>" . $player['SUM(fldLose)'] .
        "</td>\n<td>" . $player['ROUND(AVG(fldERA), 2)'] . "</td>\n<td>" . $player['ROUND(AVG(fldWhip), 2)'] .
        "</td>\n<td>" . $player['SUM(fldComplete)'] . "</td>\n<td>" . $player['SUM(fldShutout)'] .
        "</td>\n<td>" . $player['SUM(fldSaves)'] . "</td>\n<td>" . $player['SUM(fldInning)'] . "</td>\n<td>" . $player['SUM(fldHits)'] .        
        "</td>\n<td>" . $player['ROUND(AVG(fldAverage), 3)'] . "</td>\n<td>" . $player['SUM(fldIntentional)'] .
        "</td>\n<td>" . $player['SUM(fldWild)'] . "</td>\n<td>" . $player['SUM(fldHBP)'] .
        "</td>\n<td>" . $player['SUM(fldBalks)'] . "</td>\n<td>" . $player['SUM(fldBattersFaced)'] . "</td>\n<td>" . 
        $player['SUM(fldGamesFinished)'] . "</td>\n<td>" . $player['SUM(fldRuns)'] . "</td>\n<td>" .
        $player['SUM(fldSacrificeH)'] . "</td>\n<td>" . $player['SUM(fldSacrificeF)'] . "</td>\n<td>" . 
        $player['SUM(fldDoubleplays)'] . "</td>\n" . "</tr>\n";
    }
    
    print '</table>';
    print '</form>';
    print '</body>';












?>