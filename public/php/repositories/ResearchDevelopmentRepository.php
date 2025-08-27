<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static ResearchDevelopmentEntity|null get_one(array $filters, $direction = 'ASC')
 * @method static ResearchDevelopmentEntity|null get_one_by_id($value)
 * @method static ResearchDevelopmentEntity|null get_one_for_current_user()
 * @method static ResearchDevelopmentEntity|null get_one_for_user($userId)
 * @method static ResearchDevelopmentEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static ResearchDevelopmentEntity[] update(ResearchDevelopmentEntity $entity)
 * @method static int|WP_Error add(ResearchDevelopmentEntity $entity)
 */
class ResearchDevelopmentRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = ResearchDevelopmentEntity::class;
        $this->formId     = FormIds::PROCESS_RESEARCH_DEVELOPMENT;

        parent::__construct($gravityFormsApi);
    }
}