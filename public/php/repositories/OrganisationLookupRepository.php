<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 * A repository for performing CRUD operations on the attendee form
 *
 * @method static OrganisationLookupEntity|null get_one($fieldId, $value, $direction = 'ASC')
 * @method static OrganisationLookupEntity|null get_one_for_user($userId)
 * @method static OrganisationLookupEntity|null get_one_for_current_user()
 * @method static OrganisationLookupEntity|null get_one_by_id($userId)
 * @method static OrganisationLookupEntity[]|null get_all($fieldId = null, $value = null, string $direction = 'ASC')
 * @method static int|WP_Error add(OrganisationLookupEntity $entity)
 * @method static OrganisationLookupEntity[] update(OrganisationLookupEntity $entity)
 */
class OrganisationLookupRepository extends SMPLFY_BaseRepository
{

    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = OrganisationLookupEntity::class;
        $this->formId     = FormIds::ORGANISATION_LOOKUP;

        parent::__construct($gravityFormsApi);
    }

}