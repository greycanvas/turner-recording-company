let szMult = 3.5;
let rec1 = -60;
function setup() {

  createCanvas(2000, 900);
  noStroke();

  let co = color(199,172,115);
  let cl = color(46,106,148);
  let numSteps = 2000;
  
  for (let i=0;i<numSteps;i++){
    let a = i/(numSteps-1.0);
    
    colorMode(RGB);
    fill(lerpColor(co,cl,a));
    rect(0+i,0,1,450);
  }
}


function draw() {
  translate(frameCount*2,200);
  rotate(radians(frameCount*3));
  sclSize = sin(radians(frameCount * szMult));
  scale(map(sclSize,-1,1,0.5,1));
  drawFigure();
}
function drawFigure(){
  noFill();
  stroke(5,5,0,88);
  rect(rec1, -40, 120, 80);
}
