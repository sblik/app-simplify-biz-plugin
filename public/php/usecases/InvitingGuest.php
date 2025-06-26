<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;
use SmplfyCore\WorkflowStep;

class InvitingGuest
{
    private AttendeeDashboardRepository   $attendeeDashboardRepository;
    private InviteGuestRepeaterRepository $inviteGuestRepeaterRepository;

    public function __construct(AttendeeDashboardRepository $attendeeDashboardRepository, InviteGuestRepeaterRepository $inviteGuestRepeaterRepository)
    {
        $this->attendeeDashboardRepository   = $attendeeDashboardRepository;
        $this->inviteGuestRepeaterRepository = $inviteGuestRepeaterRepository;
    }


    public function handle_parent_form_pre_render($form)
    {
        $userID = get_current_user_id();
        list($roadieUsageCount, $mealUsageCount, $vipUsageCount, $expoUsageCount, $awardsUsageCount, $classUsageCount) = $this->determine_tickets_assigned($userID);

        list($roadieTicketCount, $mealTicketCount, $vipTicketCount, $expoTicketCount, $awardsTicketCount, $classTicketCount) = $this->get_ticket_quanities($userID);

        if ($roadieTicketCount <= 0 || intval($roadieTicketCount) === $roadieUsageCount) {
            $roadieComplete = true;
        }
        if ($mealTicketCount <= 0 || intval($mealTicketCount) === intval($mealUsageCount)) {
            $mealComplete = true;
        }
        if ($vipTicketCount <= 0 || intval($vipTicketCount) === $vipUsageCount) {
            $vipComplete = true;
        }
        if ($expoTicketCount <= 0 || intval($expoTicketCount) === $expoUsageCount) {
            $expoComplete = true;
        }
        if ($awardsTicketCount <= 0 || intval($awardsTicketCount) === $awardsUsageCount) {
            $awardsComplete = true;
        }
        if ($classTicketCount <= 0 || intval($classTicketCount) === $classUsageCount) {
            $classComplete = true;
        }

        if ($roadieComplete && $mealComplete && $expoComplete && $awardsComplete && $classComplete && $vipComplete) {
            $allTicketsAssigned = true;
        }

        if ($allTicketsAssigned) {
            foreach ($form['fields'] as &$field) {
                if ($field->id == InviteGuestParentEntity::get_field_id('nestedForm')) {
                    SMPLFY_Log::info("Field: ", $field);
                    $field->visibility = 'hidden';
                }

            }
        }

        return $form;
    }

    /**
     * @param int $userID
     * @return int[]
     */
    public function determine_tickets_assigned(int $userID): array
    {
        $filters       = array('created_by' => $userID);
        $inviteEntries = $this->inviteGuestRepeaterRepository->get_all($filters);

        $roadieUsageCount = 0;
        $mealUsageCount   = 0;
        $vipUsageCount    = 0;
        $expoUsageCount   = 0;
        $awardsUsageCount = 0;
        $classUsageCount  = 0;

        if (!empty($inviteEntries)) {
            foreach ($inviteEntries as $inviteEntry) {
                $ticketAssigned = $inviteEntry->typeOfTicketAssigned;

                if ($ticketAssigned == 'Roadie') {
                    $roadieUsageCount += 1;
                }
                if ($ticketAssigned == 'Meal') {
                    $mealUsageCount += 1;
                }
                if ($ticketAssigned == 'VIP') {
                    $vipUsageCount += 1;
                }
                if ($ticketAssigned == 'EXPO') {
                    $expoUsageCount += 1;
                }
                if ($ticketAssigned == 'AWARDS') {
                    $awardsUsageCount += 1;
                }
                if ($ticketAssigned == 'CLASS') {
                    $classUsageCount += 1;
                }
            }
        }
        return array($roadieUsageCount, $mealUsageCount, $vipUsageCount, $expoUsageCount, $awardsUsageCount, $classUsageCount);
    }

    /**
     * @param int $userID
     * @return int[]
     */
    public function get_ticket_quanities(int $userID): array
    {
        $roadieTicketCount = 0;
        $mealTicketCount   = 0;
        $vipTicketCount    = 0;
        $expoTicketCount   = 0;
        $awardsTicketCount = 0;
        $classTicketCount  = 0;

        $args   = ['customer_id' => $userID];
        $orders = wc_get_orders($args);

        foreach ($orders as $order) {
            $items = $order->get_items(); // Line items
            foreach ($items as $item) {
                $quantity  = $item->get_quantity();
                $data      = $item->get_data();
                $productID = $data['product_id'];
                if ($productID == Products::EXPO_PASS) {
                    $expoTicketCount += $quantity;
                }
                if ($productID == Products::VIP_PASS) {
                    $vipTicketCount += $quantity;
                }
                if ($productID == Products::CLASS_PASS) {
                    $classTicketCount += $quantity;
                }
                if ($productID == Products::AWARDS_PASS) {
                    $awardsTicketCount += $quantity;
                }
                if ($productID == Products::MEAL_TICKET) {
                    $mealTicketCount += $quantity;
                }
                if ($productID == Products::ROADIE_TICKET) {
                    $roadieTicketCount += $quantity;
                }
            }
        }
        return array($roadieTicketCount, $mealTicketCount, $vipTicketCount, $expoTicketCount, $awardsTicketCount, $classTicketCount);
    }

    public function handle_parent_submission($entry, $form)
    {
        SMPLFY_Log::info("PARENT ENTRY: ", $entry);
    }

    public function handle_repeater_form_pre_render($form)
    {

        $userID = get_current_user_id();
        SMPLFY_Log::info("Current User ID: $userID");
        list($roadieUsageCount, $mealUsageCount, $vipUsageCount, $expoUsageCount, $awardsUsageCount, $classUsageCount) = $this->determine_tickets_assigned($userID);

        list($roadieTicketCount, $mealTicketCount, $vipTicketCount, $expoTicketCount, $awardsTicketCount, $classTicketCount) = $this->get_ticket_quanities($userID);

        if ($roadieTicketCount > 0 && intval($roadieTicketCount) !== $roadieUsageCount) {
            $text              = 'Roadie (' . ($roadieTicketCount - $roadieUsageCount) . ' Remaining)';
            $choices['Roadie'] = [
                'text'  => $text,
                'value' => 'Roadie'
            ];
        }
        else {
            $roadieComplete = true;
        }
        if ($mealTicketCount > 0 && intval($mealTicketCount) !== intval($mealUsageCount)) {
            $text            = 'Meal (' . ($mealTicketCount - $mealUsageCount) . ' Remaining)';
            $choices['Meal'] = [
                'text'  => $text,
                'value' => 'Meal'
            ];
        }
        else {
            $mealComplete = true;
        }
        if ($vipTicketCount > 0 && intval($vipTicketCount) !== $vipUsageCount) {
            $text           = 'VIP (' . ($vipTicketCount - $vipUsageCount) . ' Remaining)';
            $choices['VIP'] = [
                'text'  => $text,
                'value' => 'VIP'
            ];
        }
        else {
            $vipComplete = true;
        }
        if ($expoTicketCount > 0 && intval($expoTicketCount) !== $expoUsageCount) {
            $text            = 'EXPO (' . ($expoTicketCount - $expoUsageCount) . ' Remaining)';
            $choices['EXPO'] = [
                'text'  => $text,
                'value' => 'EXPO'
            ];
        }
        else {
            $expoComplete = true;
        }
        if ($awardsTicketCount > 0 && intval($awardsTicketCount) !== $awardsUsageCount) {
            $text              = 'AWARDS (' . ($awardsTicketCount - $awardsUsageCount) . ' Remaining)';
            $choices['AWARDS'] = [
                'text'  => $text,
                'value' => 'AWARDS'
            ];
        }
        else {
            $awardsComplete = true;
        }
        if ($classTicketCount > 0 && intval($classTicketCount) !== $classUsageCount) {
            $text             = 'CLASS (' . ($classTicketCount - $classUsageCount) . ' Remaining)';
            $choices['CLASS'] = [
                'text'  => $text,
                'value' => 'CLASS'
            ];
        }
        else {
            $classComplete = true;
        }

        if ($roadieComplete && $mealComplete && $expoComplete && $awardsComplete && $classComplete && $vipComplete) {
            $allTicketsAssigned = true;
        }


        foreach ($form['fields'] as &$field) {

            if ($field->id == InviteGuestRepeaterEntity::get_field_id('typeOfTicketAssigned') && $field->type === 'radio') {
                if ($allTicketsAssigned) {
                    $field->adminOnly = true;
                    $choices['NULL']  = [
                    ];
                }
                else {
                    $field->choices = array_values($choices);
                }
            }
        }

        return $form;
    }

    public function handle_repeater_submission($entry, $form)
    {
        $inviteAttendeeEntity            = new InviteGuestRepeaterEntity($entry);
        $inviteAttendeeEntity->createdBy = get_current_user_id();
        $this->inviteGuestRepeaterRepository->update($inviteAttendeeEntity);

        WorkflowStep::send(84, $entry);
    }

    function handle_repeater_pre_submission($form)
    {
        $emailInput = 'input_' . InviteGuestRepeaterEntity::get_field_id('email');
        $email      = $_POST[$emailInput];

        $userNameInput         = 'input_' . InviteGuestRepeaterEntity::get_field_id('guestUsername');
        $_POST[$userNameInput] = str_replace('@', '', $email);
    }

}