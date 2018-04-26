<?php
    include "top.php";
    //If an admin, print a link to insert mode
    if ($top != '')
    {
        print'<a class="admin" href="master.php?id=1">Insert Mode</a>';
    }
    
    $id = $_GET["id"];
    
    //If button submitted, get info from form and select insert it
    if (isset($_POST["btnSubmit"]) && $id == 1)
    {
        $data = array();
     
        //Get's all information from POST array, and checks if they are empty
        $txtFirstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
        if ($txtFirstName !== ''){
            $data[] = $txtFirstName;
        }
        $txtLastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
        if($txtLastName !== ''){
           $data[] = $txtLastName;
        }
        //Generate playerID (VERY low probability of a collision)
        $randInt = rand(0, 100);
        $fname = substr($txtFirstName, 0, 2);
        $playerId = $txtLastName . $fname . $randInt;
        
        $data[] = $playerId;      
        $data2 = array($playerId);
        
        $txtGivenName = htmlentities($_POST["txtGivenName"], ENT_QUOTES, "UTF-8");
        if ($txtGivenName !== ''){
            $data[] = $txtGivenName;
        }
        $txtBirthMonth = htmlentities($_POST["txtBirthMonth"], ENT_QUOTES, "UTF-8");
        if ($txtBirthMonth !== ''){
            $data[] = $txtBirthMonth;
        }
        $txtBirthday = htmlentities($_POST["txtBirthday"], ENT_QUOTES, "UTF-8");
        if ($txtBirthday !== ''){
            $data[] = $txtBirthday;
        }
        $txtBirthYear = htmlentities($_POST["txtBirthYear"], ENT_QUOTES, "UTF-8");
        if ($txtBirthYear !== ''){
            $data[] = $txtBirthYear;
        }
        $txtBirthCountry = htmlentities($_POST["txtBirthCountry"], ENT_QUOTES, "UTF-8");
        if ($txtBirthCountry !== ''){
            $data[] = $txtBirthCountry;
        }
        $txtBirthState = htmlentities($_POST["txtBirthState"], ENT_QUOTES, "UTF-8");
        if ($txtBirthState !== ''){
            $data[] = $txtBirthState;
        }
        $txtBirthCity = htmlentities($_POST["txtBirthCity"], ENT_QUOTES, "UTF-8");
        if ($txtBirthCity !== ''){
            $data[] = $txtBirthCity;
        }
        $txtDeathMonth = htmlentities($_POST["txtDeathMonth"], ENT_QUOTES, "UTF-8");
        if ($txtDeathMonth !== ''){
            $data[] = $txtDeathMonth;
        }
        $txtDeathDay = htmlentities($_POST["txtDeathDay"], ENT_QUOTES, "UTF-8");
        if ($txtDeathDay !== ''){
            $data[] = $txtDeathDay;
        }
        $txtDeathYear = htmlentities($_POST["txtDeathYear"], ENT_QUOTES, "UTF-8");
        if ($txtDeathYear !== ''){
            $data[] = $txtDeathYear;
        }
        $txtDeathCountry = htmlentities($_POST["txtDeathCountry"], ENT_QUOTES, "UTF-8");
        if ($txtDeathCountry !== ''){
            $data[] = $txtDeathCountry;
        }
        $txtDeathState = htmlentities($_POST["txtDeathState"], ENT_QUOTES, "UTF-8");
        if ($txtDeathState !== ''){
            $data[] = $txtDeathState;
        }
        $txtDeathCity = htmlentities($_POST["txtDeathCity"], ENT_QUOTES, "UTF-8");
        if ($txtDeathCity !== ''){
            $data[] = $txtDeathCity;
        }
        $txtWeight = htmlentities($_POST["txtWeight"], ENT_QUOTES, "UTF-8");
        if ($txtWeight !== ''){
            $data[] = $txtWeight;
        }
        $txtHeight = htmlentities($_POST["txtHeight"], ENT_QUOTES, "UTF-8");
        if ($txtHeight !== ''){
            $data[] = $txtHeight;
        }
        $txtDebut = htmlentities($_POST["txtDebut"], ENT_QUOTES, "UTF-8");
        if ($txtDebut !== ''){
            $data[] = $txtDebut;
        }
        $txtFinalGame = htmlentities($_POST["txtFinalGame"], ENT_QUOTES, "UTF-8");
        if ($txtFinalGame !== ''){
            $data[] = $txtFinalGame;
        }
        //Insert statement
        $query = 'INSERT into tblMaster SET ';
        
        
        $query .= 'fldFirstName = ?';
        $query .= ', fldLastName = ?';
        $query .= ', pmkPlayerId = ?';
        
        //If empty, do not query for results
        if ($txtGivenName !== ''){
        $query .= ', fldGivenName = ?';
        }
        if ($txtBirthMonth !== ''){
        $query .= ', fldBirthMonth = ?';
        }
        if ($txtBirthday !== ''){
        $query .= ', fldBirthDay = ?';
        }
        if ($txtBirthYear !== ''){
        $query .= ', fldBirthYear = ?';
        }
        if ($txtBirthCountry !== ''){
        $query .= ', fldBirthCountry = ?';
        }
        if ($txtBirthState !== ''){
        $query .= ', fldBirthState = ?';
        }
        if ($txtBirthCity !== ''){
        $query .= ', fldBirthCity = ?';
        }
        if ($txtDeathMonth !== ''){
        $query .= ', fldDeathMonth = ?';
        }
        if ($txtDeathDay !== ''){
        $query .= ', fldDeathDay = ?';
        }
        if ($txtDeathYear !== ''){
        $query .= ', fldDeathYear = ?';
        }
        if ($txtDeathCountry !== ''){
        $query .= ', fldDeathCountry = ?';
        }
        if ($txtDeathState !== ''){
        $query .= ', fldDeathState = ?';
        }
        if ($txtDeathCity !== ''){
        $query .= ', fldDeathCity = ?';
        }
        if ($txtWeight !== ''){
        $query .= ', fldWeight = ?';
        }
        if ($txtHeight !== ''){
        $query .= ', fldHeight = ?';
        }
        if ($txtDebut !== ''){
        $query .= ', fldDebut = ?';
        }
        if ($txtFinalGame !== ''){
        $query .= ', fldFinalGame = ?';
        }
        
        //Insert the player ids into the other tables too, so they can potentially be updated
        $query2 = 'INSERT into tblBatting SET ';
        $query3 = 'INSERT into tblPitching SET ';
        $query4 = 'INSERT into tblFielding SET ';
        $query2 .= 'fnkPlayerId = ?';
        
        $query3 .= 'fnkPlayerId = ?';
        
        $query4 .= 'fnkPlayerId = ?';
        
        $results = $thisDatabaseWriter->insert($query, $data);
        $results = $thisDatabaseWriter->insert($query2, $data2);
        $results = $thisDatabaseWriter->insert($query3, $data2);
        $results = $thisDatabaseWriter->insert($query4, $data2);
    }
    //If button submit, select what they asked for
    if (isset($_POST["btnSubmit"]) && $id != 1) {
        
        //Initialize array, and query conditions
        $data = array();
        $Where = false;
        $conditions = 0;
        $quotes = 0;
        $symbols = 0;
        $wheres = 0;
        
        //Get the logic operators the user entered
        $BirthMonthLogic = (string)htmlentities($_POST["listBirthMonth"], ENT_QUOTES, "UTF-8");
        $BirthdayLogic = htmlentities($_POST["listBirthDay"], ENT_QUOTES, "UTF-8");
        $BirthYearLogic = htmlentities($_POST["listBirthYear"], ENT_QUOTES, "UTF-8");
        $DeathMonthLogic = htmlentities($_POST["listDeathMonth"], ENT_QUOTES, "UTF-8");
        $DeathDayLogic = htmlentities($_POST["listDeathDay"], ENT_QUOTES, "UTF-8");
        $DeathYearLogic = htmlentities($_POST["listDeathYear"], ENT_QUOTES, "UTF-8");
        $WeightLogic = htmlentities($_POST["listWeight"], ENT_QUOTES, "UTF-8");
        $HeightLogic = htmlentities($_POST["listHeight"], ENT_QUOTES, "UTF-8");
        
        $FirstNameLogic = '=';
        $LastNameLogic = '=';
        $GivenNameLogic = '=';
        $BirthCountryLogic = '=';
        $BirthStateLogic = '=';
        $BirthCityLogic = '=';
        $DeathCountryLogic = '=';
        $DeathStateLogic = '=';
        $DeathCityLogic = '=';
        $DebutLogic = '=';
        $FinalGameLogic = '=';
        
        //Get the textbox information
        $txtFirstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
        if ($txtFirstName !== ''){
            $data[] = $txtFirstName;
        }
        $txtLastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
        if($txtLastName !== ''){
           $data[] = $txtLastName;
        }
        $txtGivenName = htmlentities($_POST["txtGivenName"], ENT_QUOTES, "UTF-8");
        if ($txtGivenName !== ''){
            $data[] = $txtGivenName;
        }
        $txtBirthMonth = htmlentities($_POST["txtBirthMonth"], ENT_QUOTES, "UTF-8");
        if ($txtBirthMonth !== ''){
            $data[] = $txtBirthMonth;
        }
        $txtBirthday = htmlentities($_POST["txtBirthday"], ENT_QUOTES, "UTF-8");
        if ($txtBirthday !== ''){
            $data[] = $txtBirthday;
        }
        $txtBirthYear = htmlentities($_POST["txtBirthYear"], ENT_QUOTES, "UTF-8");
        if ($txtBirthYear !== ''){
            $data[] = $txtBirthYear;
        }
        $txtBirthCountry = htmlentities($_POST["txtBirthCountry"], ENT_QUOTES, "UTF-8");
        if ($txtBirthCountry !== ''){
            $data[] = $txtBirthCountry;
        }
        $txtBirthState = htmlentities($_POST["txtBirthState"], ENT_QUOTES, "UTF-8");
        if ($txtBirthState !== ''){
            $data[] = $txtBirthState;
        }
        $txtBirthCity = htmlentities($_POST["txtBirthCity"], ENT_QUOTES, "UTF-8");
        if ($txtBirthCity !== ''){
            $data[] = $txtBirthCity;
        }
        $txtDeathMonth = htmlentities($_POST["txtDeathMonth"], ENT_QUOTES, "UTF-8");
        if ($txtDeathMonth !== ''){
            $data[] = $txtDeathMonth;
        }
        $txtDeathDay = htmlentities($_POST["txtDeathDay"], ENT_QUOTES, "UTF-8");
        if ($txtDeathDay !== ''){
            $data[] = $txtDeathDay;
        }
        $txtDeathYear = htmlentities($_POST["txtDeathYear"], ENT_QUOTES, "UTF-8");
        if ($txtDeathYear !== ''){
            $data[] = $txtDeathYear;
        }
        $txtDeathCountry = htmlentities($_POST["txtDeathCountry"], ENT_QUOTES, "UTF-8");
        if ($txtDeathCountry !== ''){
            $data[] = $txtDeathCountry;
        }
        $txtDeathState = htmlentities($_POST["txtDeathState"], ENT_QUOTES, "UTF-8");
        if ($txtDeathState !== ''){
            $data[] = $txtDeathState;
        }
        $txtDeathCity = htmlentities($_POST["txtDeathCity"], ENT_QUOTES, "UTF-8");
        if ($txtDeathCity !== ''){
            $data[] = $txtDeathCity;
        }
        $txtWeight = htmlentities($_POST["txtWeight"], ENT_QUOTES, "UTF-8");
        if ($txtWeight !== ''){
            $data[] = $txtWeight;
        }
        $txtHeight = htmlentities($_POST["txtHeight"], ENT_QUOTES, "UTF-8");
        if ($txtHeight !== ''){
            $data[] = $txtHeight;
        }
        $txtDebut = htmlentities($_POST["txtDebut"], ENT_QUOTES, "UTF-8");
        if ($txtDebut !== ''){
            $data[] = $txtDebut;
        }
        $txtFinalGame = htmlentities($_POST["txtFinalGame"], ENT_QUOTES, "UTF-8");
        if ($txtFinalGame !== ''){
            $data[] = $txtFinalGame;
        }
        $query = 'SELECT pmkPlayerId, fldBirthYear, fldBirthMonth, ';
        $query .= 'fldBirthDay, fldBirthCountry, fldBirthState, ';
        $query .= 'fldBirthCity, ';
        $query .= 'fldDeathYear, fldDeathMonth, fldDeathDay, ';
        $query .= 'fldDeathCountry, fldDeathState, fldDeathCity, ';
        $query .= 'fldFirstName, fldLastName, fldGivenName, ';
        $query .= 'fldWeight, fldHeight, fldDebut, fldFinalGame ';
        $query .= 'FROM tblMaster';
       
        //Function to decide each query to add on based on the logic operator, and the variables
        function addquery($c, $varname, $logicname){
        
        $q = '';
        $l = $logicname;
        
        if($c != ''){
       
            global $Where, $wheres, $conditions, $symbols; 
            if($Where == false){
                
                if($l === '=')
                {
                  $q = ' WHERE ' . $varname . ' = ?';
                  $Where = true;
                  $wheres++;
                }
                if($l === 'greaterthan')
                {
                  $q = ' WHERE ' . $varname . ' > ?';
                  $Where = true;
                  $wheres++;
                  $symbols++;
                }
                if($l === 'lessthan')
                {
                  $q = ' WHERE ' . $varname . ' < ?';
                  $Where = true;
                  $wheres++;
                  $symbols++;
                }
                if($l === 'lesserequal')
                {
                  $q = ' WHERE ' . $varname . ' <= ?';
                  $Where = true;
                  $wheres++;
                  $symbols++;
                }
                if($l === 'greaterequal')
                {
                  $q = ' WHERE ' . $varname . ' >= ?';
                  $Where = true;
                  $wheres++;
                  $symbols++;
                }
            }
            else
            {
                if($l === '=')
                {
                  $q = ' AND ' . $varname . ' = ?';
                  $Where = true;
                  $conditions++;
                }
                if($l === 'greaterthan')
                {
                  $q = ' AND ' . $varname . ' > ?';
                  $Where = true;
                  $symbols++;
                  $conditions++;
                }
                if($l === 'lessthan')
                {
                  $q = ' AND ' . $varname . ' < ?';
                  $Where = true;
                  $symbols++;
                  $conditions++;
                }
                if($l === 'lesserequal')
                {
                  $q = ' AND ' . $varname . ' <= ?';
                  $Where = true;
                  $symbols++;
                  $conditions++;
                }
                if($l === 'greaterequal')
                {
                  $q = ' AND ' . $varname . ' >= ?';
                  $Where = true;
                  $symbols++;
                  $conditions++;
                }
            }
          }
          
          return $q;
        } 
        //Use above function with each variable
        $query .= addquery($txtFirstName,'fldFirstName', $FirstNameLogic);
        $query .= addquery($txtLastName,'fldLastName', $LastNameLogic);
        $query .= addquery($txtGivenName,'fldGivenName', $GivenNameLogic);
        $query .= addquery($txtBirthMonth,'fldBirthMonth', $BirthMonthLogic);
        $query .= addquery($txtBirthday,'fldBirthDay', $BirthdayLogic);
        $query .= addquery($txtBirthYear,'fldBirthYear', $BirthYearLogic);
        $query .= addquery($txtBirthCountry,'fldBirthCountry', $BirthCountryLogic);
        $query .= addquery($txtBirthState,'fldBirthState', $BirthStateLogic);
        $query .= addquery($txtBirthCity,'fldBirthCity', $BirthCityLogic);
        $query .= addquery($txtDeathMonth,'fldDeathMonth', $DeathMonthLogic);
        $query .= addquery($txtDeathDay,'fldDeathDay', $DeathDayLogic);
        $query .= addquery($txtDeathYear,'fldDeathYear', $DeathYearLogic);
        $query .= addquery($txtDeathCountry,'fldDeathCountry', $DeathCountryLogic);
        $query .= addquery($txtDeathState,'fldDeathState', $DeathStateLogic);
        $query .= addquery($txtDeathCity,'fldDeathCity', $DeathCityLogic);
        $query .= addquery($txtWeight,'fldWeight', $WeightLogic);
        $query .= addquery($txtHeight,'fldHeight', $HeightLogic);
        $query .= addquery($txtDebut,'fldDebut', $DebutLogic);
        $query .= addquery($txtFinalGame,'fldFinalGame', $FinalGameLogic);
       
        $master = $thisDatabaseReader->select($query, $data, $wheres, $conditions, $quotes, $symbols, false, false);    
        
    }
    //If no button submitted, just select all the records
    else
    {
        $query = 'SELECT pmkPlayerId, fldBirthYear, fldBirthMonth, ';
        $query .= 'fldBirthDay, fldBirthCountry, fldBirthState, ';
        $query .= 'fldBirthCity, ';
        $query .= 'fldDeathYear, fldDeathMonth, fldDeathDay, ';
        $query .= 'fldDeathCountry, fldDeathState, fldDeathCity, ';
        $query .= 'fldFirstName, fldLastName, fldGivenName, ';
        $query .= 'fldWeight, fldHeight, fldDebut, fldFinalGame ';
        $query .= 'FROM tblMaster';
       
        $master = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
    }
    
    print '<body>';
    //If insert mode, let the user know in the heading
    if($id == 1){
      print '<h3>General Info (Insert Mode)</h3>';
    }
    else{
    print '<h3>General Info</h3>';
    }
    if($id == 1){
     print "<form action='master.php?id=1' 
                 method='post'
                 id='frmRegister'>";
    }
    else{
     print "<form action='master.php' 
                 method='post'
                 id='frmRegister'>";    
    }
    //If insert mode, let user know how to insert
    if($id == 1){
      print '<h4>Enter the player information and hit submit!</h4>';
    }
    else{
      print '<h4>Get the info you need and hit submit!</h4>';
    }
    //Form to submit queries/insert into the table
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
           <th><input class="text" type="text" id="txtGivenName" name="txtGivenName"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listBirthMonth"
                name="listBirthMonth"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtBirthMonth" name="txtBirthMonth"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listBirthDay"
                name="listBirthDay"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtBirthday" name="txtBirthday"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><select id="listBirthYear"
                name="listBirthYear"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtBirthYear" name="txtBirthYear"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><input class="text" type="text" id="txtBirthCountry" name="txtBirthCountry"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
           <th><input class="text" type="text" id="txtBirthState" name="txtBirthState"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtBirthCity" name="txtBirthCity"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDeathMonth"
                name="listDeathMonth"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtDeathMonth" name="txtDeathMonth"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDeathDay"
                name="listDeathDay"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtDeathDay" name="txtDeathDay"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listDeathYear"
                name="listDeathYear"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtDeathYear" name="txtDeathYear"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtDeathCountry" name="txtDeathCountry"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtDeathState" name="txtDeathState"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtDeathCity" name="txtDeathCity"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listWeight"
                name="listWeight"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtWeight" name="txtWeight"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><select id="listHeight"
                name="listHeight"
                tabindex="300" >
  
                <option value="=" selected>=</option>
                <option value="greaterthan">></option>
                <option value="lessthan" ><</option>
                <option value="greaterequal">>=</option>
                <option value="lesserequal"><=</option>
                </select>
                <input class="text" type="text" id="txtHeight" name="txtHeight"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtDebut" name="txtDebut"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>
            <th><input class="text" type="text" id="txtFinalGame" name="txtFinalGame"
                           value=""
                           tabindex="100" maxlength="20" placeholder=""
                           ></th>';
    //Print table headers
    print "<tr>\n<th>First Name</th>\n<th>Last Name</th>\n
    <th>Given Name</th>\n<th>Birth Month</th>\n<th>Birthday</th>\n
    <th>Birth Year</th>\n<th>Birth Country</th>\n<th>Birth State</th>\n
    <th>Birth City</th>\n<th>Death Month</th>\n<th>Death Day</th>\n
    <th>Death Year</th>\n<th>Death Country</th>\n<th>Death State</th>
    <th>Death City</th>\n<th>Weight</th>\n<th>Height</th>\n<th>Debut</th>\n
    <th>Final Game</th>\n</tr>\n";
    
    //Print each record
    foreach ($master as $player) {
        
        print "<tr><td><a href='info.php?location=batting&id=" . $player['pmkPlayerId'] . "'>" . $player['fldFirstName'] . "</a></td>\n<td><a href='info.php?location=batting&id=" . $player['pmkPlayerId'] . 
        "'>" . $player['fldLastName'] . "</a></td>\n<td>" . $player['fldGivenName'] . "</td>\n<td>" . $player['fldBirthMonth'] .
        "</td>\n<td>" . $player['fldBirthDay'] . "</td>\n<td>" . $player['fldBirthYear'] .
        "</td>\n<td>" . $player['fldBirthCountry'] . "</td>\n<td>" . $player['fldBirthState'] .
        "</td>\n<td>" . $player['fldBirthCity'] . "</td>\n<td>" . $player['fldDeathMonth'] .
        "</td>\n<td>" . $player['fldDeathDay'] . "</td>\n<td>" . $player['fldDeathYear'] .
        "</td>\n<td>" . $player['fldDeathCountry'] . "</td>\n<td>" . $player['fldDeathState'] .
        "</td>\n<td>" . $player['fldDeathCity'] . "</td>\n<td>" . $player['fldWeight'] .
        "</td>\n<td>" . $player['fldHeight'] . "</td>\n<td>" . $player['fldDebut'] .
        "</td>\n<td>" . $player['fldFinalGame'] . "</td>\n</tr>\n";
    }
    
    print '</table>';
    print '</form>';
    print '</body>';







?>
