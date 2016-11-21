<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RpsslBundle\RpsslController;
use RpsslBundle\Entity\Round;

/**
 * @Route("rpssl")
 */
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
        return $this->forward("AppBundle:Default:history");
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

        $userAction     = $request->request->get("action");

        if( !$userAction ){
            return $this->redirectToRoute("history");
        }

        //else we have a round to execute
        $ai = new RpsslController();

        $randomAction   = $ai->getNextAction();

        $winner         =  $ai->getResult($userAction, $randomAction);

        //Now we have to record it

        $round = new Round();
        $round->setUserAction($userAction);
        $round->setRandomAction($randomAction);
        $round->setWinner($winner);

        $em = $this->getDoctrine()->getManager();
        $em->persist($round);
        $em->flush($round);


        $rounds = $em->getRepository('RpsslBundle:Round')->findAll();


        return $this->render('default/index.html.twig', array(
            "userAction"    => $userAction,
            "randomAction"  => $randomAction,
            "winner"        => $this->interpretResult($winner),
            "rounds"        => $rounds
        ));
    }


    /**
     * Displays historical round results for all RPSSL players
     *
     * @Route("/list", name="list")
     * @Route("/history", name="history")
     */
    public function historyAction(Request $request)
    {
        $rounds = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('RpsslBundle:Round')
                    ->findAll();

        return $this->render('default/summary.html.twig', array(
            "rounds"   => $rounds
        ) );

    }


/////private methods/////

    protected function interpretResult($result)
    {
        switch( $result ){
            case 1: return "You won!";
            case 0: return "It's A Tie";
            case -1: return "You lost.";
            default:
                throw new \InvalidArgumentException("Bermuda triangle result '$result' cannot be interpreted");
        }
    }



}
