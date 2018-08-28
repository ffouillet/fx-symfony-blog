<?php 

namespace Fx\CoreBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Base class for Entities that could have multiple Image (eg FxPortfolioBundle:Project)
 */
abstract class Image {

	protected $image;
    protected $imageFile;

	abstract protected function setImageFile(File $image = null);

    abstract protected function getImageFile();

    abstract protected function setImage($image);

    abstract protected function getImage();
}