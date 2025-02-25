<?php
namespace Perspective\UIComponentRest\Model;

use Perspective\UIComponentRest\Api\Data\ReviewRepositoryInterface;
use Magento\Framework\App\ResourceConnection;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $connection;

    public function __construct(ResourceConnection $resource)
    {
        $this->connection = $resource->getConnection();
    }

    
    public function getReviewsByProductId($productId)
    {
        $reviewTable = $this->connection->getTableName('review');
        $detailTable = $this->connection->getTableName('review_detail');
        $select = $this->connection->select()
            ->from(
                ['r' => $reviewTable],
                ['created_at']
            )
            ->join(
                ['d' => $detailTable],
                'r.review_id = d.review_id',
                ['nickname', 'detail']
            )
            ->where('r.entity_pk_value = ?', $productId)
            ->where('r.status_id = 1'); // Approved reviews only

        return $this->connection->fetchAll($select);
    }
}