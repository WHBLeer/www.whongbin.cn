<?php
namespace Sll\Common\ViewHelpers;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder;

/**
 * Resizes a given image (if required) and renders the respective img tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <f:image src="EXT:myext/Resources/Public/typo3_logo.png" alt="alt text" />
 * </code>
 * <output>
 * <img alt="alt text" src="typo3conf/ext/myext/Resources/Public/typo3_logo.png" width="396" height="375" />
 * or (in BE mode):
 * <img alt="alt text" src="../typo3conf/ext/viewhelpertest/Resources/Public/typo3_logo.png" width="396" height="375" />
 * </output>
 *
 * <code title="Image Object">
 * <f:image image="{imageObject}" />
 * </code>
 * <output>
 * <img alt="alt set in image record" src="fileadmin/_processed_/323223424.png" width="396" height="375" />
 * </output>
 *
 * <code title="Inline notation">
 * {f:image(src: 'EXT:viewhelpertest/Resources/Public/typo3_logo.png', alt: 'alt text', minWidth: 30, maxWidth: 40)}
 * </code>
 * <output>
 * <img alt="alt text" src="../typo3temp/pics/f13d79a526.png" width="40" height="38" />
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="non existing image">
 * <f:image src="NonExistingImage.png" alt="foo" />
 * </code>
 * <output>
 * Could not get image resource for "NonExistingImage.png".
 * </output>
 */
class ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'img';

    /**
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     * @inject
     */
    protected $imageService;

    /**
     * Initialize arguments.
     *
     * @see https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Image/
     * @param string $src a path to a file, a combined FAL identifier or an uid (int). If $treatIdAsReference is set, the integer is considered the uid of the sys_file_reference record. If you already got a FAL object, consider using the $image parameter instead
     * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param int $minWidth minimum width of the image
     * @param int $minHeight minimum height of the image
     * @param int $maxWidth maximum width of the image
     * @param int $maxHeight maximum height of the image
     * @param bool $treatIdAsReference given src argument is a sys_file_reference record
     * @param FileInterface|AbstractFileFolder $image a FAL object
     * @param string|bool $crop overrule cropping of image (setting to FALSE disables the cropping set in FileReference)
     * @param bool $absolute Force absolute URL
     * @param int $mobileWidth
     * @param int $mobileHeight
     * @param int $mobileMaxWidth
     * @param int $mobileMaxHeight
     * 
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('src', 'string', 'a path to a file', true);
        $this->registerArgument('width', 'string', 'width of the image', false);
        $this->registerArgument('height', 'string', 'height of the image', false);
        $this->registerArgument('minWidth', 'int', 'minimum width of the image', false);
        $this->registerArgument('minHeight', 'int', 'minimum height of the image', false);
        $this->registerArgument('maxWidth', 'int', 'maximum width of the image', false);
        $this->registerArgument('maxHeight', 'int', 'maximum height of the image', false);
        $this->registerArgument('treatIdAsReference', 'bool', 'Force absolute URL', false,false);
        $this->registerArgument('absolute', 'bool', 'content', false,false);
        $this->registerArgument('mobileWidth', 'int', 'mobileWidth', false);
        $this->registerArgument('mobileHeight', 'int', 'mobileHeight', false);
        $this->registerArgument('mobileMaxWidth', 'int', 'mobileMaxWidth', false);
        $this->registerArgument('mobileMaxHeight', 'int', 'mobileMaxHeight', false);
        
        $this->registerTagAttribute('alt', 'string', 'Specifies an alternate text for an image', false);
        $this->registerTagAttribute('ismap', 'string', 'Specifies an image as a server-side image-map. Rarely used. Look at usemap instead', false);
        $this->registerTagAttribute('longdesc', 'string', 'Specifies the URL to a document that contains a long description of an image', false);
        $this->registerTagAttribute('usemap', 'string', 'Specifies an image as a client-side image-map', false);
    }
    /**
     * Resizes a given image (if required) and renders the respective img tag
     *
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @return string Rendered tag
     */
    public function render()
    {
        $src = $this->arguments['src'];
        $width = $this->arguments['width'];
        $height = $this->arguments['height'];
        $minWidth = $this->arguments['minWidth'];
        $minHeight = $this->arguments['minHeight'];
        $maxWidth = $this->arguments['maxWidth'];
        $maxHeight = $this->arguments['maxHeight'];
        $treatIdAsReference= $this->arguments['treatIdAsReference'];
        $absolute = $this->arguments['absolute'];
        $mobileWidth = $this->arguments['mobileWidth'];
        $mobileHeight = $this->arguments['mobileHeight'];
        $mobileMaxWidth = $this->arguments['mobileMaxWidth'];
        $mobileMaxHeight = $this->arguments['mobileMaxHeight'];
        
        if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must either specify a string src or a File object.', 1382284106);
        }
        $image = $this->imageService->getImage($src, $image, $treatIdAsReference);
        if ($crop === null) {
            $crop = $image instanceof FileReference ? $image->getProperty('crop') : null;
        }

        if(GeneralUtility::_GET('mobile')){
            if($mobileWidth){
                $width = $mobileWidth;
            }
            if($mobileHeight){
                $height = $mobileHeight;
            }
            if($mobileMaxWidth){
                $maxWidth = $mobileMaxWidth;
            }
            if($mobileMaxHeight){
                $maxHeight = $mobileMaxHeight;
            }
        }

        $processingInstructions = array(
            'width' => $width,
            'height' => $height,
            'minWidth' => $minWidth,
            'minHeight' => $minHeight,
            'maxWidth' => $maxWidth,
            'maxHeight' => $maxHeight,
            'crop' => $crop,
            'mobile' => GeneralUtility::_GET('mobile')?1:0
        );
        $processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
        $imageUri = $this->imageService->getImageUri($processedImage, $absolute);

        $this->tag->addAttribute('src', $imageUri);
        $this->tag->addAttribute('width', $processedImage->getProperty('width'));
        $this->tag->addAttribute('height', $processedImage->getProperty('height'));

        $alt = $image->getProperty('alternative');
        $title = $image->getProperty('title');

        // The alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
        if (empty($this->arguments['alt'])) {
            $this->tag->addAttribute('alt', $alt);
        }
        if (empty($this->arguments['title']) && $title) {
            $this->tag->addAttribute('title', $title);
        }

        return $this->tag->render();
    }
}
