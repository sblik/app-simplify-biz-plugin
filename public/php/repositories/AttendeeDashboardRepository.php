<?php
/**
 *  A repository acts as a way to run methods defined in the SMPLFY Core plugin in relation to a specific form on the site.
 *
 *  When creating a new form on the website, consider creating a Repository and Entity for it if you expect its entries to be accessed and/or manipulated
 *  from this custom plugin.
 */

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseRepository;
use SmplfyCore\SMPLFY_GravityFormsApiWrapper;
use WP_Error;

/**
 *
 * @method static AttendeeDashboardEntity|null get_one($fieldId, $value)
 * @method static AttendeeDashboardEntity|null get_one_for_current_user()
 * @method static AttendeeDashboardEntity|null get_one_for_user($userId)
 * @method static AttendeeDashboardEntity[] get_all(array $filters = null, string $direction = 'ASC')
 * @method static AttendeeDashboardEntity[] update(AttendeeDashboardEntity $entity)
 * @method static int|WP_Error add(AttendeeDashboardEntity $entity)
 */
class AttendeeDashboardRepository extends SMPLFY_BaseRepository
{
    public function __construct(SMPLFY_GravityFormsApiWrapper $gravityFormsApi)
    {
        $this->entityType = AttendeeDashboardEntity::class;
        $this->formId     = FormIds::ATTENDEE_DASHBOARD;

        parent::__construct($gravityFormsApi);
    }
}