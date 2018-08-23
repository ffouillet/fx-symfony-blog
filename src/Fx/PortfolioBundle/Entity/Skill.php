<?php

namespace Fx\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="Fx\PortfolioBundle\Repository\SkillRepository")
 */
class Skill
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="frontendSortOrder", type="integer", nullable=true, unique=true)
     */
    private $frontendSortOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Fx\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * TODO : Dependency with Fx\UserBundle\Entity\User... 
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Skill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set frontendSortOrder
     *
     * @param integer $frontendSortOrder
     *
     * @return Skill
     */
    public function setFrontendSortOrder($frontendSortOrder)
    {
        $this->frontendSortOrder = $frontendSortOrder;

        return $this;
    }

    /**
     * Get frontendSortOrder
     *
     * @return int
     */
    public function getFrontendSortOrder()
    {
        return $this->frontendSortOrder;
    }

    /**
     * Set user
     *
     * @param \Fx\UserBundle\Entity\User $user
     *
     * @return Skill
     */
    public function setUser(\Fx\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Fx\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
