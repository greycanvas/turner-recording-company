let y = 100;
let x = 0;
let red = 0;
let blue = 0;
let green = 0;

let width = 720;
let height = 400;

function setup() {
  createCanvas(width, height); 
  stroke(255); 
  frameRate(30);
}

function draw() {
  background(red,blue,green); 
  y = y - 1;
  if (y < 0) {
    y = height;
  }
  line(x, y, width, y);
}
