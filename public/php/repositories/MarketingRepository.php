<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static MarketingEntity|null get_one($fieldId, $value)
 * @method static MarketingEntity|null get_one_by_id($value)
 * @method static MarketingEntity|null get_one_for_current_user()
 * @method static MarketingEntity|null get_one_for_user($userId)
 * @method static MarketingEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static MarketingEntity[] update(MarketingEntity $entity)
 * @method static int|WP_Error add(MarketingEntity $entity)
 */
class MarketingRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = MarketingEntity::class;
        $this->formId     = FormIds::PROCESS_MARKETING;

        parent::__construct($gravityFormsApi);
    }
}