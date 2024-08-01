function calScore(game, scoreBox) {//score of a specific turn for specfic scoreBox
    const diceVal = game.diceVal; // List of value of all dices
    let countVal = {}; // Initialize countVal as an object
    diceVal.forEach(val => { // Count all val appearance times
        countVal[val] = (countVal[val] || 0) + 1;
    });
    let score = 0;

    switch (scoreBox) { //calculate correspond box's score
        //Upper section
        case 'Ones':
            score = specificNum(diceVal, 1);
            break;
        case 'Twos':
            score = specificNum(diceVal, 2);
            break;
        case 'Threes':
            score = specificNum(diceVal, 3);
            break;
        case 'Fours':
            score = specificNum(diceVal, 4);
            break;
        case 'Fives':
            score = specificNum(diceVal, 5);
            break;    
        case 'Sixes':
            score = specificNum(diceVal, 6);
            break;
        
        //Lower section
        case 'One-Pair':

            let LargestPair = 0;
            //Find largest pair of val in 5 dices
            for (let val in countVal) {
                if (countVal[val] >= 2 && parseInt(val) > LargestPair) {
                    LargestPair = parseInt(val);
                }
            }
            score = LargestPair * 2;
           
            break;

        case 'Two-Pairs':
            let pairs = [];
            for (let val in countVal) {
                if (countVal[val] >= 2) {
                    pairs.push(parseInt(val));
                }
            }
            if (pairs.length >= 2) {
                //pairs.sort((a, b) => b - a);
                score = pairs[0]*2 + pairs[1]*2;
            }
            break;

        case 'Three-of-a-Kind':
            for (let val in countVal) {
                if (countVal[val] >= 3) {
                    score = val;
                }
            }
            score = score*3;
            break;

        case 'Four-of-a-Kind':
            for (let val in countVal) {
                if (countVal[val] >= 4) {
                    score = val;
                }
            }
            score = score*4;
            break;

        case 'Small-Straight':
            if (diceVal.toSorted() == [1, 2, 3, 4, 5])
                score = 15;
            break;

        case 'Large-Straight':
            if (diceVal.toSorted() == [2, 3, 4, 5, 6])
                score = 20;
            break;

        case 'Full-House':
            let combThree = 0;
            let combTwo = 0;
            for (let val in countVal) {
                if (countVal[val] === 3) combThree = val;
                if (countVal[val] === 2) combTwo = val;
            }
            if(combThree != 0 && combTwo != 0)
                score = combThree*3 + combTwo*2; 
            break;

        case 'Chance':
            for (let val in countVal) {
                score = score + countVal[val]*val;
            }
            
            break;  

        case 'Yatzy':
            for (let val in countVal) {
                if (countVal[val] === 5) score = 50;
            }
            break;

        default:
            score = 0;
            break;
    }

    return score;
}

//Calculate the sum of a specific number in dice values
function specificNum(diceVal, number) {
    return diceVal.reduce((sum, value) => value === number ? sum + number : sum, 0);
}

//Update the total score for current game
function totalScore(scoreBoard) {
    if(scoreBoard.lowerScore >= 63) scoreBoard.totalScore =+ 50;
}