<?php
namespace Sll\SllFeUser\Domain\Model;


/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 杨世昌 <yangshichang@ngoos.org>, 极益科技
 *           杨世昌 <yangshichang@ngoos.org>, 极益科技
 *
 ***/
/**
 * 用户信息扩展
 */
class User extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * crdate
     * 操作时间
     * 
     * @var \DateTime
     */
    protected $crdate = null;

    /**
     * 最后修改时间
     * 
     * @var \DateTime
     */
    protected $tstamp = null;

    /**
     * 用户openid
     * 
     * @var string
     */
    protected $openid = '';

    /**
     * 用户头像
     * 
     * @var string
     */
    protected $headimgurl = '';

    /**
     * 昵称
     * 
     * @var string
     */
    protected $nickname = '';

    /**
     * Returns the crdate
     * 
     * @return \DateTime $crdate
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * Get timestamp
     * 
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * Returns the openid
     * 
     * @return string openid
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * Sets the openid
     * 
     * @param string $openid
     * @return void
     */
    public function setOpenid($openid)
    {
        $this->openid = $openid;
    }

    /**
     * Returns the headimgurl
     * 
     * @return string headimgurl
     */
    public function getHeadimgurl()
    {
        return $this->headimgurl;
    }

    /**
     * Sets the headimgurl
     * 
     * @param string $headimgurl
     * @return void
     */
    public function setHeadimgurl($headimgurl)
    {
        $this->headimgurl = $headimgurl;
    }

    /**
     * Returns the nickname
     * 
     * @return string nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Sets the nickname
     * 
     * @param string $nickname
     * @return void
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
}
