<?php
    namespace App\Types;

    enum AnimalStatus: string
    {
        case Sold = "sold";
        case Available = "Available";
    }
