<?php

class EventController
{
    private $event_model; // Instance of EventModel
    private $requirement_ref; // Reference to RequirementModel
    private $userTypeID; // User type ID

    // Constructor
    public function __construct($event_model, $requirement_ref, $userTypeID)
    {
        $this->event_model = $event_model;
        $this->requirement_ref = $requirement_ref;
        $this->userTypeID = $userTypeID;
    }

    // Create a new event
    public function create_event($event, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return ["status" => "error", "message" => "Unauthorized user type"];
        }

        $created_event = $event->create();
        if ($created_event) {
            return ["status" => "success", "event_id" => $created_event->EventID];
        } else {
            return ["status" => "error", "message" => "Failed to create event"];
        }
    }

    // Get event by ID
    public function get_event_by_id($event_id, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return null;
        }

        return $this->event_model->read_by_id($event_id);
    }

    // Update an event
    public function update_event($event_id, $updated_event, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            throw new Exception("Unauthorized user type");
        }

        $updated_event->EventID = $event_id;
        $updated_event->update();
    }

    // Delete an event
    public function delete_event($event_id, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return false;
        }

        return $this->event_model->delete($event_id);
    }

    // Get all events
    public function get_all_events()
    {
        return $this->event_model->read_all();
    }

    // Modify event location
    public function modify_event_location($event_id, $new_location, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return false;
        }

        $event = $this->event_model->read_by_id($event_id);
        if ($event) {
            return $event->modify_location($new_location) ? true : false;
        }

        return false;
    }

    // Set event application status
    public function set_event_application_status($event_id, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return ["status" => "error", "message" => "Unauthorized user type"];
        }

        // Logic to set application status (e.g., update status in DB)
        return ["status" => "success", "message" => "Application status updated"];
    }

    // Set event requirements
    public function set_event_requirements($event_id, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return ["status" => "error", "message" => "Unauthorized user type"];
        }

        // Logic to set requirements (e.g., save to DB)
        return ["status" => "success", "message" => "Requirements set"];
    }

    // Modify event requirements
    public function modify_event_requirements($event_id, $new_requirements, $userTypeID)
    {
        if ($this->userTypeID !== $userTypeID) {
            return false;
        }

        // Logic to update requirements
        return true;
    }

    // Get event requirements
    public function get_event_requirements($event_id)
    {
        // Logic to fetch requirements (e.g., fetch from DB)
        return [];
    }

    // Get all roles for an event
    public function getAllRolesForEvent()
    {
        // Logic to fetch roles (e.g., fetch from DB)
        return [];
    }

    // Check if a role is valid for the event
    public function isRoleValidForEvent($roleId)
    {
        // Logic to validate role
        return true;
    }

    // Add a role to a requirement for the event
    public function addRoleToRequirementForEvent($requirementId, $roleId)
    {
        // Logic to add role to requirement
        return true;
    }

    // Remove a role from a requirement of the event
    public function removeRoleFromRequirementOfEvent($requirementId, $roleId)
    {
        // Logic to remove role from requirement
        return true;
    }
}
?>
