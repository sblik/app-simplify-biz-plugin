<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static RemoveCoachEntity|null get_one($fieldId, $value)
 * @method static RemoveCoachEntity|null get_one_by_id($value)
 * @method static RemoveCoachEntity|null get_one_for_current_user()
 * @method static RemoveCoachEntity|null get_one_for_user($userId)
 * @method static RemoveCoachEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static RemoveCoachEntity[] update(RemoveCoachEntity $entity)
 * @method static int|WP_Error add(RemoveCoachEntity $entity)
 */
class RemoveCoachRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = RemoveCoachEntity::class;
        $this->formId     = FormIds::REMOVE_COACH;

        parent::__construct($gravityFormsApi);
    }
}