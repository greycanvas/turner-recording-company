<?php
    require_once("lib/db.php");
    $type = "";
    if (isset($_REQUEST["type"])){ $type = $_REQUEST["type"]; }

    if($type == "addArtist"){
        $artistName = "";
        if (isset($_REQUEST["artistName"])){ $artistName = $_REQUEST["artistName"]; }
        try {
            $result = $db->query("CALL addArtist('$artistName')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "deleteArtist"){
        $artistName = "";
        if (isset($_REQUEST["deleteName"])){ $artistName = $_REQUEST["deleteName"]; }
        try {
            $result = $db->query("CALL deleteArtist('$artistName')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "addSong"){
        $songArtist = "";
        $songTitle = "";
        $songAlbum = "";
        $songLength = "";
        $songFormat = "";

        if (isset($_REQUEST["songArtist"])){ $songArtist = $_REQUEST["songArtist"]; }
        if (isset($_REQUEST["songTitle"])){ $songTitle = $_REQUEST["songTitle"]; }
        if (isset($_REQUEST["songAlbum"])){ $songAlbum = $_REQUEST["songAlbum"]; }
        if (isset($_REQUEST["songLength"])){ $songLength = $_REQUEST["songLength"]; }
        if (isset($_REQUEST["songFormat"])){ $songFormat = $_REQUEST["songFormat"]; }

        try {
            $result = $db->query("CALL addSong('$songArtist','$songTitle','$songAlbum','$songLength','$songFormat')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "deleteSong"){
        $songArtist = "";
        $songTitle = "";

        if (isset($_REQUEST["songArtist"])){ $songArtist = $_REQUEST["songArtist"]; }
        if (isset($_REQUEST["songTitle"])){ $songTitle = $_REQUEST["songTitle"]; }

        try {
            $result = $db->query("CALL deleteSong('$songArtist','$songTitle')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "getCurrentAlbum"){
        if (isset($_REQUEST["artistAlbums"])){ $artistAlbums = $_REQUEST["artistAlbums"]; }
        try {
            $result = $db->query("CALL getAlbumSongs('$artistAlbums')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $getAllSongs = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($getAllSongs);
    }
    if($type == "initStructure"){
        if (isset($_REQUEST["songTitle"])){ $songTitle = $_REQUEST["songTitle"]; }
        try {
            $result = $db->query("CALL getSongStructure('$songTitle')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $getSongStructure = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($getSongStructure);
    }
    if($type == "addStructure"){
        $songTitle = "";
        $structureAlbum = "";
        $structureSection = "";
        $structureBars = "";
        $structureIntensity = "";

        if (isset($_REQUEST["songTitle"])){ $songTitle = $_REQUEST["songTitle"]; }
        if (isset($_REQUEST["structureAlbum"])){ $structureAlbum = $_REQUEST["structureAlbum"]; }
        if (isset($_REQUEST["structureSection"])){ $structureSection = $_REQUEST["structureSection"]; }
        if (isset($_REQUEST["structureBars"])){ $structureBars = $_REQUEST["structureBars"]; }
        if (isset($_REQUEST["structureIntensity"])){ $structureIntensity = $_REQUEST["structureIntensity"]; }

        try {
            $result = $db->query("CALL addStructureItem('$songTitle','$structureAlbum','$structureSection','$structureBars','$structureIntensity')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "editStructure"){
        $id = "";
        $songTitle = "";
        $structureAlbum = "";
        $structureSection = "";
        $structureBars = "";
        $structureIntensity = "";

        if (isset($_REQUEST["id"])){ $id = $_REQUEST["id"]; }
        if (isset($_REQUEST["structureSection"])){ $structureSection = $_REQUEST["structureSection"]; }
        if (isset($_REQUEST["structureBars"])){ $structureBars = $_REQUEST["structureBars"]; }
        if (isset($_REQUEST["structureIntensity"])){ $structureIntensity = $_REQUEST["structureIntensity"]; }

        try {
            $result = $db->query("CALL editStructureItem('$id','$structureSection','$structureBars','$structureIntensity')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "deleteStructure"){
        $id = "";
        if (isset($_REQUEST["id"])){ $id = $_REQUEST["id"]; }
        try {
            $result = $db->query("CALL deleteStructureItem('$id')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "addInstr"){
        $InstrID = "";
        $Instr = "";
        $InstrIntensity = "";
        $InstrAlbum = "";
        $InstrSong = "";
        $InstrSection = "";

        if (isset($_REQUEST["InstrID"])){ $InstrID = $_REQUEST["InstrID"]; }
        if (isset($_REQUEST["Instr"])){ $Instr = $_REQUEST["Instr"]; }
        if (isset($_REQUEST["InstrIntensity"])){ $InstrIntensity = $_REQUEST["InstrIntensity"]; }
        if (isset($_REQUEST["InstrAlbum"])){ $InstrAlbum = $_REQUEST["InstrAlbum"]; }
        if (isset($_REQUEST["InstrSong"])){ $InstrSong = $_REQUEST["InstrSong"]; }
        if (isset($_REQUEST["InstrSection"])){ $InstrSection = $_REQUEST["InstrSection"]; }

        try {
            $result = $db->query("CALL addInstrItem($InstrID,'$Instr','$InstrIntensity','$InstrAlbum','$InstrSong','$InstrSection')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "editInstr"){
        $sectionInstrID = "";
        $Instr = "";
        $InstrIntensity = "";

        if (isset($_REQUEST["sectionInstrID"])){ $sectionInstrID= $_REQUEST["sectionInstrID"]; }
        if (isset($_REQUEST["Instr"])){ $Instr = $_REQUEST["Instr"]; }
        if (isset($_REQUEST["InstrIntensity"])){ $InstrIntensity = $_REQUEST["InstrIntensity"]; }

        try {
            $result = $db->query("CALL editInstrItem($sectionInstrID,'$Instr','$InstrIntensity')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "deleteInstr"){
        $sectionInstrID = "";

        if (isset($_REQUEST["sectionInstrID"])){ $sectionInstrID = $_REQUEST["sectionInstrID"]; }

        try {
            $result = $db->query("CALL deleteInstrItem($sectionInstrID)");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }
    if($type == "getInstr"){

        $songTitle = "";
        $artistAlbums = "";

        if (isset($_REQUEST["songTitle"])){ $songTitle = $_REQUEST["songTitle"]; }
        if (isset($_REQUEST["artistAlbums"])){ $artistAlbums = $_REQUEST["artistAlbums"]; }

        try {
            $result = $db->query("CALL getInstrItem('$songTitle','$artistAlbums')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        $getInstruments = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($getInstruments);
    }
    if($type == "chordProgression"){

        $addEditChordProg ="";
        $chordProg ="";
        $album = "";
        $song = "";
        $chordProgID = "";

        if (isset($_REQUEST["addEditChordProg"])){ $addEditChordProg = $_REQUEST["addEditChordProg"]; }
        if (isset($_REQUEST["chordProg"])){ $chordProg = $_REQUEST["chordProg"]; }
        if (isset($_REQUEST["album"])){ $album = $_REQUEST["album"]; }
        if (isset($_REQUEST["song"])){ $song = $_REQUEST["song"]; }
        if (isset($_REQUEST["chordProgressionID"])){ $chordProgID = $_REQUEST["chordProgressionID"]; }
  
        try {
            $result = $db->query("CALL editChordProgression($addEditChordProg,'$chordProg','$album','$song',$chordProgID)");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }

        $getChordProgression = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($getChordProgression);
    }

    if($type == "login"){
        $user = "";
        $password = "";
        $log = rand();

        if (isset($_REQUEST["login"])){ $user = $_REQUEST["login"]; }
        if (isset($_REQUEST["password"])){ $password = $_REQUEST["password"]; }

        try {
            $result = $db->query("CALL editCrdentials($log,'$user','$password')");
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }

        $getLogin = $result->fetch_all(MYSQLI_ASSOC);
        if($getLogin[0]['access']){
            setcookie('log', $log, time() + (3600 * 3), "/");
        }
    }
    
?>