<?php
namespace Sll\SllNews\Controller;


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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Sll\SllNews\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
require_once ExtensionManagementUtility::extPath('sll_news') . 'Classes/Vender/GetPinYin.php';
require_once ExtensionManagementUtility::extPath('sll_news') . 'Classes/Vender/GetOnlyWord.php';
/**
 * NewsController
 */
class NewsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
	 * @var \Sll\SllNews\Domain\Repository\NewsRepository
	 * @inject
	 */
	protected $newsRepository;


	/**
	 * @var \Sll\SllNews\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;


	/**
	 * @var \Sll\SllNews\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;

	/**
	 * 文件路径,物理路径
	 */
	protected $filepath='';

	/**
	 * 文件链接,相对路径
	 */
	protected $filelink='';

	/**
	 * 执行前提
	 *
	 * @return void
	 * @author wanghongbin <wanghongbin@ngoos.org>
	 * @since
	 */
    public function initializeAction()
    {
		if($this->request->hasArgument('news')) {
			$propertyMappingConfiguration = $this->arguments->getArgument('news')->getPropertyMappingConfiguration();
			//时间类型修改
			$propertyMappingConfiguration->forProperty('datetime')->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d H:i' );
		}

		$this->filelink = '/uploads/tx_sllnews/'.date('Y').'/'.date('m').'/'.date('d').'/';
		$this->filepath = PATH_site . $this->filelink;
		if (!is_dir($this->filepath)) mkdir($this->filepath, 755, true);
    }
    
	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {

		// $pageRepository = new \TYPO3\CMS\Frontend\Page\PageRepository();
		// $pageRepository->init(false);
		// $rows = $pageRepository->getMenu(1);
		// dump($rows);
		// $rows = $pageRepository->getMenu(3);
		// dump($rows);
		// $rows = $pageRepository->getMenu(13);
		// $rows = $this->getTreePids(3);
		// dump($rows);
		if($_GET["tx_sllnews_news"]["@widget_0"]["currentPage"]){
			$page=$_GET["tx_sllnews_news"]["@widget_0"]["currentPage"];
		}else{
			$page=1;
		}
		$keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
		$categories = $this->categoryRepository->findByParent($this->settings['listType']);
		$newss = $this->newsRepository->findAllOrdering($categories, $keyword);
		$this->view->assign('keyword', $keyword);
		$this->view->assign('newss', $newss);
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
		$this->view->assign('page', $page);
	}
	public function getTreePids($parent = 0, $as_array = true){
		$depth = 999999;
		$queryGenerator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance( 'TYPO3\\CMS\\Core\\Database\\QueryGenerator' );
		$childPids = $queryGenerator->getTreeList($parent, $depth, 0, 1); //Will be a string like 1,2,3
		dump($childPids);
		if($as_array) {
			$childPids = explode(',',$childPids );
		}
		return $childPids;
	}

	/**
	 * action index
	 * 列表
	 * 
	 * @return void
	 */
	public function indexAction() {
		$newss = $this->newsRepository->findIndexFeatured();
		$this->view->assign('newss', $newss);

		$lists = $this->newsRepository->findIndexLists();
		$this->view->assign('lists', $lists);
	}

	/**
	 * action felist
	 * 列表
	 * 
	 * @return void
	 */
	public function felistAction() {

		// if($_GET["tx_sllnews_news"]["@widget_0"]["currentPage"]){
		// 	$page=$_GET["tx_sllnews_news"]["@widget_0"]["currentPage"];
		// }else{
		// 	$page=1;
		// }
		// $keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
		// $categories = $this->categoryRepository->findByParent($this->settings['listType']);
		// // dump($categories);
		// $newss = $this->newsRepository->findAllOrdering($categories, $keyword);
		// // dump($newss);
		// $this->view->assign('keyword', $keyword);
		// $this->view->assign('newss', $newss);
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
		// $this->view->assign('page', $page);
	}

	/**
	 * action roosters
	 * 宫格
	 * 
	 * @return void
	 */
	public function roostersAction() {

		if($_GET["tx_sllnews_news"]["@widget_0"]["currentPage"]){
			$page=$_GET["tx_sllnews_news"]["@widget_0"]["currentPage"];
		}else{
			$page=1;
		}
		$keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
		$categories = $this->categoryRepository->findByParent($this->settings['listType']);
		$newss = $this->newsRepository->findAllOrdering($categories, $keyword);
		$this->view->assign('keyword', $keyword);
		$this->view->assign('newss', $newss);
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
		$this->view->assign('page', $page);
	}

	/** 
	 * action searchResult
	 * 搜索集合
	 *
	 * @return void
	 * @author wanghongbin <wanghongbin@ngoos.org>
	 * @since
	 */
	public function searchResultAction()
	{
		# code...
	}

	/**
	 * action detail
	 *
	 * @param \Sll\SllNews\Domain\Model\News $news
	 * @return void
	 * @author wanghongbin <wanghongbin@ngoos.org>
	 * @since
	 */
	public function detailAction(\Sll\SllNews\Domain\Model\News $news)
	{
		dump($news);
		$this->view->assign('newsItem', $news);
	}

	public function ajaxAction()
	{
        $cmd = GeneralUtility::_GP('cmd');
		if ($cmd=='getFelistItem') {
			$page = GeneralUtility::_GP('page');
			$paginate = $this->settings['paginateFe'];
			$offset = ($page - 1) * $paginate['itemsPerPage'];
			$limit = (int) $paginate['itemsPerPage'];
			$categories = $this->categoryRepository->findByParent($this->settings['listType']);
			$newss = $this->newsRepository->findByPaginate($categories,$offset,$limit);
			$items = array();
			foreach ($newss as $key => $news) {
				$typolink = $this->getTypoLink($this->settings['previewPid']);
				$typolink = substr_replace($typolink, '/'.$news->getPathSegment().'.html', -5);
				$categorys = array();
				foreach ($news->getCategories() as $k => $c) {
					$categorys[] = '<span class="post-category text-white '.$news->getTagclass().' mb-3">'.$c->getTitle().'</span>';
				}
				$itemData = array(
					'LINK' 		=> $typolink,
					'IMGSRC' 	=> $news->getCoverlist(),
					'CATEGORYS' => implode('',$categorys),
					'TITLE' 	=> $news->getTitle(),
					'AUTHORIMG' => $news->getAuthorimg(),
					'AUTHOR' 	=> $news->getAuthor(),
					'DATETIME' 	=> $news->getDatetime()->format('M d, Y'),
				);
				$felistItem = file_get_contents(ExtensionManagementUtility::extPath('sll_news') . '/Resources/Private/Templates/AjaxItem/Felist.item');
				foreach ($itemData as $key => $value) {
					$felistItem = str_replace('###' . $key . '###', $value, $felistItem);
				}
				$items[] = $felistItem;
			}
			exit(implode($items));
		}
	}

	/**
	 * action new
	 * 
	 * @param \Sll\SllNews\Domain\Model\News $newNews
	 * @ignorevalidation $newNews
	 * @return void
	 */
	public function newAction(\Sll\SllNews\Domain\Model\News $news=NULL) {

		if(empty($news)){
			$news = new \Sll\SllNews\Domain\Model\News();
			$news->setDatetime(new \DateTime());
			$news->setAuthor($GLOBALS['TSFE']->fe_user->user['name']);
		}
		$this->view->assign('news', $news);
		$this->view->assign('categories',$this->categoryRepository->findByParent($this->settings['listType']));
	}

	/**
	 * action create
	 * 
	 * @param \Sll\SllNews\Domain\Model\News $news
	 * @return void
	 */
	public function createAction(\Sll\SllNews\Domain\Model\News $news) {
		$albumFile = $this->request->hasArgument('album')?$this->request->getArgument('album'):[];
		if ($albumFile['error']==0) {
			/** @var \Sll\SllFileManager\Controller\FileController $fileContr*/
			$fileControllor = $this->objectManager->get(\Sll\SllFileManager\Controller\FileController::class);
			$fileobj = $fileControllor->addFile($albumFile,['path'=>$this->filepath,'link'=>$this->filelink]);
			if ($fileobj) $news->setCover($fileobj);
		}

		$annexFiles = $this->request->hasArgument('annex')?$this->request->getArgument('annex'):[];
		if (count($annexFiles)>0) {
			for ($i=0; $i < count($annexFiles); $i++) { 
				$fileobj = $fileControllor->addFile($annexFiles[$i],['path'=>$this->filepath,'link'=>$this->filelink]);
				$news->addAnnex($fileobj);
			}
		}

		$wz = new \Sll\SllNews\Method\GetOnlyWord();
		$news->setPathSegment($wz->strFilter($news->getTitle()));
		$news->setTeaser(($news->getTeaser()!='') ? $news->getTeaser() : $wz->csubstr($news->getBodytext(), 120));
		// dump($news);exit;
		$this->newsRepository->add($news);

		$this->addFlashMessage('保存成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->redirect('list');
	}

	/**
	 * action edit
	 * 
	 * @param \Sll\SllNews\Domain\Model\News $news
	 * @ignorevalidation $news
	 * @return void
	 */
	public function editAction(\Sll\SllNews\Domain\Model\News $news) {
		$this->view->assign('news', $news);
		$this->view->assign('categories',$this->categoryRepository->findByParent($this->settings['listType']));
	}

	/**
	 * action update
	 * 
	 * @param \Sll\SllNews\Domain\Model\News $news
	 * @return void
	 */
	public function updateAction(\Sll\SllNews\Domain\Model\News $news) {
		// dump($news);exit;
        /** @var \Sll\SllFileManager\Controller\FileController $fileContr*/
        $fileControllor = $this->objectManager->get(\Sll\SllFileManager\Controller\FileController::class);
        $albumFile = $this->request->hasArgument('album')?$this->request->getArgument('album'):[];
        if ($albumFile['error']==0) {
            $fileobj = $fileControllor->addFile($albumFile,['path'=>$this->filepath,'link'=>$this->filelink]);
            if ($fileobj) {
            	//删除原文件
            	$fileControllor->delFile($news->getAlbum());
            	//存储新文件
				$news->setCover($fileobj);
			}
        }
        $annexFiles = $this->request->hasArgument('annex')?$this->request->getArgument('annex'):[];
        if (count($annexFiles)>0) {
            for ($i=0; $i < count($annexFiles); $i++) { 
                $fileobj = $fileContro->addFile($annexFiles[$i],['path'=>$this->filepath,'link'=>$this->filelink]);
                $news->addAnnex($fileobj);
            }
        }
        
        $wz = new \Sll\SllNews\Method\GetOnlyWord();
        $news->setPathSegment($wz->strFilter($news->getTitle()));
        $news->setTeaser(($news->getTeaser()!='') ? $news->getTeaser() : $wz->csubstr($news->getBodytext(), 120));
        $this->newsRepository->update($news);
        $this->addFlashMessage('文章编辑成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('list');
	}

	/**
	 * action delete
	 * 
	 * @param \Sll\SllNews\Domain\Model\News $news
	 * @return void
	 */
	public function deleteAction(\Sll\SllNews\Domain\Model\News $news) {
        $this->addFlashMessage('删除成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->newsRepository->remove($news);
		//刷新前台缓存
        GeneralUtility::makeInstance(CacheManager::class)->flushCachesInGroup('pages');
		$this->redirect('list');
	}
	
	
	/**
	 * 批量删除
	 * @return void
	 */
	public function multideleteAction(){
	
		$items = $this->request->hasArgument('datas') ? $this->request->getArgument('datas') : array();
		if($items['items']){
			$item =  substr($items['items'], 0, strlen($items['items']) - 1);
			$iRet = $this->newsRepository->deleteByUidstring($item);
			if($iRet>0){
			    $this->addFlashMessage('删除成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
			    //刷新前台缓存
			    GeneralUtility::makeInstance(CacheManager::class)->flushCachesInGroup('pages');
			}else{
			    $this->addFlashMessage('删除失败！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			}
            $this->redirect('list');
		}
        $this->addFlashMessage('没有可删除对象！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->redirect('list');
	}
    
	/**
	 * 构成typo3的链接
	 *
	 * @param [type] $pageUid
	 * @param array $arguments
	 * @param integer $cache
	 * @param boolean $absoluteUri
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-04-02
	 */
    private function getTypoLink($pageUid, $arguments = [], $cache = 1, $absoluteUri = true)
    {
        if ($pageUid == '' || intval($pageUid) <= 0) {
            return false;
        }
        $conf = [];
        $conf['useCacheHash'] = $cache;
        $conf['no_cache'] = 0;
        $conf['parameter'] = $pageUid;
        if (!empty($arguments)) {
            $conf['additionalParams'] = GeneralUtility::implodeArrayForUrl('', [['tx_sllnews_news' => $arguments]], '', true);
        }
        $cObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
        $cObj->typoLink('|', $conf);
        $url = $cObj->lastTypoLinkUrl;
        return $url;
    }
}