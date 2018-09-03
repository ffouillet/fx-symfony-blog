<?php

namespace Fx\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectCategory
 *
 * @ORM\Table(name="project_category")
 * @ORM\Entity(repositoryClass="Fx\PortfolioBundle\Repository\ProjectCategoryRepository")
 */
class ProjectCategory
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
     * @ORM\Column(name="frontendSortOrder", type="integer", nullable=true, unique=true)
     */
    private $frontendSortOrder;

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
     * @return ProjectCategory
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
     * Set frontendSortOrder
     *
     * @param integer $frontendSortOrder
     *
     * @return ProjectCategory
     */
    public function setFrontendSortOrder($frontendSortOrder)
    {
        $this->frontendSortOrder = $frontendSortOrder;

        return $this;
    }

    /**
     * Get frontendSortOrder
     *
     * @return integer
     */
    public function getFrontendSortOrder()
    {
        return $this->frontendSortOrder;
    }

    /**
     * Return the name of the projetCategory
     *
     * @return string
     */
    public function __toString(){
        return $this->name;
    }

}
