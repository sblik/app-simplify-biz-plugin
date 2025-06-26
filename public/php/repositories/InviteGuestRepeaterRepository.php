<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static InviteGuestRepeaterEntity|null get_one($fieldId, $value)
 * @method static InviteGuestRepeaterEntity|null get_one_for_current_user()
 * @method static InviteGuestRepeaterEntity|null get_one_for_user($userId)
 * @method static InviteGuestRepeaterEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static InviteGuestRepeaterEntity[] update(InviteGuestRepeaterEntity $entity)
 * @method static int|WP_Error add(InviteGuestRepeaterEntity $entity)
 */
class InviteGuestRepeaterRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = InviteGuestRepeaterEntity::class;
        $this->formId     = FormIds::INVITE_GUEST_REPEATER;

        parent::__construct($gravityFormsApi);
    }
}