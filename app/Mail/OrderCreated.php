<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $delivery;
    public $payment;
    public $items;
    public $totalPrice;

    /**
     * Create a new message instance.
     *
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->items = resolve('storage.item')->getItemsByOrderId($order->id);
        $this->totalPrice = 0;
        foreach ($this->items as $item) {
            $this->totalPrice += $item->order_count * $item->order_price;
        }

        switch ($order->delivery_type) {
            case 1:
                $this->delivery = 'Новая Почта, город ' . $order->delivery_city . ', отделение №' . $order->delivery_address;
                break;
            case 2:
                $this->delivery = 'Самовывоз по адресу г. Киев, ул. Кирилловская 40р с 9:00 до 19:00';
                break;
            case 3:
                $this->delivery = 'Доставка курьером по Киеву на адрес: ' . $order->delivery_address;
                break;
            default:
                $this->delivery = 'Тип доставки не определен.';
                break;
        }

        switch ($order->payment_type) {
            case 1:
                $this->payment = 'Наличными курьеру при получении!';
                break;
            case 2:
                $this->payment = 'На карту приватбанка.';
                break;
            default:
                $this->payment = 'Форма оплаты не определена.';
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->order->user_name . ', спасибо за заказ')
            ->view('emails.order-created');
    }
}
