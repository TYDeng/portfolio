class yatzyGame{//current state(dice) of the game
    constructor() {
        this.reRoll = 0; // Current Roll(for re-roll) state (0 for first roll, 1, 2)
        this.diceVal = []; // Current values on each of the 5 dice
        this.diceKeep = []; // Keep(or not)  state for dice
        this.scoreBoard = new scoreBoard();
    }

    initializeGame() {//initailize as zero state (dice not roll)[suggest with 6 '?' for all dices]
        this.reRoll = 0;
        this.diceVal = [0, 0, 0, 0, 0]; // Initialize with 5 dice values
        this.diceKeep = [false, false, false, false, false]; // Initialize all dice not roll
        //False in dicekeep for re-roll that dice in next turn
    }
}

class scoreBoard{//All current score of socreboard
    constructor(){
        this.lowerScore = 0;
        this.upperScore = 0;
        this.turn = 0;
        this.diceVal = [];
        this.diceKeep = [];
        this.scores = {
            //uppercase
            'Ones': 0,
            'Twos': 0,
            'Threes': 0,
            'Fours': 0,
            'Fives': 0,
            'Sixes': 0,

            //lowercase
            'One Pair': 0,
            'Two Pairs': 0,
            'Three of a Kind': 0,
            'Four of a Kind': 0,
            'Small Straight': 0,
            'Large Straight': 0,
            'Full House': 0,
            'Chance': 0,
            'Yatzy': 0
        };
        this.scoredCategories = new Set();  // Set to keep track of scored categories
        this.totalScore = 0;
    }

}