<?php
/***********************
 * 	Project		: rock-paper
 * 	Document	: IGame.php
 * 	@author		: Todd Mullen
 * 	Created		: Nov 18, 2016, 12:40:27 AM
 * 	Description	:
 * 		IGame defines an interface that game controllers must implement in order to interact with the
 *      rest of the application.
 * ********************* */

namespace RpsslBundle\interfaces;

/**
 *
 * @author Todd Mullen
 */
interface IGame
{

    /**
     * Returns a string representation of the computers next action / choice in the game implementation.
     *
     * @return string String description of the "chosen" action.
     */
    public function getNextAction();


    /**
     * Calculates and returns:
     *  +1 if the first input parameter $actionP1 "beats" the second input parameter
     *  0 if it's a "tie" or they are the same
     *  -1 if the second input "wins"
     * according to the rules of the game implementation.
     *
     * @param string $actionP1 The action chosen by player one.
     * @param string $actionP2 The action chosen by player two.
     * @return int +1 if $actionP1 "wins" over $actionP2, 0 if they're the same, -1 if $actionP2 "wins"
     */
    public function getResult( $actionP1, $actionP2 );


}


?>
