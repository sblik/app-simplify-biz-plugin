<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static MoneyEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static MoneyEntity|null get_one_by_id($value)
 * @method static MoneyEntity|null get_one_for_current_user()
 * @method static MoneyEntity|null get_one_for_user($userId)
 * @method static MoneyEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static MoneyEntity[] update(MoneyEntity $entity)
 * @method static int|WP_Error add(MoneyEntity $entity)
 */
class MoneyRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = MoneyEntity::class;
        $this->formId     = FormIds::PROCESS_MONEY;

        parent::__construct($gravityFormsApi);
    }
}