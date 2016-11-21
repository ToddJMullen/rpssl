<?php

namespace RpsslBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Round
 *
 * @ORM\Table(name="round")
 * @ORM\Entity(repositoryClass="RpsslBundle\Repository\RoundRepository")
 */
class Round
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_action", type="string", length=11)
     */
    private $userAction;

    /**
     * @var string
     *
     * @ORM\Column(name="random_action", type="string", length=11)
     */
    private $randomAction;

    /**
     * @var string
     *
     * @ORM\Column(name="winner", type="string", length=7)
     */
    private $winner;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userAction
     *
     * @param string $userAction
     * @return Round
     */
    public function setUserAction($userAction)
    {
        $this->userAction = $userAction;

        return $this;
    }

    /**
     * Get userAction
     *
     * @return string 
     */
    public function getUserAction()
    {
        return $this->userAction;
    }

    /**
     * Set randomAction
     *
     * @param string $randomAction
     * @return Round
     */
    public function setRandomAction($randomAction)
    {
        $this->randomAction = $randomAction;

        return $this;
    }

    /**
     * Get randomAction
     *
     * @return string 
     */
    public function getRandomAction()
    {
        return $this->randomAction;
    }

    /**
     * Set winner
     *
     * @param string $winner
     * @return Round
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return string 
     */
    public function getWinner()
    {
        return $this->winner;
    }
}
