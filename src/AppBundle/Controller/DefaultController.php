<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Provides the welcoming view on the home / index of the game.
     * Retrieves & displays round stats if previous games have been recorded
     * Presents RPSSL option form to play a round.
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(

        ));
    }


    /**
     * Receives incoming user RPSSL choice
     * Retrieves a psuedo-random RPSSL choice to respond with
     * Delegates to compare user and random choices to determine winner
     * Adds new round results to the records
     * Returns round summary and round history summary
     *
     * @Route("/duel", name="duel")
     */
    public function duelAction(Request $request)
    {

        return $this->render('default/index.html.twig', array(
            
        ));
    }


    /**
     * Displays historical round results for all RPSSL players
     *
     * @Route("/history", name="history")
     */
    public function historyAction(Request $request)
    {

        return $this->render('default/summary.html.twig', array(

        ));
    }




}
