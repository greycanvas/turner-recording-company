$(document).ready(function(){
    $('#compositionNav input[name=editcomp]').change(function() {   
        $(".containerArtist,.containerSong,.containerStructureLayout").hide();
        switch(this.value) {
            case "addArtist":
                $(".containerArtist").show();
            break;
            case "deleteArtist":
                $(".containerArtist").show();
            break;
            case "addSong":
                $(".containerSong").show();
            break;
            case "deleteSong":
                $(".containerSong").show();
            break;
            case "addStructure":
                $(".containerStructureLayout").show();
            break;
            default:
        }
    });
});

function compositionEdit(){
    let type = $('input[name="editcomp"]:checked').val();
    if(type == "addArtist"){
        let URL = "composition.php";
        let artist = $(".artistName").val();
        let data = { type: type, artistName: artist}

        $.post(URL,data,function(data,status){
           location.reload(); 
        });
    }
    if(type == "deleteArtist"){
        let URL = "composition.php";
        let artist = $(".artistName").val();
        let data = { type: type, deleteName: artist}

        $.post(URL,data,function(data,status){
            location.reload(); 
        });
    }
    if(type == "addSong"){
        let URL = "composition.php";
        let songArtist = $(".songArtist").val();
        let songTitle = $(".songTitle").val();
        let songAlbum = $(".songAlbum").val();
        let songLength = $(".songLength").val();
        let songFormat = $(".songFormat").val();

        let data = { type: type, songArtist: songArtist, songTitle: songTitle, songAlbum: songAlbum, songLength: songLength,songFormat :songFormat }

        $.post(URL,data,function(data,status){
            location.reload(); 
        });
    }
    if(type == "deleteSong"){
        let URL = "composition.php";
        let songArtist = $(".songArtist").val();
        let songTitle = $(".songTitle").val();

        let data = { type: type, songArtist: songArtist, songTitle: songTitle }

        $.post(URL,data,function(data,status){
            location.reload(); 
        });
    }
}
function getAlbumSongs(){
        let URL = "composition.php";
        let type = "getCurrentAlbum";
        let artistAlbums = $("#artistAlbums").val();
        let data = { type: type, artistAlbums: artistAlbums }
        let songList="";

        $.post(URL,data,function(data,status){
            let getAlbumArray = JSON.parse(data);
            for(let n=0;n<getAlbumArray.length;n++){
                songList += "<option value='" + getAlbumArray[n].Title + "'>" + getAlbumArray[n].Title + "</option>"; 
            }
            $("#songList").html(songList);
            $( "#getSongStructure" ).prop( "disabled", false );
            $( "#songList" ).prop( "disabled", false );
            $(".structureAlbum").val($("#artistAlbums").val());
            $(".structureSong").val($("#songList").val());
            $(".InstrAlbum").val($("#artistAlbums").val());
            $(".InstrSong").val($("#songList").val());
        });
}
function getStructure(){
    $(".structureContainer").show();  
    $('html, body').animate({scrollTop: $(".structureContainer").offset().top}, 1000);
    let type = $('input[name="editStructureItem"]:checked').val();
    let URL = "composition.php";
    let songTitle = $("#songList").val();
    $(".structureSong").val(songTitle);
    $(".InstrSong").val(songTitle);
    let define_bars=""
      
    let data = { type: type, songTitle: songTitle }
    const itemFeatures = new Map();
    $("#structureLayout").empty();
    $(".structureID").val("");
    $(".structureSection").val("");
    $(".structureBars").val("");
    $(".structureIntensity").val("");

    $.post(URL,data,function(data,status){
        if(type=="initStructure"){ 
            let getSongStructure = JSON.parse(data);

            if(typeof getSongStructure[0] !== 'undefined'){
                let elementCount = getSongStructure.length;
               // arrangmentSketch(songTitle);
                for(let n=0;n<elementCount;n++){

                    itemFeatures.set('idstructure' + n, getSongStructure[n].idstructure);
                    itemFeatures.set('Section' + n, getSongStructure[n].Section);
                    itemFeatures.set('Bars' + n, getSongStructure[n].Bars);
                    itemFeatures.set('Intensity' + n, getSongStructure[n].Intensity);

                    define_bars = (itemFeatures.get("Bars" + n) * 40);
                    $("#structureLayout").append(
                        "<div class='instr-container' style='width:" + define_bars + "px; height:" + itemFeatures.get("Intensity" + n) + "px;' onclick='javascript:mapItem(\"" + itemFeatures.get("idstructure" + n) + "\",\"" + itemFeatures.get("Section" + n) + "\",\"" + itemFeatures.get("Bars" + n) + "\",\"" + itemFeatures.get("Intensity" + n) + "\");' id='idstructure" + itemFeatures.get("idstructure" + n) + "'><div class='map-titles'>" + 
                        itemFeatures.get("Section" + n) + "</div></div>");
                }
            }
        }
    });

    let typeInstr = "getInstr";
    let artistAlbums = $("#artistAlbums").val();
    let dataInstr = { type: typeInstr, songTitle : songTitle, artistAlbums:artistAlbums }
    const itemInstruments = new Map();

    $.post(URL,dataInstr,function(data,status){
        let getInstrArray = JSON.parse(data);
        if(typeof getInstrArray[0] !== 'undefined'){
            let instrCount = getInstrArray.length;

            for(let n=0;n<instrCount;n++){
                itemInstruments.set('id' + n, getInstrArray[n].id);
                itemInstruments.set('instrID' + n, getInstrArray[n].instrID);
                itemInstruments.set('instr' + n, getInstrArray[n].instr);
                itemInstruments.set('Intensity' + n, getInstrArray[n].Intensity);
                itemInstruments.set('Section' + n, getInstrArray[n].Section);

                $("#idstructure" + itemInstruments.get('instrID' + n)).append("<div style='height:" + itemInstruments.get("Intensity" + n) + "px;' onclick='javascript:mapInstr(\"" + itemInstruments.get("id" + n) + "\",\"" + itemInstruments.get("instrID" + n) +  "\",\"" + itemInstruments.get("instr" + n) + "\",\"" + itemInstruments.get("Intensity" + n) + "\",\"" + itemInstruments.get("Section" + n) + "\")'>" + itemInstruments.get('instr' + n) + "</div>");

            }
        }
    });

    let typeChord = "chordProgression";
    let addEditChordProg = 2;
    let chordProg ="";
    let albumChord = $("#artistAlbums").val();
    let songChord = $("#songList").val();
    let chordProgID = $("#chordProgressionID").val();

    let dataChordProgress = {type:typeChord,addEditChordProg:addEditChordProg,chordProg:chordProg,album:albumChord,song:songChord,chordProgressionID:chordProgID}

    $.post(URL,dataChordProgress,function(data,status){
        let getChordProgressArray = JSON.parse(data);
        if(typeof getChordProgressArray[0] !== 'undefined'){
            $("#chordProgression").val(getChordProgressArray[0].chordprogress);
            if(getChordProgressArray[0].idchordprog !== 'undefined'){
                $("#addChordProg").prop( "disabled", true ).prop( "checked", false );
                $("#editChordProg").prop( "checked", true ).prop( "disabled", false );
                $("#chordProgressionID").val(getChordProgressArray[0].idchordprog);
            }else{
                $("#editChordProg").prop( "disabled", true ).prop( "checked", false );
            }
        }else{
            $("#chordProgression").val("");
            $("#addChordProg").prop( "disabled", false ).prop( "checked", true );
            $("#editChordProg").prop( "disabled", true ).prop( "checked", false );
        }
    });


    let sketchsongTitle = $('select[name=songList] option').filter(':selected').val();
    let URLaudio = "audiosketch.php";
    let dataAudio = {type:typeChord,sketchsongTitle:sketchsongTitle}
    $.post(URLaudio,dataAudio,function(data,status){

    });


}
function structureEdit(){
    let type = $('input[name="editStructureItem"]:checked').val();
    let URL = "composition.php";
    let id = $(".structureID").val();
    let songTitle = $("#songList").val();
    let structureAlbum = $(".artistAlbums").val();
    let structureSection = $(".structureSection").val();
    let structureBars = $(".structureBars").val();
    let structureIntensity = $(".structureIntensity").val();

    let data = { type: type,id: id, songTitle: songTitle,structureAlbum:structureAlbum,structureSection:structureSection,structureBars:structureBars,structureIntensity:structureIntensity }
    $.post(URL,data,function(data,status){
        location.reload(); 
    });
}
function mapItem(id,section,bars,itensity){
    $(".structureID").val(id);
    $(".InstrID").val(id);
    $(".structureSection").val(section);
    $(".structureBars").val(bars);
    $(".structureIntensity").val(itensity);
    $(".InstrSection").val(section);
}
function mapInstr(id,instrID,instr,Intensity,Section){
    $(".sectionInstrID").val(id);
    $(".InstrID").val(instrID);
    $(".Instr").val(instr);
    $(".InstrIntensity").val(Intensity);
    $(".InstrSection").val(Section);
}
function instruEdit(){
    let type = $('input[name="editInstrumentItem"]:checked').val();
    let URL = "composition.php";
    let sectionInstrID = $(".sectionInstrID").val();
    let InstrID = $(".InstrID").val();
    let Instr = $(".Instr").val();
    let InstrIntensity = $(".InstrIntensity").val();
    let InstrAlbum = $(".InstrAlbum").val();
    let InstrSong = $(".InstrSong").val();
    let InstrSection = $(".InstrSection").val();

    let data = { type: type,sectionInstrID:sectionInstrID,InstrID:InstrID,Instr: Instr,InstrIntensity:InstrIntensity, InstrAlbum: InstrAlbum,InstrSong:InstrSong,InstrSection:InstrSection }
    $.post(URL,data,function(data,status){
        location.reload(); 
    });
}

function chordEdit(){
    let type = "chordProgression";
    let URL = "composition.php";
    let addEditChordProg = $('input[name="editChordProg"]:checked').val();
    let chordProg = $("#chordProgression").val();
    let album = $("#artistAlbums").val();
    let song = $("#songList").val();
    let chordProgID = $("#chordProgressionID").val();

    let data = { type: type,addEditChordProg:addEditChordProg,chordProg:chordProg,album:album,song:song,chordProgressionID:chordProgID }
    $.post(URL,data,function(data,status){
        location.reload(); 
    });
}

function login(){
    let type = "login";
    let URL = "composition.php";
    let login = $("#username").val();
    let password= $("#password").val();
    let data = { type: type,login:login,password:password }
    $.post(URL,data,function(data,status){
        location.reload(); 
    });
}