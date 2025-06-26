<?php

namespace SMPLFY\appsimplifybiz;

use GFAPI;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\WorkflowStep;
use function wc_get_order;

class PurchaseCompleted
{

    private InviteGuestRepeaterRepository $inviteGuestRepeaterRepository;
    private InviteGuestParentRepository   $inviteGuestParentRepository;

    public function __construct(InviteGuestRepeaterRepository $inviteGuestRepeaterRepository, InviteGuestParentRepository $inviteGuestParentRepository)
    {
        $this->inviteGuestRepeaterRepository = $inviteGuestRepeaterRepository;
        $this->inviteGuestParentRepository   = $inviteGuestParentRepository;
    }

    function handle_processing_purchase($order_id)
    {
        $order = wc_get_order($order_id);

        $order->update_status('completed');
    }

    function handle_purchase($order_id)
    {
        SMPLFY_Log::info("In woo commerce order complete ----------");
        $site_id = get_current_blog_id(); // or use get_site_url()

        if ($site_id == SiteIDs::MY_DO_ITEMS) {
            SMPLFY_Log::info("In if site ID is 6 ----------");
            $order = wc_get_order($order_id);

            if (!$order) {
                SMPLFY_Log::error("Order not found for ID: $order_id");
                return;
            }
            $userID = $order->get_user_id();
            $user   = get_user_by('ID', $userID);

            $billing_email = $order->get_billing_email();


            $firstName = $order->get_meta('_billing_contact_first_name');
            $lastName  = $order->get_meta('_billing_contact_last_name');
            $phone     = $order->get_meta('_billing_contact_phone');

            SMPLFY_Log::info("First Name: $firstName, Last Name: $lastName, Phone: $phone");


            if (!empty($userID)) {
                $user->first_name = $firstName;
                $user->last_name  = $lastName;

                $user = get_user_by('ID', $userID);

                $user->add_role('ticket_purchaser');
                $user->add_role('attendee');

                wp_update_user($user);

            }


            // Example: Get order data
            $order_total = $order->get_total();

            $items      = $order->get_items(); // Line items
            $totalItems = 0;

            foreach ($items as $item) {
                $quantity   = $item->get_quantity();
                $totalItems += $quantity;
                $data       = $item->get_data();
                $productID  = $data['product_id'];
                if ($productID == Products::EXPO_PASS) {
                    $ticketType = 'EXPO';
                }
                if ($productID == Products::VIP_PASS) {
                    $ticketType = 'VIP';
                }
                if ($productID == Products::CLASS_PASS) {
                    $ticketType = 'CLASS';
                }
                if ($productID == Products::AWARDS_PASS) {
                    $ticketType = 'AWARDS';
                }
                if ($productID == Products::MEAL_TICKET) {
                    $ticketType = 'Meal';
                }
                if ($productID == Products::ROADIE_TICKET) {
                    $ticketType = 'Roadie';
                }

            }

            if ($totalItems == 1) {
                $searchCriteria = ['created_by' => $userID, InviteGuestRepeaterEntity::get_field_id('email') => $user->user_email];

                $existingAssignedEntry = $this->inviteGuestRepeaterRepository->get_all($searchCriteria);
                SMPLFY_Log::info("Existing Invite Entries for Buyer: ", $existingAssignedEntry);

                if (empty($existingAssignedEntry)) {
                    $inviteGuestParent            = new InviteGuestParentEntity();
                    $inviteGuestParent->createdBy = $userID;

                    $parentEntryID = $this->inviteGuestParentRepository->add($inviteGuestParent);

                    $attendeeAssignedTicketEntry = new InviteGuestRepeaterEntity();

                    $attendeeAssignedTicketEntry->email                = $user->user_email;
                    $attendeeAssignedTicketEntry->invitorUserID        = $userID;
                    $attendeeAssignedTicketEntry->workflowUser         = $userID;
                    $attendeeAssignedTicketEntry->nameFirst            = $firstName;
                    $attendeeAssignedTicketEntry->nameLast             = $lastName;
                    $attendeeAssignedTicketEntry->phone                = $phone;
                    $attendeeAssignedTicketEntry->typeOfTicketAssigned = $ticketType;
                    $attendeeAssignedTicketEntry->parentKey            = $parentEntryID;
                    $attendeeAssignedTicketEntry->parentFormKey        = FormIds::INVITE_GUEST_PARENT;
                    $attendeeAssignedTicketEntry->nestedFormFieldKey   = InviteGuestParentEntity::get_field_id('nestedForm');


                    $childEntryID = $this->inviteGuestRepeaterRepository->add($attendeeAssignedTicketEntry);

                    $nestedFormEntry = GFAPI::get_entry($childEntryID);

                    WorkflowStep::send(121, $nestedFormEntry);

                    $inviteGuestParent             = $this->inviteGuestParentRepository->get_one_by_id($parentEntryID);
                    $inviteGuestParent->nestedForm = $childEntryID;

                    $this->inviteGuestParentRepository->update($inviteGuestParent);
                }
            }


            SMPLFY_Log::info("Purchased Items: ", $items);
            SMPLFY_Log::info("Order Total: ", $order_total);
            SMPLFY_Log::info("Billing Email: ", $billing_email);


        }

    }

    function handle_thankyou_page($order_id)
    {
        $order = wc_get_order($order_id);
        $url   = SITE_URL . '/attendee';
        if (!$order->has_status('failed')) {
            wp_safe_redirect($url);
            exit;
        }
    }


}