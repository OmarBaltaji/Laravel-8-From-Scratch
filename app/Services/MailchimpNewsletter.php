<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
  public function __construct(protected ApiClient $client)
  {
    // 
  }

  public function subscribe(string $email, string $list = null) 
  {
    $list ??= config('services.mailchimp.lists.subscribers');

    return $this->client->lists->addListMember($list, [
      "email_address" => $email,
      "status" => "subscribed",
    ]);
  }

  public static function notify($campaign_id)
  {
    $client = self::setupClient();
    $emails = auth()->user()->followers->pluck('email');
    if(!$emails->isEmpty() && !empty($campaign_id)) {
      $campaign = $client->campaigns->get($campaign_id);
      if($campaign) {
        return $client->campaigns->sendTestEmail($campaign_id, [
          "test_emails" => $emails->toArray(),
          "send_type" => "html",
        ]);
      }
      return true;
    }
  }

  public static function setupClient()
  {
    return (new ApiClient())->setConfig([
      'apiKey' => config('services.mailchimp.key'),
      'server' => 'us12'
    ]);
  }
}