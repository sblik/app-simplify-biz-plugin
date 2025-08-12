jQuery(document).ready(function (jQuery) {

    let url = window.location.href;
    let match = url.match(/entry\/(\d{3,5})/);

    if (match) {
        let entryId = match[1];
        console.log(entryId); // 649


        var getCoachAbilitiesFunction = "can_coach_edit_entries";
        var getCoachAbilitiesAjaxurl = "/wp-admin/admin-ajax.php";

        getUserInfoData = {action: getCoachAbilitiesFunction, entryID: entryId};

        jQuery.post(getCoachAbilitiesAjaxurl, getUserInfoData, function (response) {
            let responseJson = JSON.parse(response);

            let canEditEntries = responseJson.canEditEntries;

            if (canEditEntries === false) {
                jQuery('[class*="gv-field-"][class*="-edit_link"]').style.display = 'none !important';
            }
        });
    }
});

