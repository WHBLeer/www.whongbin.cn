<?php

namespace DominicJoas\Timeline\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\Repository;

class TimelineEventRepository extends Repository {

    /**
     * @param int $uid
     * @param $order
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getContentElementEntries($uid, $order) {
        $query = $this->createQuery();
        $ordering = null;

        switch ($order) {
            case "asc":
                $ordering = ['start_date' => Query::ORDER_ASCENDING];
                break;
            case "desc":
                $ordering = ['start_date' => Query::ORDER_DESCENDING];
                break;
            default:
                $ordering = ['sorting' => Query::ORDER_ASCENDING];
                break;
        }

        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
        	$query->equals('timetable_id', (int)$uid)
        );
        $query->setOrderings($ordering);


        $result = $query->execute();
        return $result;
    }
}
