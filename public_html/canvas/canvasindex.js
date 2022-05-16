let img ;
let r2,r;
let rV;
let rH;
let x1 = 0;
function setup() {
  createCanvas(700,467, WEBGL);
  img = loadImage('assets/recording.jpg');
}

function draw() {
  x1++;
  normalMaterial();
  for (let i = 0; i < 500; i++) {
    if((x1 % 3 == 0 )){
      r2 = random(-10, 25);
      rV = random(-22, 15);
      rH = random(-15, 22);
    }
  }
  camera(2 + sin(frameCount * 0.22), 1 + sin(frameCount * 0.01), 520 + sin(frameCount * 0.01) * 2, 0, 0, 0, 0, 1, 0);
 
  push();
  texture(img);
 
  plane(700,467);
  pop();

  translate(rV , rH, 0);
  push();
  texture(img);
  tint(0, 53, 204, r);
  plane(700,467);
  pop();
}