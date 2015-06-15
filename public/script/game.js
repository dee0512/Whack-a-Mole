var mole;
var score;
var total;
var game;
var gameflag = false;
var moleArr = [0,0,0,0,0,0,0,0,0];// to calc hits of all moles
$( document ).ready(function() {
    var cw = $('#game').width();
    $ ('#game').css({'height':cw+'px'});
    var hw = $('.hole').width();
    $ ('.hole').css({'height':hw+'px'}); 
    $(".hole").on("click",function (){
        //on mole hit
        if($(this).hasClass('mole')){
            score++;
            moleArr[mole-1]++;
            $("#score").html(score);
        }
    });
});
//get random mole
function setMole(){
    mole = Math.floor((Math.random() * 9) + 1);
}

function startgame(){
    var name = document.forms['user']['name'].value;
    //check if name is set
    if(name == null || name == ''){
        alert("Please fill out the name");
    }
    else
    {
        //start game
        setMole();
        score = 0;
        total = 0;
        moleArr = [0,0,0,0,0,0,0,0,0];
        $("#score").html(score);
        $("#time").html(total);
        gameflag = true;
        game = setInterval(function(){moles()},1000);
    }
        
}
function moles(){
    //actual game loop
    setMole();
    $('#hole'+mole).addClass('mole');
    setTimeout(function(){$('#hole'+mole).removeClass('mole');},600);
    total++;
    $("#time").html(total);
    if(total >= 20){
        stopgame();
    }
}

function stopgame(){
    // on stop game
    if(gameflag)
    {
        clearInterval(game);
        gameflag = false;
        document.forms['user']['score'].value = score;
        document.forms['user']['mole'].value = moleArr.indexOf(Math.max.apply(Math, moleArr)) + 1;
        for(var i= 0;i< 9; i++){
            document.forms['user']['mole'+(i+1)].value = moleArr[i];
        }
        if(!alert("Game Over!\nYour Score is: "+score)){
        document.getElementById("userform").submit();
        }
    }
}
// Highlight holes
function highlight(a,b,c){
    $("#hole"+a).addClass('highlight');
    $("#hole"+2).addClass('highlight');
    $("#hole"+3).addClass('highlight');
    setTimeout(function(){
        $("#hole"+a).removeClass('highlight');
        $("#hole"+2).removeClass('highlight');
        $("#hole"+3).removeClass('highlight');
    },1000);
}
function highlight2(a){
    $("#hole"+a).addClass('highlight');
    setTimeout(function(){
        $("#hole"+a).removeClass('highlight');
    },1000);
}
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
