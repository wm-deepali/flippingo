<?php
namespace App\Helpers;


class SmsHelper
{
    public static function send($mobile, $message, $templateType = null, $params = [])
    {
        // Fetch settings
        $authKey = setting('auth_key', env('SMS_AUTH_KEY', '449195AevVjn7d6813877aP1'));
        $sender = setting('sender_id', env('SMS_SENDER_ID', 'ASHTWE'));
        $peId = setting('pe_id', env('SMS_PE_ID', 'default_pe_id'));

        $templates = json_decode(setting('sms_templates', '[]'), true);

        $templateData = null;
        if ($templates && is_array($templates)) {
            foreach ($templates as $template) {
                if ($templateType && isset($template['type']) && $template['type'] === $templateType) {
                    $templateData = $template;
                    break;
                }
            }
            if (!$templateData && count($templates) > 0) {
                $templateData = $templates[0];
            }
        }

        $templateId = $templateData['id'] ?? env('SMS_DLT_ID', '1707175291422915659');
        $templateText = $templateData['text'] ?? $message;

        // Replace variables inside template text from $params array
        foreach ($params as $key => $value) {
            $templateText = str_replace('{' . $key . '}', $value, $templateText);
        }

        $request_parameter = [
            'authkey' => $authKey,
            'mobiles' => $mobile,
            'sender' => $sender,
            'message' => urlencode($templateText),
            'route' => '4',
            'country' => '91',
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }

        if ($templateId) {
            $url .= 'DLT_TE_ID=' . $templateId . '&';
        }
        if ($peId) {
            $url .= 'PE_ID=' . $peId . '&';
        }

        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }

}
