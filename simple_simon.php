<!DOCTYPE html>
<html>
<head>
    <title>Simple Simon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/css_simon.css">
    <link href='https://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>

</head>
<body>
<?php require 'navbar.php' ?>
<h1>Simple Simon</h1>

<div id="black_box"></div>
<div id= game_box>
    <div id="red_box" class="red square"></div>
    <div id="green_box" class="green square"></div>
    <div id="yellow_box" class="yellow square" ></div>
    <div id="blue_box" class="blue square"></div>
</div>
<div id="inner_circle"></div>
<div class="toggle">
    <h2 >GAME OVER!!!!!!</h2>
        <p>Press start to try again.</p>
</div>

<button id="start">START</button>
<button id="rounds">round:</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
(function(){
 "use strict"
    var $square = $('.square');
    var simonClick;
    var playerClick;
    var baseUrl = "/sound/";
    var audio = ["a_sharp.wav", "c_sharp.wav", "d_sharp.wav", "f_sharp.wav"];
    // START OF THE GAME  ------ 
    $("#start").click (function(){
        StartGame();
        });
    // STARTGAME FUNCTION after start is clicked this clears simonClick array. 
    // It tells it to run simonTurn function which I may remove and just have 
    // this function do the work. 
    function StartGame() {
    simonClick = [];
    simonTurn();
    $(".toggle").css('display', 'none');
    };
    // This Function allows simon to start his array and have the playerClick array to 0.
    // Also it runs the random number function to select a random number to use.
    function simonTurn() {
        playerClick = [];
        randomNumber();
        play();
    };
    // This fuction selects a random number then also sets it with my class tag 
    // Square to a variable of brightSquare. This then uses that variable to to select
    // that id and push it to the SimonClick array. 
    function randomNumber() {
        var random = Math.floor(Math.random() * 4);
        var brightSquare = $square[random];
        var id = brightSquare.id;
        simonClick.push(id);
    };
    // This fuction is the simon playing function. It disables the player from clicking and
    // then sets a Timeout to select a square by using the Simon Click array to light up those
    // squares    
    function play () {
        disableClicking();
        $("#rounds").text("round: " + simonClick.length);
        setTimeout(function () {
            var i = 0;
            var intervalId = setInterval(function () {
                lightSquare($("#" + simonClick[i]));
                i++;
                if (i >= simonClick.length){
                    clearInterval(intervalId);
                    enableClicking();
                }
            }, 1000);
        }, 1000);
    };
    function playBack () {
        for (var i = 0; i < playerClick.length; i++) {
            if (simonClick[i] != playerClick[i]){
                $(".toggle").css('display', 'block');
                simonClick = [];
                $("#rounds").text("round: " + simonClick.length);
                new Audio("/sound/losing.mp3").play();   
                break;
            }  
        }
            if (playerClick.length == simonClick.length){
                simonTurn();
            }
    }
        
        
    // This function lights up the squares chosen by the user or by simon
    function lightSquare (square) {
        square.addClass("lightSquare");
        setTimeout(function () {
            square.removeClass("lightSquare");
        }, 500);
        var i = (square.index());
        new Audio(baseUrl + audio[i]).play();
    };
    // This function will select what was clicked and it will 
    function playerClicked () {
        var playerPick = this.id;
        lightSquare($(this));
        playerClick.push(playerPick);
        playBack();
        };
    function enableClicking () {
        $square.on("click", playerClicked);
    };
    function disableClicking () {
        $square.off("click", playerClicked);
    };
})();
</script>
</body>
</html>