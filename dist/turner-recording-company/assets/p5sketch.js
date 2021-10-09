
let szMult = 3.5;
let rec1 = -60;

function setup() {
  background(0); 
  createCanvas(1000, 400); 
  stroke(200); 
  frameRate(30);
  smooth();
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
