<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static ObjectivesEntity|null get_one($fieldId, $value)
 * @method static ObjectivesEntity|null get_one_by_id($value)
 * @method static ObjectivesEntity|null get_one_for_current_user()
 * @method static ObjectivesEntity|null get_one_for_user($userId)
 * @method static ObjectivesEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static ObjectivesEntity[] update(ObjectivesEntity $entity)
 * @method static int|WP_Error add(ObjectivesEntity $entity)
 */
class ObjectivesRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = ObjectivesEntity::class;
        $this->formId     = FormIds::OBJECTIVES;

        parent::__construct($gravityFormsApi);
    }
}