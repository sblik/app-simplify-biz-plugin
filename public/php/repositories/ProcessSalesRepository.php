<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static ProcessSalesEntity|null get_one($fieldId, $value)
 * @method static ProcessSalesEntity|null get_one_by_id($value)
 * @method static ProcessSalesEntity|null get_one_for_current_user()
 * @method static ProcessSalesEntity|null get_one_for_user($userId)
 * @method static ProcessSalesEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static ProcessSalesEntity[] update(ProcessSalesEntity $entity)
 * @method static int|WP_Error add(ProcessSalesEntity $entity)
 */
class ProcessSalesRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = ProcessSalesEntity::class;
        $this->formId     = FormIds::PROCESS_SALES;

        parent::__construct($gravityFormsApi);
    }
}