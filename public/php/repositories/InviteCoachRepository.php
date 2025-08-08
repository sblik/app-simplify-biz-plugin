<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static InviteCoachEntity|null get_one($fieldId, $value)
 * @method static InviteCoachEntity|null get_one_by_id($value)
 * @method static InviteCoachEntity|null get_one_for_current_user()
 * @method static InviteCoachEntity|null get_one_for_user($userId)
 * @method static InviteCoachEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static InviteCoachEntity[] update(InviteCoachEntity $entity)
 * @method static int|WP_Error add(InviteCoachEntity $entity)
 */
class InviteCoachRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = InviteCoachEntity::class;
        $this->formId     = FormIds::INVITE_COACH;

        parent::__construct($gravityFormsApi);
    }
}