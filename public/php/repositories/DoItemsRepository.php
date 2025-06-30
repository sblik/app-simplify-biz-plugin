<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static DoItemsEntity|null get_one($fieldId, $value)
 * @method static DoItemsEntity|null get_one_by_id($value)
 * @method static DoItemsEntity|null get_one_for_current_user()
 * @method static DoItemsEntity|null get_one_for_user($userId)
 * @method static DoItemsEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static DoItemsEntity[] update(DoItemsEntity $entity)
 * @method static int|WP_Error add(DoItemsEntity $entity)
 */
class DoItemsRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = DoItemsEntity::class;
        $this->formId     = FormIds::DO_ITEMS;

        parent::__construct($gravityFormsApi);
    }
}