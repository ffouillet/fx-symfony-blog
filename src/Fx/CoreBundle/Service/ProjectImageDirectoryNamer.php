<?php

namespace Fx\CoreBundle\Service;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Fx\CoreBundle\Entity\ProjectImage;

class ProjectImageDirectoryNamer implements DirectoryNamerInterface
{
    /**
     * Returns the name of a directory where project's images will be uploaded
     *
     * Directory name is formed based on project name
     *
     * @param ProjectImage $projectImage
     * @param PropertyMapping $mapping
     *
     * @return string
     */
    public function directoryName($projectImage, PropertyMapping $mapping)
    {
        $projectName = $projectImage->getProject()->getName();

        $directoryName = FxStringsTools::quickSlugify($projectName);

        return $directoryName;
    }
}