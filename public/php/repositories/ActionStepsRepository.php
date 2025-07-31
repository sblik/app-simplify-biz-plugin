<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static ActionStepsEntity|null get_one($fieldId, $value)
 * @method static ActionStepsEntity|null get_one_by_id($value)
 * @method static ActionStepsEntity|null get_one_for_current_user()
 * @method static ActionStepsEntity|null get_one_for_user($userId)
 * @method static ActionStepsEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static ActionStepsEntity[] update(ActionStepsEntity $entity)
 * @method static int|WP_Error add(ActionStepsEntity $entity)
 */
class ActionStepsRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = ActionStepsEntity::class;
        $this->formId     = FormIds::ACTION_STEPS;

        parent::__construct($gravityFormsApi);
    }
}