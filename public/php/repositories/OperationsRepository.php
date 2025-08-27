<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static OperationsEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static OperationsEntity|null get_one_by_id($value)
 * @method static OperationsEntity|null get_one_for_current_user()
 * @method static OperationsEntity|null get_one_for_user($userId)
 * @method static OperationsEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static OperationsEntity[] update(OperationsEntity $entity)
 * @method static int|WP_Error add(OperationsEntity $entity)
 */
class OperationsRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = OperationsEntity::class;
        $this->formId     = FormIds::PROCESS_OPERATIONS;

        parent::__construct($gravityFormsApi);
    }
}