<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static PeopleEntity|null get_one($fieldId, $value)
 * @method static PeopleEntity|null get_one_by_id($value)
 * @method static PeopleEntity|null get_one_for_current_user()
 * @method static PeopleEntity|null get_one_for_user($userId)
 * @method static PeopleEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static PeopleEntity[] update(PeopleEntity $entity)
 * @method static int|WP_Error add(PeopleEntity $entity)
 */
class PeopleRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = PeopleEntity::class;
        $this->formId     = FormIds::PROCESS_PEOPLE;

        parent::__construct($gravityFormsApi);
    }
}