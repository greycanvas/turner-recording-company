<?php
    include("header.php");
?>
<style>
    .navs{margin:20px;}
    .navs a{cursor:pointer;}
    #custom_canvas{
        display:flex;
        flex-direction:column;
        justify-content:center;
    }
    .parametric-eq{
        display:flex;
        flex-direction:row;
        justify-content:space-evenly;
        width:1000px;
        margin:0 auto;
        background-color: #505c60;
        color: #9ea7ad;
    }
    .parametric-eq .hz:not(:last-child){
        border-right:1px #a6aeb3 solid;
    }
    .parametric-eq .hz{
        padding: 5px 10px;
        justify-content: space-evenly;
        display: flex;
        width: 100%;
    }


    #custom_canvas canvas{
        margin: 0px auto;
    }
</style>
<script>
    let value;
    let song;
    let freq = "Frequency";
    let loveLight;
    let spectrum;
    let c1,c2;
    function preload(){
        song = loadSound('assets/tame_the_wicked.mp3');
    }
    function setup(){
        fft = new p5.FFT();
        song.amp(0.5);
        let canvas = createCanvas(1000,350);
        canvas.parent('custom_canvas');
        background(220);
        fill(0);
        textSize(14);
        c1 = color(235, 216, 216);
        c2 = color(169, 156, 186);
    }
    function draw(){
        for(let y=0; y<height; y++){
            n = map(y,0,height,0,1);
            let newc = lerpColor(c1,c2,n);
            stroke(newc);
            line(0,y,width, y);
        }
        spectrum = fft.analyze();
        stroke('#999');
        strokeWeight(0.01);
        let c = color(0, 126, 255, 102);
        fill(c);
        for (let i = 0; i< spectrum.length; i+=3){
            let x = map(i, 0, spectrum.length, 0, width);
            let h = -height + map(spectrum[i], 0, 255, height, 0);
            rect(x, height, 0.05, h );
   
            
        }

        
    }
    function mousePressed() {
        if (song.isPlaying()) {
            song.stop();
        } else {
            song.play();
        }
    }
</script>
<body>

<div class="parametric-eq">
    <?php
    for($x=0,$n=20.1; $x < 10; $x++){
        echo "<div class='hz'>$n Hz</div>";
        $n=($n*2);
    }
    ?>
</div>
<div id="custom_canvas"></div>

</body>
<?php
    include("footer.php");
?>