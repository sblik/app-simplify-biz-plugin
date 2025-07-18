<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static MarketingProcessEntity|null get_one($fieldId, $value)
 * @method static MarketingProcessEntity|null get_one_by_id($value)
 * @method static MarketingProcessEntity|null get_one_for_current_user()
 * @method static MarketingProcessEntity|null get_one_for_user($userId)
 * @method static MarketingProcessEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static MarketingProcessEntity[] update(MarketingProcessEntity $entity)
 * @method static int|WP_Error add(MarketingProcessEntity $entity)
 */
class MarketingProcessRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = MarketingProcessEntity::class;
        $this->formId     = FormIds::MARKETING_PLAN;

        parent::__construct($gravityFormsApi);
    }
}