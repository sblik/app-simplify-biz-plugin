<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static LeadershipEntity|null get_one($fieldId, $value)
 * @method static LeadershipEntity|null get_one_by_id($value)
 * @method static LeadershipEntity|null get_one_for_current_user()
 * @method static LeadershipEntity|null get_one_for_user($userId)
 * @method static LeadershipEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static LeadershipEntity[] update(LeadershipEntity $entity)
 * @method static int|WP_Error add(LeadershipEntity $entity)
 */
class LeadershipRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = LeadershipEntity::class;
        $this->formId     = FormIds::PROCESS_LEADERSHIP;

        parent::__construct($gravityFormsApi);
    }
}