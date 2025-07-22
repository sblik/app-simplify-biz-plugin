<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static StrategyEntity|null get_one($fieldId, $value)
 * @method static StrategyEntity|null get_one_by_id($value)
 * @method static StrategyEntity|null get_one_for_current_user()
 * @method static StrategyEntity|null get_one_for_user($userId)
 * @method static StrategyEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static StrategyEntity[] update(StrategyEntity $entity)
 * @method static int|WP_Error add(StrategyEntity $entity)
 */
class StrategyRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = StrategyEntity::class;
        $this->formId     = FormIds::STRATEGY;

        parent::__construct($gravityFormsApi);
    }
}