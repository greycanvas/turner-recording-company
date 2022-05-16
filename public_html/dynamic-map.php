<?php
    include("header.php");
    $has_access=false;

    try {
        $result = $db->query("CALL getCredentials()");
    } catch (PDOException $e) {
        die("Error occurred:" . $e->getMessage());
    }
    $check_access = $result->fetch_all(MYSQLI_ASSOC);

    if(isset($_COOKIE['log'])){
        if($_COOKIE['log']==$check_access[0]['session']){
            $has_access=true;
        }
    }

    if(!$has_access){
        echo "<div class='login'>
        <input type='text' placeholder='Username' id='username'>
        <input type='password' placeholder='Username' id='password'>
        <button onclick='javascript:login()'>Login</button>
        </div>";
    }else{
        /** ARTIST */
        $db = new mysqli($server, $user, $password,"turner-record-company");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        try {
            $result = $db->query("CALL getArtist()");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $allArtist = $result->fetch_all(MYSQLI_ASSOC);
        $db->Close();

        /** GET ALBUMS */
        $db = new mysqli($server, $user, $password,"turner-record-company");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        try {
            $result = $db->query("CALL getArtistAlbums()");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $allAllbums = $result->fetch_all(MYSQLI_ASSOC);
        $db->Close();

        /** GET CREDENTIALS **/
        $db = new mysqli($server, $user, $password,"turner-record-company");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        try {
            $result = $db->query("CALL getCredentials()");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $allCredebtials = $result->fetch_all(MYSQLI_ASSOC);
        $db->Close();
    ?>
   <script src="canvas/audioSketchCanvas.js"></script>
    <div>
        <ul id="compositionNav">
            <li><input type="radio" name="editcomp" value="addArtist" checked>Add Artist</li>
            <li><input type="radio" name="editcomp" value="deleteArtist">Delete Artist</li>
            <li><input type="radio" name="editcomp" value="addSong">Add Song</li>
            <li><input type="radio" name="editcomp" value="deleteSong">Delete Song</li>
            <li><input type="radio" name="editcomp" value="addStructure">Add Structure</li>
        </ul>

        <div class="containerArtist">
        <ul>
            <li>Artist</li>
            <li><input class="artistName" placeholder="Artist" type="text"></input></li>
            <li><button onclick='javascript:compositionEdit()'>Edit Artist</button></li>
        </ul>
    </div>

    <div class="containerSong">
        <ul>
            <li>Song</li>
            <li><select name="artistSong" class="songArtist" id="artistSong">
            <?php
                foreach($allArtist as $x => $val){
                    foreach($val as $val2){
                        echo '<option value="' . $val2 . '">' . $val2 . '</option>';  
                    }
                }
            ?>
            </select></li>
            <li><input class="songTitle" placeholder="Song Title" type="text"></input></li>
            <li><input class="songAlbum" placeholder="Album" type="text"></input></li>
            <li><input class="songLength" placeholder="Song Length" type="text"></input><li>
            <li><input class="songFormat" placeholder="Song Format" type="text"></input></li>
            <li><button onclick='javascript:compositionEdit()'>Edit Song</button></li>
        </ul>
    </div>

    <div class="containerStructureLayout">            
        <ul>
            <li>Song Structure</li>
            <li><select name="artistAlbums" class="artistAlbums" id="artistAlbums">
                <?php
                    for($x=0;$x<count($allAllbums);$x++){
                        echo '<option value="' . $allAllbums[$x]["AlbumTitle"] . '">' . $allAllbums[$x]["AlbumTitle"]. '</option>';  
                    }     
                ?>
                </select>
            </li>
            <li>
                <button onclick='javascript:getAlbumSongs()'>Get Song List</button>
            </li>
            <li>
                <select name="songList" class="songList" id="songList" disabled><option>Song List</option></select>
            </li>
            <li>
                <button onclick='javascript:getStructure()' disabled id="getSongStructure">Get Song Structure</button>
            </li>
        </ul>
        <hr>  
        <div class="structureContainer">
            <ul id="structureEdit">
                <li><input type="radio" name="editStructureItem" value="initStructure" checked>Init</li>
                <li><input type="radio" name="editStructureItem" value="addStructure">Add</li>
                <li><input type="radio" name="editStructureItem" value="editStructure">Edit</li>
                <li><input type="radio" name="editStructureItem" value="deleteStructure">Delete</li>
            </ul>
            <div class="structureLayoutContainer">
                <ul>
                    <li>Edit Structure</li>
                    <li><input class="structureID" placeholder="ID" disabled type="text"></input></li>
                    <li><input class="structureAlbum" placeholder="Album" disabled type="text"></input></li>
                    <li><input class="structureSong" placeholder="Song" disabled type="text"></input></li>
                    <li><input class="structureSection" placeholder="Section" type="text"></input></li>
                    <li><input class="structureBars" placeholder="Bars" type="text"></input></li>
                    <li><input class="structureIntensity" placeholder="Intensity" type="text"></input></li>
                    <li><button onclick='javascript:structureEdit()'>Add / Edit Structure Item</button></li>
                    <li><hr></li>
                    <li>Add / Edit Instrument</li>
                    <li>            
                        <ul id="instrEdit">
                            <li><input type="radio" name="editInstrumentItem" value="addInstr" checked>Add</li>
                            <li><input type="radio" name="editInstrumentItem" value="editInstr">Edit</li>
                            <li><input type="radio" name="editInstrumentItem" value="deleteInstr">Delete</li>
                        </ul>
                    </li>
                    <input class="sectionInstrID" name="sectionInstrID" type="hidden"></input>
                    <li><input class="InstrID" disabled placeholder="Instr ID" type="text"></input></li>
                    <li><input class="Instr" placeholder="Instr" type="text"></input></li>
                    <li><input class="InstrIntensity" placeholder="Intensity" type="text"></input></li>
                    <li><input class="InstrAlbum" disabled placeholder="Album" type="text"></input></li>
                    <li><input class="InstrSong" disabled placeholder="Song" type="text"></input></li>
                    <li><input class="InstrSection" disabled placeholder="Section" type="text"></input></li>
                    <li><button onclick='javascript:instruEdit()'>Add / Edit Instrument</button></li>
                    <li><hr></li>
                    <li>Add / Edit Chord Progression</li>
                    <li> 
                        <ul id="chordEdit">
                            <li><input type="radio" id="addChordProg" name="editChordProg" value="0" checked>Add</li>
                            <li><input type="radio" id="editChordProg" name="editChordProg" value="1" disabled>Edit</li>
                        </ul>
                    </li>
                    <input type="hidden" name="chordProgressionID" id="chordProgressionID"  value="1" >
                    <li><textarea id="chordProgression"></textarea></li>
                    <li><button onclick='javascript:chordEdit()'>Add / Edit Chord Progression</button></li>
                </ul> 
                <div class="arrangementContainer"> 
                    <a href="javascript:payAudio();" class="playaudio">Play Audio</a>
                    <div class="parametric-eq">
                    <?php
                        for($x=0,$n=20.1; $x < 10; $x++){
                            echo "<div class='hz'>$n Hz</div>";
                            $n=($n*2);
                        }
                    ?>
                    </div>
                    <div id="structureSketch"></div>
                    <div id="structureLayout"></div>
                </div>
            </div>  
        </div>     
    </div>
    
</div>

<?php } ?>

<?php
    include("footer.php");
?>