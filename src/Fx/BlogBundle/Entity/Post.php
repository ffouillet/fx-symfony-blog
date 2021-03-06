<?php

namespace Fx\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Fx\BlogBundle\Repository\PostRepository")
 */
class Post
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="heading", type="string", length=255)
     */
    private $heading;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Fx\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Fx\BlogBundle\Entity\Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Fx\BlogBundle\Entity\PostCategory")
     * @ORM\JoinColumn(nullable=true)
     */
    private $postCategory;

    public function __construct() {
        $this->createdAt = new \DateTime();
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
     * Set title
     *
     * @param string $title
     *
     * @return Post
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
     * Set heading
     *
     * @param string $heading
     *
     * @return Post
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get heading
     *
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Set user
     *
     * @param string $user
     *
     * @return Post
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
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
     * Set postCategory
     *
     * @param \Fx\BlogBundle\Entity\PostCategory $postCategory
     *
     * @return Post
     */
    public function setPostCategory(\Fx\BlogBundle\Entity\PostCategory $postCategory = null)
    {
        $this->postCategory = $postCategory;

        return $this;
    }

    /**
     * Get postCategory
     *
     * @return \Fx\BlogBundle\Entity\PostCategory
     */
    public function getPostCategory()
    {
        return $this->postCategory;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Add postCategory
     *
     * @param \Fx\BlogBundle\Entity\PostCategory $postCategory
     *
     * @return Post
     */
    public function addPostCategory(\Fx\BlogBundle\Entity\PostCategory $postCategory)
    {
        $this->postCategory[] = $postCategory;

        return $this;
    }

    /**
     * Remove postCategory
     *
     * @param \Fx\BlogBundle\Entity\PostCategory $postCategory
     */
    public function removePostCategory(\Fx\BlogBundle\Entity\PostCategory $postCategory)
    {
        $this->postCategory->removeElement($postCategory);
    }

    /**
     * Add comment
     *
     * @param \Fx\BlogBundle\Entity\Post $comment
     *
     * @return Post
     */
    public function addComment(\Fx\BlogBundle\Entity\Post $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Fx\BlogBundle\Entity\Post $comment
     */
    public function removeComment(\Fx\BlogBundle\Entity\Post $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
