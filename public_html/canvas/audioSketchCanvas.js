    let value;
    let song;
    let freq = "Frequency";
    let loveLight;
    let spectrum;
    let c1,c2;
    let songtitle;

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if (urlParams.get('songtitle')) {
        songtitle = urlParams.get('songtitle');
    }else{
        songtitle = "default";
    }
    function preload(){
        song = loadSound('assets/' + songtitle + '.mp3');
    }
    function setup(){
        fft = new p5.FFT();
        song.amp(0.5);
        let canvas = createCanvas(1000,250);
        canvas.parent('structureSketch');
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
    function payAudio() {
        if (song.isPlaying()) {
            song.stop();
        } else {
            song.play();
        }
    }