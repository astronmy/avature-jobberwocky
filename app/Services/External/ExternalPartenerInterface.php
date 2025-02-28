<?php
namespace App\Services\External;

use Illuminate\Support\Collection;

abstract class ExternalPartner {

    abstract protected function setUp(): void;
    abstract protected function mapResponse(): array;
    abstract protected function request(): Collection;
}
