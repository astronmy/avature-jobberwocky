<?php
namespace App\Enums;

enum AlertMethodEnum: string {
    case EMAIL = 'email';
    case MOBILE = 'sms';
    case PUSH = 'push';
}
