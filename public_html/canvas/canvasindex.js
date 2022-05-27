let img ;
let r2,r;
let rV,rH;
let rVb;
let rHb;
let x1 = 0;
let x2 = 0;

let tint1=220;
let tint2=190;

function setup() {
  console.log(screenwidth+"/"+screenheight);
  createCanvas(screenwidth,screenheight, WEBGL);
  img = loadImage('assets/recording.jpg');
}

function draw() {
  
  x1++;
  x2++;
  normalMaterial();
  for (let i = 0; i < 500; i++) {
    if((x1 % 3 == 0 )){
      r2 = random(-0, 1);
      rV = random(-0, .5);
      rH = (-200 + random(-0, 1));
      tint1 = random(210, 225);
    }
    if((x2 % 7 == 0 )){
      r2b = random(-0, 1);
      rVb = random(-0, .5);
      rHb = (-200+random(-0, 1));
      tint2 = random(180, 195);

    }
  }

  camera(2 + sin(frameCount * 0.22), 1 + sin(frameCount * 0.01), 520 + sin(frameCount * 0.01) * 2, 0, 0, 0, 0, 1, 0);

  translate(rVb , rHb, 0);
  push();
  texture(img);
  tint(0, 153, 204, tint2);
  plane(350,233);
  pop();

  translate(rV , rH, 0);
  push();
  texture(img);
  tint(0, 53, 204, tint1);
  plane(350,233);
  pop();

}