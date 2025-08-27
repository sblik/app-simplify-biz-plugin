<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static TargetMarketRepeaterEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static TargetMarketRepeaterEntity|null get_one_by_id($value)
 * @method static TargetMarketRepeaterEntity|null get_one_for_current_user()
 * @method static TargetMarketRepeaterEntity|null get_one_for_user($userId)
 * @method static TargetMarketRepeaterEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static TargetMarketRepeaterEntity[] update(TargetMarketRepeaterEntity $entity)
 * @method static int|WP_Error add(TargetMarketRepeaterEntity $entity)
 */
class TargetMarketRepeaterRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = TargetMarketRepeaterEntity::class;
        $this->formId     = FormIds::TARGET_MARKET_REPEATER;

        parent::__construct($gravityFormsApi);
    }
}