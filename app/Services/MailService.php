<?php

namespace App\Services;

use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendOrderCreated($mailchimp, $order)
    {
        $listId = '69cc4edc88';
        try {
            Mail::to($order->user_email)
                ->send(new OrderCreated($order));

            $mailchimp
                ->lists
                ->subscribe(
                    $listId,
                    [
                        'email' => $order->user_email
                    ],
                    null,
                    'html',
                    false
                );

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
        } catch (\Mailchimp_Error $e) {
        } catch (\Throwable $e) {
        }
    }
}