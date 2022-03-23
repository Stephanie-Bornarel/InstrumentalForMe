<?php

namespace Instrumental\Controllers;

use WP_Query;

class AppointmentController extends CoreController
{


    public function appointment()
    {
        $this->show('views/appointment.view');
    }
}
