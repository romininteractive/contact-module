<?php

namespace Modules\Contact\Entities;

interface ContactInterface
{
    /**
     * Checks if the user is in the given role.
     * @param  mixed $role
     * @return bool
     */
    public function getName();
    /**
     * Return the user's mobile number
     */
    public function mobileNo();
    /**
     * Return the user's email address
     */
    public function getEmail();
    /**
     * Return the user's device ID
     * for sending push notification
     */
    public function getDeviceId();
}
