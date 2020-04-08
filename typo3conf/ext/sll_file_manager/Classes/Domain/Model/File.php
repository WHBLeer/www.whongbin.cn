<?php
namespace Sll\SllFileManager\Domain\Model;


/***
 *
 * This file is part of the "File Manager" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <info@whongbin.cn>, 三里林
 *
 ***/
/**
 * 文件管理
 */
class File extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 别名
     * 
     * @var string
     */
    protected $slug = '';

    /**
     * 文件大小
     * 
     * @var float
     */
    protected $size = 0.0;

    /**
     * 绝对路径
     * 
     * @var string
     */
    protected $absolutePath = '';

    /**
     * 相对路径
     * 
     * @var string
     */
    protected $relativePath = '';

    /**
     * 介绍
     * 
     * @var string
     */
    protected $teaser = '';

    /**
     * 下载次数
     * 
     * @var int
     */
    protected $download = 0;

    /**
     * 文件类型
     * 
     * @var int
     */
    protected $fileType = 0;

    /**
     * 文件后缀
     * 
     * @var string
     */
    protected $fileExtension = '';

    /**
     * Returns the title
     * 
     * @return string title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the slug
     * 
     * @return string slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     * 
     * @param string $slug
     * @return void
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Returns the size
     * 
     * @return float size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size
     * 
     * @param float $size
     * @return void
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Returns the absolutePath
     * 
     * @return string absolutePath
     */
    public function getAbsolutePath()
    {
        return $this->absolutePath;
    }

    /**
     * Sets the absolutePath
     * 
     * @param string $absolutePath
     * @return void
     */
    public function setAbsolutePath($absolutePath)
    {
        $this->absolutePath = $absolutePath;
    }

    /**
     * Returns the relativePath
     * 
     * @return string relativePath
     */
    public function getRelativePath()
    {
        return $this->relativePath;
    }

    /**
     * Sets the relativePath
     * 
     * @param string $relativePath
     * @return void
     */
    public function setRelativePath($relativePath)
    {
        $this->relativePath = $relativePath;
    }

    /**
     * Returns the teaser
     * 
     * @return string teaser
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Sets the teaser
     * 
     * @param string $teaser
     * @return void
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Returns the download
     * 
     * @return int download
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Sets the download
     * 
     * @param int $download
     * @return void
     */
    public function setDownload($download)
    {
        $this->download = $download;
    }

    /**
     * Returns the fileType
     * 
     * @return int fileType
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Sets the fileType
     * 
     * @param int $fileType
     * @return void
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    /**
     * Returns the fileExtension
     * 
     * @return string fileExtension
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Sets the fileExtension
     * 
     * @param string $fileExtension
     * @return void
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;
    }
}
