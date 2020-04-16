<?php
namespace Sll\SllNews\Domain\Repository;
class CategoryRepository extends \GeorgRinger\News\Domain\Repository\CategoryRepository {
    
    /**
     * 获坖分类
     * @param string $categories
     */
    public function findByUids($categories){
    
        $categories = explode(',',$categories);
        
        $query = $this->createQuery();
        
        $constraints = array();
        foreach($categories as $category){
            $constraints[] = $query->equals('uid',$category);
        }
        
        $query->matching($query->logicalOr($constraints));
        $result = $query->execute();
        return $result;
    }

    /**
     * findByParent
     *
     * @param [type] $parent
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    public function findByParent($parent)
    {
        $query = $this->createQuery();
        
        $constraints = array();
        $constraints[] = $query->equals('uid',$parent);
        $constraints[] = $query->equals('parent',$parent);
        
        $query->matching($query->logicalOr($constraints));
        $result = $query->execute();
        return $result;
    }
}
