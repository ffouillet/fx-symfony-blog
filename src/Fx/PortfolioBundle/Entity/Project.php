<?php

namespace Fx\PortfolioBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Fx\PortfolioBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="realizedAt", type="date")
     */
    private $realizedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="realizedAtDisplayString", type="string", length=255, nullable=true)
     */
    private $realizedAtDisplayString;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var int
     *
     * @ORM\Column(name="frontendSortOrder", type="integer", nullable=true, unique=true)
     */
    private $frontendSortOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Fx\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Fx\PortfolioBundle\Entity\ProjectCategory", cascade={"persist"})
     */
    private $projectCategories;

    /**
     * @ORM\OneToMany(targetEntity="Fx\CoreBundle\Entity\ProjectImage", mappedBy="project", cascade={"persist"}, orphanRemoval = true)
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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
     * @return Project
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set realizedAt
     *
     * @param \DateTime $realizedAt
     *
     * @return Project
     */
    public function setRealizedAt($realizedAt)
    {
        $this->realizedAt = $realizedAt;

        return $this;
    }

    /**
     * Get realizedAt
     *
     * @return \DateTime
     */
    public function getRealizedAt()
    {
        return $this->realizedAt;
    }

    /**
     * Set realizedAtDisplayString
     *
     * @param string $realizedAtDisplayString
     *
     * @return Project
     */
    public function setRealizedAtDisplayString($realizedAtDisplayString)
    {
        $this->realizedAtDisplayString = $realizedAtDisplayString;

        return $this;
    }

    /**
     * Get realizedAtDisplayString
     *
     * @return string
     */
    public function getRealizedAtDisplayString()
    {
        return $this->realizedAtDisplayString;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Project
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set frontendSortOrder
     *
     * @param integer $frontendSortOrder
     *
     * @return Project
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
     * @return Project
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

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Project
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }



    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param \Fx\CoreBundle\Entity\ProjectImage $image
     *
     * @return Project
     */
    public function addImage(\Fx\CoreBundle\Entity\ProjectImage $image)
    {
        $this->images[] = $image;

        $image->setProject($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Fx\CoreBundle\Entity\ProjectImage $image
     */
    public function removeImage(\Fx\CoreBundle\Entity\ProjectImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Return images' main thumb for front.
     */
    public function getMainThumb()
    {
        $images = $this->getImages();

        // Only one image
        if (sizeof($images) == 1) {
            return $images[0];
        }

        $imagesHasMainThumb = false;

        foreach($images as $image) {
            if ($image->getIsMainThumb()) {
                return $image;
            }
        }

        if (!$imagesHasMainThumb) {
            return $images[0]; // Multiple image but none have the isMainThumb attribute to true.
        }
    }



    /**
     * Add projectCategory
     *
     * @param \Fx\PortfolioBundle\Entity\ProjectCategory $projectCategory
     *
     * @return Project
     */
    public function addProjectCategory(\Fx\PortfolioBundle\Entity\ProjectCategory $projectCategory)
    {
        $this->projectCategories[] = $projectCategory;

        return $this;
    }

    /**
     * Remove projectCategory
     *
     * @param \Fx\PortfolioBundle\Entity\ProjectCategory $projectCategory
     */
    public function removeProjectCategory(\Fx\PortfolioBundle\Entity\ProjectCategory $projectCategory)
    {
        $this->projectCategories->removeElement($projectCategory);
    }

    /**
     * Get projectCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectCategories()
    {
        return $this->projectCategories;
    }
}
