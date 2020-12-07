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
		/* foreach ($newss as $key => $news) {
			$res = $this->uploadQiniu($news);
			dump($res);
		} */
	}

	public function addPages($categories)
	{
		// $categories = $this->categoryRepository->findByParent();
		// dump($categories);exit;
		foreach ($categories as $key => $category) {
			$values = array(
				'pid' => 40,
				'tstamp' => time(),
				'crdate' => time(),
				'cruser_id' => 1,
				'l10n_diffsource' => 'a:53:{s:7:\"doktype\";N;s:5:\"title\";N;s:4:\"slug\";N;s:9:\"nav_title\";N;s:8:\"subtitle\";N;s:9:\"seo_title\";N;s:8:\"no_index\";N;s:9:\"no_follow\";N;s:14:\"canonical_link\";N;s:8:\"og_title\";N;s:14:\"og_description\";N;s:8:\"og_image\";N;s:13:\"twitter_title\";N;s:19:\"twitter_description\";N;s:13:\"twitter_image\";N;s:8:\"abstract\";N;s:8:\"keywords\";N;s:11:\"description\";N;s:6:\"author\";N;s:12:\"author_email\";N;s:11:\"lastUpdated\";N;s:6:\"layout\";N;s:8:\"newUntil\";N;s:14:\"backend_layout\";N;s:25:\"backend_layout_next_level\";N;s:16:\"content_from_pid\";N;s:6:\"target\";N;s:13:\"cache_timeout\";N;s:10:\"cache_tags\";N;s:24:\"tx_staticfilecache_cache\";N;s:30:\"tx_staticfilecache_cache_force\";N;s:32:\"tx_staticfilecache_cache_offline\";N;s:33:\"tx_staticfilecache_cache_priority\";N;s:11:\"is_siteroot\";N;s:9:\"no_search\";N;s:13:\"php_tree_stop\";N;s:6:\"module\";N;s:5:\"media\";N;s:17:\"tsconfig_includes\";N;s:8:\"TSconfig\";N;s:8:\"l18n_cfg\";N;s:6:\"hidden\";N;s:8:\"nav_hide\";N;s:9:\"starttime\";N;s:7:\"endtime\";N;s:16:\"extendToSubpages\";N;s:8:\"fe_group\";N;s:13:\"fe_login_mode\";N;s:8:\"editlock\";N;s:10:\"categories\";N;s:14:\"rowDescription\";N;s:9:\"parent_id\";N;s:4:\"icon\";N;}',
				'sorting' => 256,
				'perms_userid' => 1,
				'perms_user' => 31,
				'perms_group' => 27,
				'title' => $category->getTitle(),
				'slug' => '/category/'.$category->getSlug(),
				'doktype' => 1,
				'SYS_LASTCHANGED' => time(),
				'nav_hide' => 1,
				'backend_layout' => 'pagets__onecolumn',
				'backend_layout_next_level' => 'pagets__onecolumn',
				'parent_id' => 'page_',
				'tx_staticfilecache_cache' => 1
			);
			$this->newsRepository->addValues('pages',$values);
		}
		
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
	 * 分类页面
	 *
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-04-14
	 */
	public function categoryResultAction()
	{
		$urlParams = pathinfo(GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL'));
		$categoryName = $urlParams['filename'];
		$categories = $this->categoryRepository->findBySlug($categoryName);
		$this->view->assign('category', $categories->getFirst());
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
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
			if (GeneralUtility::_GP('category')) {
				$categories = $this->categoryRepository->findByUids(GeneralUtility::_GP('category'));
			} else {
				$categories = $this->categoryRepository->findByParent($this->settings['listType']);
			}
			
			$newss = $this->newsRepository->findByPaginate($categories,$offset,$limit);
			$items = array();
			foreach ($newss as $key => $news) {
				$typolink = $this->getTypoLink($this->settings['previewPid']);
				// $typolink = substr_replace($typolink, '/'.$news->getPathSegment().'.html', -5);
				$typolink = substr_replace($typolink, '/'.$news->getUid().'.html', -5);
				$categoryLink = GeneralUtility::getIndpEnv('TYPO3_SITE_URL').'category/';
				$categorys = array();
				foreach ($news->getCategories() as $k => $c) {
					$categorys[] = '<a href="/category/'.$c->getSlug().'.html"><span class="post-category text-white '.$news->getTagclass().' mb-3">'.$c->getTitle().'</span></a>';
				}
				$itemData = array(
					'LINK' 		=> $typolink,
					'IMGSRC' 	=> "https://qiniu.whongbin.cn/article-{$news->getUid()}.jpg?imageMogr2/thumbnail/640x640/format/webp/blur/1x0/quality/75|watermark/2/text/U2FuTGlMaW4=/font/Y29uc29sYXM=/fontsize/540/fill/I0ZGRkZGRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10|imageslim",
					'CATEGORYS' => implode('',$categorys),
					'TITLE' 	=> $news->getTitle(),
					'AUTHORIMG' => $news->getAuthorimg(),
					'AUTHOR' 	=> $news->getAuthor(),
					'DATETIME' 	=> $news->getDatetime()->format('M d, Y'),
				);
				// JSON($itemData);
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
		/** @var \Sll\SllFileManager\Controller\FileController $fileContr*/
		$fileControllor = $this->objectManager->get(\Sll\SllFileManager\Controller\FileController::class);
		/* if ($albumFile['error']==0) {
			$fileobj = $fileControllor->addFile($albumFile,['path'=>$this->filepath,'link'=>$this->filelink]);
			if ($fileobj) $news->setCover($fileobj);
		}

		$annexFiles = $this->request->hasArgument('annex')?$this->request->getArgument('annex'):[];
		if (count($annexFiles)>0) {
			for ($i=0; $i < count($annexFiles); $i++) { 
				$fileobj = $fileControllor->addFile($annexFiles[$i],['path'=>$this->filepath,'link'=>$this->filelink]);
				$news->addAnnex($fileobj);
			}
		} */

		$wz = new \Sll\SllNews\Method\GetOnlyWord();
		$news->setPathSegment($wz->strFilter($news->getTitle()));
		$news->setTeaser(($news->getTeaser()!='') ? $news->getTeaser() : $wz->csubstr($news->getBodytext(), 120));
		// dump($news);exit;
		$this->newsRepository->add($news);
		$persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
        $persistenceManager->persistAll();
		$this->file_exists($news->getUid());

		//清除前台页面缓存
		$cacheManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Service\CacheService::class);
		$cacheManager->clearPageCache([1,32,34]);

		$this->addFlashMessage('保存成功！', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->redirect('list');
	}

	/**
	 * 创建封面图
	 *
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-08-31
	 */
	public function uploadQiniu($uid)
	{
		require_once ExtensionManagementUtility::extPath('sll_plugin') . 'Classes/QiniuSDK/autoload.php';
		$cfg = [
			'access' => '5-d72zPYQymmaZXR4Igd3cMOULZ03Sy2oZ5JNlzY',
			'secret' => '7tb1Xc5KfNCr2RWZxTvhP6T-brb4BTBgnlpVagvs',
			'bucket' => 'whongbin-cn',
			'domain' => 'https://qiniu.whongbin.cn/'
		];
		// 初始化签权对象
		$auth = new \Qiniu\Auth($cfg['access'], $cfg['secret']);
		$bucketMgr = new \Qiniu\Storage\BucketManager($auth);
		if ($key=='') $key = 'article-' . $uid . '.jpg';
		list($ret, $err) = $bucketMgr->fetch('https://acg.xydwz.cn/api/api.php?rand='.$uid,$cfg['bucket'],$key);
		if(!$err == false) {
			$res = array('code' => 0,'msg' => $err);
		} else {
			$res = $cfg['domain'] . $ret['key'];
		}
		return $res;
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
        /* $albumFile = $this->request->hasArgument('album')?$this->request->getArgument('album'):[];
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
		} */
		
		$this->file_exists($news->getUid());
        $wz = new \Sll\SllNews\Method\GetOnlyWord();
        $news->setPathSegment($wz->strFilter($news->getTitle()));
        $news->setTeaser(($news->getTeaser()!='') ? $news->getTeaser() : $wz->csubstr($news->getBodytext(), 120));
		$this->newsRepository->update($news);
		
		//清除前台页面缓存
		$cacheManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Service\CacheService::class);
		$cacheManager->clearPageCache([1,32,34]);

        $this->addFlashMessage('文章编辑成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('list');
	}

	/**
	 * 封面图不存在时新建封面
	 *
	 * @param [type] $uid
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-11-04
	 */
	public function file_exists($uid)
	{
		$url = "https://qiniu.whongbin.cn/article-{$uid}.jpg";
		$ch = curl_init();
		$timeout = 10;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$result = curl_exec($ch);
		if (preg_match("/404/", $result)) $this->uploadQiniu($uid);
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