<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static TasksEntity|null get_one($fieldId, $value)
 * @method static TasksEntity|null get_one_by_id($value)
 * @method static TasksEntity|null get_one_for_current_user()
 * @method static TasksEntity|null get_one_for_user($userId)
 * @method static TasksEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static TasksEntity[] update(TasksEntity $entity)
 * @method static int|WP_Error add(TasksEntity $entity)
 */
class TasksRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = TasksEntity::class;
        $this->formId     = FormIds::DO_ITEMS;

        parent::__construct($gravityFormsApi);
    }
}