<?php

namespace App\Types;

enum UserProfile: string {
    case ADMIN = 'administrador';
    case VIGILANT = 'vigilante';
    case CLIENT = 'cliente';

    /**
     * @return string
     */
    public function label(): string {
        return ucfirst($this->value);
    }
}