


window.setInterval(function(){
  var randomColor = '#'+ ('000000' + Math.floor(Math.random()*16777215).toString(16)).slice(-6);
  $("body").css("background-color",randomColor);
}, 20000);


setTimeout(getGuitarImg, 3000);

function getGuitarImg(){
  $("container.address .guitarimg").html("<img src='assets/hollowbody.jpg'></img>");
  $("container.address .guitarimg").css("display","block");
}

