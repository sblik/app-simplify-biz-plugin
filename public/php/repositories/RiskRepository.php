<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static RiskEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static RiskEntity|null get_one_by_id($value)
 * @method static RiskEntity|null get_one_for_current_user()
 * @method static RiskEntity|null get_one_for_user($userId)
 * @method static RiskEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static RiskEntity[] update(RiskEntity $entity)
 * @method static int|WP_Error add(RiskEntity $entity)
 */
class RiskRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = RiskEntity::class;
        $this->formId     = FormIds::PROCESS_RISK;

        parent::__construct($gravityFormsApi);
    }
}