<?php
    $assets = [
        'rock' => [1, 'scissors', 'lizard'],
        'paper' => [2, 'rock', 'spock'],
        'scissors' => [3, 'paper', 'lizard'],
        'lizard' => [4, 'paper', 'spock'],
        'spock' => [5, 'rock', 'scissors']
    ];
    $keys = array_keys($assets);
    $gameOn = true;
    function playAgain(): bool
    {
        $userInput = strtolower(readline("Still wanna play? Y?: "));
        if($userInput === "y" || $userInput === "yes"){
            return true;
        }
        return false;
    }
    function resultNotificationPrint($computer, $player, $state): void
    {
        echo "\nComputer: " . $computer . " VS " . "Player: " . $player . "\n";
        echo $player . " " . $state . " " . $computer . "\n";
        switch($state){
            case 'beats':
                echo "Player Wins! :))\n";
                break;
            case 'ties':
                echo "No one Wins.. :(\n";
                break;
            case 'looses':
                echo "Computer Wins.. :(\n";
                break;
        }

    }

    while($gameOn) {
        $computer = (string) array_rand($assets); //randomly select the computers asset

        if(!isset($didWrongInput)) { //print this only if there was no wrong input from user previously
            echo "Select Your Asset!:\n";
            foreach ($assets as $asset) {
                echo "[ " . $asset[0] . ": " . $keys[$asset[0]-1] . " ]";//echoing out options from asset table
            }
        }
        echo "\n";//this is to beautifully present the input line to user in the new line
        $user_input = (int) readline("Make Your fatal choice!: ");

        if ($user_input <= count($assets) && $user_input >= 1) {//input validation
            $player = $keys[$user_input-1]; //retrieve player asset by his option

            if(in_array($computer, $assets[$player])) { //check if player wins
                $state = 'beats';
            } elseif($computer == $player) { //check if tie
                $state = 'ties';
            } else {
                $state = 'looses'; //if nothing from above, player looses
            }
            resultNotificationPrint($computer, $player, $state);
            $gameOn = playAgain();

        } else {
            //inform user and return to selection
            echo "\nInvalid input! Check Options and Try again!\n";
            $gameOn = playAgain();
            $didWrongInput = true;//set the variable to assess wrong input from user
        }
    }