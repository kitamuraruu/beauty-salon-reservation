<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'appointment_date', 'appointment_time', 'phone', 'menu_id'];
    
    public function saveAppointment($data)
    {
        return $this->insert($data);
    }
}
