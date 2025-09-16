<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'listing_published',
                'type' => 'event',
                'subject' => 'Your listing has been published',
                'content' => 'Hello {customer_name}, your listing "{listing_title}" has been successfully published.',
                'channels' => ['in_app'],
                'default_recipient' => 'specific_customers',
                'placeholders' => ['{customer_name}', '{listing_title}'],
                'is_active' => true,
            ],
            [
                'key' => 'wallet_credit',
                'type' => 'event',
                'subject' => 'Wallet Credited',
                'content' => 'An amount of {amount} has been credited to your wallet. Current balance: {balance}.',
                'channels' => ['in_app'],
                'default_recipient' => 'specific_customers',
                'placeholders' => ['{amount}', '{balance}'],
                'is_active' => true,
            ],
            [
                'key' => 'wallet_debit',
                'type' => 'event',
                'subject' => 'Wallet Debited',
                'content' => 'An amount of {amount} has been debited from your wallet. Current balance: {balance}.',
                'channels' => ['in_app'],
                'default_recipient' => 'specific_customers',
                'placeholders' => ['{amount}', '{balance}'],
                'is_active' => true,
            ],
            [
                'key' => 'order_placed',
                'type' => 'event',
                'subject' => 'Order Placed Successfully',
                'content' => 'Your order #{order_id} has been placed successfully. Total amount: {amount}.',
                'channels' => ['in_app'],
                'default_recipient' => 'specific_customers',
                'placeholders' => ['{order_id}', '{amount}'],
                'is_active' => true,
            ],
            [
                'key' => 'new_enquiry',
                'type' => 'event',
                'subject' => 'You have a new enquiry',
                'content' => 'A new enquiry has been received from {customer_name}.',
                'channels' => ['in_app'],
                'default_recipient' => 'specific_customers',
                'placeholders' => ['{customer_name}'],
                'is_active' => true,
            ],
            [
                'key' => 'new_order_received',
                'type' => 'event',
                'subject' => 'Your Listing Received a New Order',
                'content' => 'Your listing "#{listing_title}" has received a new order #{order_id} from {customer_name}.',
                'channels' => ['in_app'],
                'default_recipient' => 'listing_seller', // send to the seller of the listing
                'placeholders' => ['{listing_title}', '{order_id}', '{customer_name}'],
                'is_active' => true,
            ],

        ];

        foreach ($templates as $template) {
            NotificationTemplate::updateOrCreate(
                ['key' => $template['key']], // ensures no duplicates
                $template
            );
        }
    }
}
