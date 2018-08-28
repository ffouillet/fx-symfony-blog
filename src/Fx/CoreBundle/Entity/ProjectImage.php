<?php

namespace Fx\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * ProjectImage
 *
 * @ORM\Table(name="project_image")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class ProjectImage extends Image {

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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="altAttribute", type="string", length=255, nullable=true)
     */
    private $altAttribute;

    /**
     * @ORM\Column(name="image", type="string", length=255)
     * @var string
     */
    protected $image;

    /**
     * @Vich\UploadableField(mapping="projects_images", fileNameProperty="image")
     * @var File
     */
    protected $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="Fx\PortfolioBundle\Entity\Project", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="is_main_thumb", type="boolean")
     */
    private $isMainThumb = false;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

	/**
     * Get id
     *
     * @return int
     */
	public function getId() {
		return $this->id;
	}

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set isMainThumb
     *
     * @param boolean $isMainThumb
     *
     * @return ProjectImage
     */
    public function setIsMainThumb($isMainThumb)
    {
        $this->isMainThumb = $isMainThumb;

        return $this;
    }

    /**
     * Get isMainThumb
     *
     * @return boolean
     */
    public function getIsMainThumb()
    {
        return $this->isMainThumb;
    }

    /**
     * Set project
     *
     * @param \Fx\PortfolioBundle\Entity\Project $project
     *
     * @return ProjectImage
     */
    public function setProject(\Fx\PortfolioBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Fx\PortfolioBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ProjectImage
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ProjectImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set altAttribute
     *
     * @param string $altAttribute
     *
     * @return ProjectImage
     */
    public function setAltAttribute($altAttribute)
    {
        $this->altAttribute = $altAttribute;

        return $this;
    }

    /**
     * Get altAttribute
     *
     * @return string
     */
    public function getAltAttribute()
    {
        return $this->altAttribute;
    }
}
