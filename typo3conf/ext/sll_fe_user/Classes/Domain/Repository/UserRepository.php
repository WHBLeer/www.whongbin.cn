<?php
namespace Sll\SllFeUser\Domain\Repository;


/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 杨世昌 <yangshichang@ngoos.org>, 极益科技
 *
 ***/
/**
 * The repository for Users
 */
class UserRepository extends \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
{
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');

        //忽略pid
        $querySettings->setRespectStoragePage(FALSE);
        $querySettings->setEnableFieldsToBeIgnored(['tx_extbase_type']);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * 查询所有用户
     * 
     * @param string $keyword
     * @param [type] $groups
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     * @return void
     */
    public function findAlls($keyword = '', $groups)
    {
        $query = $this->createQuery();

        //忽略disable=1
        // $query->getQuerySettings()->setIgnoreEnableFields(TRUE);
        $arr = [];
        if ($keyword != '') {
            $arr[] = $query->logicalOr(
                [
                    $query->like('name', '%' . $keyword . '%'),
                    $query->like('nickname', '%' . $keyword . '%'),
                    $query->like('telephone', '%' . $keyword . '%')
                ]
            );
        }

        //超级管理员不显示
        $arr[] = $query->greaterThan('uid', 1);

        //仅显示指定用户组
        // dump($groups);
        if ($groups != '') {
            $groups = explode(',', $groups);
            $con = [];
            foreach ($groups as $group) {
                $con[] = $query->contains('usergroup', $group);
            }
            if (!empty($con)) {
                $arr[] = $query->logicalOr($con);
            }
        }
        if (!empty($arr)) {
            $query->matching($query->logicalAnd($arr));
        }
        $query->setOrderings(
            [
                'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
            ]
        );
        $res = $query->execute();

        // self::queryDebug($query);
        return $res;
    }

    /**
     * 新增或修改的时候，检测用户或邮箱是否存在
     * 
     * @param string $username
     * @param string $email
     * @param $telephone
     * @param $uid
     */
    public function checkExist($username, $email, $telephone, $uid = 0)
    {
        $query = $this->createQuery();

        //忽略disable=1
        $query->getQuerySettings()->setIgnoreEnableFields(TRUE);
        $arr = [];
        if ($uid == 0) {
            if ($username != "") {
                $arr[] = $query->equals('username', $username);
            } else {
                if ($email != "") {
                    $arr[] = $query->equals('email', $email);
                } else {
                    if ($telephone != "") {
                        $arr[] = $query->equals('telephone', $telephone);
                    }
                }
            }
        } else {
            if ($username != "") {
                $arr[] = $query->equals('username', $username);
            } else {
                if ($email != "") {
                    $arr[] = $query->equals('email', $email);
                } else {
                    if ($telephone != "") {
                        $arr[] = $query->equals('telephone', $telephone);
                    }
                }
            }
            $arr[] = $query->logicalNot($query->equals('uid', $uid));
        }
        $query->matching($query->logicalAnd($arr));
        return $query->execute()->count();
    }

    /**
     * 通过openid查询用户是否存在
     * 
     * @param string $openid
     */
    public function findUser2Openid($openid)
    {
        $query = $this->createQuery();
        $arr = [];
        $arr[] = $query->equals("openid", $openid);
        $query->matching($query->logicalAnd($arr));
        return $query->execute()->getFirst();
    }

    /**
     * 用户名校验
     * 
     * @param string $username
     * @param int $usergroup 用户组
     */
    public function userCheck($username, $usergroup)
    {
        $query = $this->createQuery();

        //忽略disable=1
        $query->getQuerySettings()->setIgnoreEnableFields(TRUE);
        $arr = [];
        $arr[] = $query->equals('username', $username);
        if ($usergroup > 0) {
            $arr[] = $query->equals('usergroup', $usergroup);
        }
        $query->matching($query->logicalAnd($arr));
        return $query->execute();
    }

    /**
     * 用户名列表
     * 
     * @param $group
     * @param $uid
     */
    public function findUserList($group, $uid = 0)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $arr = [];
        $arr[] = $query->in("usergroup", $group);
        if ($uid != 0) {
            $arr[] = $query->equals('uid', $uid);
        } else {
            $arr[] = $query->logicalNot($query->equals('uid', 143));
        }
        $query->matching($query->logicalAnd($arr));
        return $query->execute();
    }

    /**
     * 查询数据 主要是disable=1情况无法查询
     * 
     * @param int $uid
     */
    public function findUserInfo($uid)
    {
        $query = $this->createQuery();

        //忽略disable=1
        $query->getQuerySettings()->setIgnoreEnableFields(TRUE);
        $arr = [];
        $arr[] = $query->equals("uid", $uid);
        $query->matching($query->logicalAnd($arr));
        return $query->execute()->getFirst();
    }

    // self::queryDebug($query);
    /**
     * @param $query
     */
    private function queryDebug($query)
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters());
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
    }
}
