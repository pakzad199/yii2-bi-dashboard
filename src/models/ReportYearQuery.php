<?php

namespace sadi01\bidashboard\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[ReportYear]].
 *
 * @see ReportYear
 */
class ReportYearQuery extends \yii\db\ActiveQuery
{

    public function behaviors(): array
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReportYear[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ReportYear|array|null
     */
    public function one($db = null): ReportYear|array|null
    {
        return parent::one($db);
    }
}
