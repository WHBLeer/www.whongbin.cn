<?php
namespace Sll\SllNews\Domain\Model;

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sll_news') . 'Classes/Vender/Identicon/Identicon.php';

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 TaoJiang <ribeter267@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News{
    
    /**
     * reading
     * 阅读量
     * 
     * @var int
     */
    protected $reading = 0;

    /**
     * islike
     * 喜欢
     * 
     * @var int
     */
    protected $islike = 0;

    /**
     * dislike
     * 不喜欢
     * 
     * @var int
     */
    protected $dislike = 0;

    /**
     * 封面图
     * 
     * @var \Sll\SllFileManager\Domain\Model\File
     */
    protected $cover;

    /**
     * 封面图
     * 
     * @var string
     */
    protected $coverimg;

    /**
     * 封面图
     * 
     * @var string
     */
    protected $coverlist;

    /**
     * 作者图
     * 
     * @var string
     */
    protected $authorimg;

    /**
     * 附件
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sll\SllFileManager\Domain\Model\File>
     */
    protected $annexs;

    /**
     * 作者图
     * 
     * @var string
     */
    protected $tagclass;
    
    /**
     * Initialize categories and media relation
     *
     * @return \GeorgRinger\News\Domain\Model\News
     */
    public function __construct()
    {
        $this->annexs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
	
    /**
     * Returns the reading
     * 
     * @return int $reading
     */
    public function getReading()
    {
        return $this->reading;
    }

    /**
     * Sets the reading
     * 
     * @param int $reading
     * @return void
     */
    public function setReading($reading)
    {
        $this->reading = $reading;
    }

    /**
     * Returns the islike
     * 
     * @return int $islike
     */
    public function getIslike()
    {
        return $this->islike;
    }

    /**
     * Sets the islike
     * 
     * @param int $islike
     * @return void
     */
    public function setIslike($islike)
    {
        $this->islike = $islike;
    }

    /**
     * Returns the dislike
     * 
     * @return int $dislike
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Sets the dislike
     * 
     * @param int $dislike
     * @return void
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
    }
	
	/**
	 * Returns the cover
	 * 
	 * @return \Sll\SllFileManager\Domain\Model\File $cover
	 */
	public function getCover()
	{
		return $this->cover;
    }
    
    /**
	 * Returns the cover
	 * 
	 * @return string $coverimg
	 */
	public function getCoverimg()
	{
        if ($this->getCover()) {
            $this->coverimg = $this->getCover()->getRelativePath();
        } else {
            $random = rand(1,3350);
            // $this->coverimg = "https://picsum.photos/600/800?random=$random.jpg";
            // $this->coverimg = "https://wallpaper.infinitynewtab.com/wallpaper/$random.jpg";
            $this->coverimg = "https://acg.xydwz.cn/api/api.php?rand=$random";
        }
        return $this->coverimg;
    }
    
    /**
	 * Returns the coverlist
	 * 
	 * @return string $coverlist
	 */
	public function getCoverlist()
	{
        $random = rand(1,3350);
        // $this->coverlist = "https://picsum.photos/400/300?random=$random.jpg";
        // $this->coverlist = "https://wallpaper.infinitynewtab.com/wallpaper/$random.jpg";
        $this->coverlist = "https://acg.xydwz.cn/api/api.php?rand=$random";
        return $this->coverlist;
    }
    
    /**
	 * Returns the authorimg
	 * 
	 * @return string $authorimg
	 */
	public function getAuthorimg()
	{
        $identicon = new \Sll\SllNews\Method\Identicon();
        $this->authorimg = $identicon->getImageDataUri($this->getAuthor(),50);
        return $this->authorimg;
	}

	/**
	 * Sets the cover
	 * 
	 * @param \Sll\SllFileManager\Domain\Model\File $cover
	 * @return void
	 */
	public function setCover(\Sll\SllFileManager\Domain\Model\File $cover)
	{
		$this->cover = $cover;
	}
	
	
    /**
     * Adds a File
     * 
     * @param \Sll\SllFileManager\Domain\Model\File $annex
     * @return void
     */
    public function addAnnex(\Sll\SllFileManager\Domain\Model\File $annex)
    {
        $this->annexs->attach($annex);
    }

    /**
     * Removes a File
     * 
     * @param \Sll\SllFileManager\Domain\Model\File $annexToRemove The File to be removed
     * @return void
     */
    public function removeAnnex(\Sll\SllFileManager\Domain\Model\File $annexToRemove)
    {
        $this->annexs->detach($annexToRemove);
    }

    /**
     * Returns the annexs
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sll\SllFileManager\Domain\Model\File> $annexs
     */
    public function getAnnexs()
    {
        return $this->annexs;
    }

    /**
     * Sets the annexs
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Sll\SllFileManager\Domain\Model\File> $annexs
     * @return void
     */
    public function setAnnexs(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $annexs)
    {
        $this->annexs = $annexs;
    }
    
    /** 
	 * Returns the tagclass
	 * 
	 * @return string $tagclass
	 */
	public function getTagclass()
	{
        $classes = array('bg-secondary','bg-success','bg-warning','bg-danger');
        $this->tagclass = $classes[array_rand($classes)];
        return $this->tagclass;
	}
}