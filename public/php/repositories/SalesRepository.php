<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static SalesEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static SalesEntity|null get_one_by_id($value)
 * @method static SalesEntity|null get_one_for_current_user()
 * @method static SalesEntity|null get_one_for_user($userId)
 * @method static SalesEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static SalesEntity[] update(SalesEntity $entity)
 * @method static int|WP_Error add(SalesEntity $entity)
 */
class SalesRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = SalesEntity::class;
        $this->formId     = FormIds::PROCESS_SALES;

        parent::__construct($gravityFormsApi);
    }
}