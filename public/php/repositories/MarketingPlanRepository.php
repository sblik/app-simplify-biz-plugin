<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static MarketingPlanEntity|null get_one($fieldId, $value)
 * @method static MarketingPlanEntity|null get_one_by_id($value)
 * @method static MarketingPlanEntity|null get_one_for_current_user()
 * @method static MarketingPlanEntity|null get_one_for_user($userId)
 * @method static MarketingPlanEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static MarketingPlanEntity[] update(MarketingPlanEntity $entity)
 * @method static int|WP_Error add(MarketingPlanEntity $entity)
 */
class MarketingPlanRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = MarketingPlanEntity::class;
        $this->formId     = FormIds::MARKETING_PLAN;

        parent::__construct($gravityFormsApi);
    }
}