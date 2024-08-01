function diceRoll(){
    // Generate a random number between 1 and 6
    return Math.floor(Math.random() * 6) + 1;
}


function allDiceRoll(game){//perform a roll/re-roll function for picked dices by user
    if(game.reRoll <= 2){//not reach the re-roll limitation
        let diceKeep = game.diceKeep;
        for (let i = 0; i < 5; i++){
            if(!diceKeep[i]){
                game.diceVal[i] = diceRoll();
            }
        }
        game.reRoll += 1;
    }else{
        alert("No re-roll chances");
    }

    //reset dice keeper state as true (not picked)
    for (let i = 0; i < 5; i++){
        game.diceKeep[i] = true;
    }
}

