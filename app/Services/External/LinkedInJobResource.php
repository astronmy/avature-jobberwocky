<?php

namespace App\Services\External;

use Illuminate\Support\Collection;

class LinkedInJobResource extends ExternalPartener {

    public function setUp(): void {
        //set up partner, config base uri desde variables de entornos, etc
    }
    public function mapResponse(): array {
        //Mapea la respuesta a un array de JobDTO para mantener la logica con los otros servicios
        //Aca esta la lógicca asociada a cada partner
    }
    protected function searchByParams(): Collection {
        //Realiza llamada HTTP al partner
    }
}
