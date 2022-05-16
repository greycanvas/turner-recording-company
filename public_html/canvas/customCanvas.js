
//let title = id.toLowerCase().replace(/ /g,"_"); 
let song,analyzer;
let r,g,b;
let mic,fft;
let i;
let forwoard = 0;
function preload(){
    song = loadSound('assets/tame_the_wicked.mp3');
}
function setup(){
    let canvas = createCanvas(1000,150);
    canvas.parent('structureSketch');
    r = random(255);
    g = random(255);
    b = random(255);
    song.loop();
 
    analyzer = new p5.Amplitude();
    analyzer.setInput(song);

    mic = new p5.AudioIn();
    mic.start();
    fft = new p5.FFT();
    fft.setInput(mic);

}
function draw(){
    background(255);

    let rms = analyzer.getLevel();
    fill(r,g,b,127);
    stroke(1);
    
    ellipse(width / 2, height / 2, 10 + rms * 200, 10 + rms * 200);
    let spectrum = fft.analyze();


  
    stroke(255, 102, 0);
    stroke(0, 0, 0);
    bezier(0, rms  * 20, 10, 10, 90, 90, 15, 80);
    beginShape()
    for(i = 0;i < spectrum.length;i++){

        bezier(0,spectrum[i],410,20,300 );
    }
    endShape();
}

function mousePressed() {
   if (song.isPlaying()) {

      song.stop();

    } else {
      song.play();
    
    }
  }

function arrangmentSketch(id){
    a = 550;
   /* let title = id.toLowerCase().replace(/ /g,"_"); 
    let song,analyzer;
    let r,g,b;
    let fft;

    function preload(){
        song = loadSound('/assets/'+title+".mp3");
    }*/
    /*function setup(){
        let canvas = createCanvas(600,100);
        canvas.parent('structureSketch');*/
        /* r = random(255);
         g = random(255);
         b = random(255);
         song.loop();
 
         analyzer = new p5.Amplitude();
         analyzer.setInput(song);*/
  /*   }
     function draw(){
         background(200);*/
 /*
         let rms = analyzer.getLevel();
         fill(r,g,b,127);
         stoke(0);
 
         let spectrum = fft.analyze();
         beginShape()
         for(i = 0;i <spectrum.length;i++){
             vertex(i, map(spectrum[i],0,255,height,0));
 
         }
         endShape();*/
  /*   }*/
 
 }