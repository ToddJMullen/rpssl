<?php

/***********************
 * 	Project		: rock-paper
 * 	Document	: RpsslController.php
 * 	@author		: Todd Mullen
 * 	Created		: Nov 18, 2016, 12:31:40 AM
 * 	Description	:
 * 		RpsslController provides a concrete implementation for accessing a generated response
 *      for Rock/paper/sccissors/Spock/lizards and processing the results.
 * ********************* */

namespace RpsslBundle;

use RpsslBundle\interfaces\IGame;

/**
 * RpsslController
 */
class RpsslController implements IGame
{


/////private vars/////
    protected $options = ["rock", "paper", "scissors", "spock", "lizard"];


/////public methods/////

    /**
     * Pick a psuedo-random RPSSL option to "throw"
     * @return string
     */
    public function getNextAction()
    {
            return $this->options[array_rand($this->options)];
    }

    /**
     * Provides a ternary result of a round of "player 1 vs player 2"
     * @param string $actionP1 player 1 action
     * @param string $actionP2 player 2 action
     * @return string "user" if $actionP1 wins, "cat" if a tie, "other" if $actionP1 loses
     */
    public function getResult($actionP1, $actionP2)
    {
        //defer to a Strategy for the calculation which could be a changeable or external service
        return $this->isGreaterThan( strtolower($actionP1), strtolower($actionP2) );
    }

/////"private" methods/////

    protected function isGreaterThan( $value1, $value2 )
    {
        if( !in_array($value1, $this->options) || !in_array($value2, $this->options) ){
            throw new \InvalidArgumentException(
                "Input values for 'isGreaterThan' comparison must be one of '" . implode(", ", $this->options)
                . "' Received '$value1' and '$value2' "

            );
        }

        if( $value1 == $value2 ){
            return "cat";
        }

        switch( $value1 ){
            case "rock":
                return in_array($value2, ['lizard','scissors']) ? "user" : "other";
            case "paper":
                return in_array($value2, ['rock','spock']) ? "user" : "other";
            case "scissors":
                return in_array($value2, ['paper','lizard']) ? "user" : "other";
            case "spock":
                return in_array($value2, ['rock','scissors']) ? "user" : "other";
            case "lizard":
                return in_array($value2, ['spock','paper']) ? "user" : "other";
            default:
                throw new \InvalidArgumentException(
                "Unhandled comparison combination '$value1' ?> '$value2'"
                );
        }

    }


}


//End RpsslController

