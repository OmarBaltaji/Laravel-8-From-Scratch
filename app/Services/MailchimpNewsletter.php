<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
  public function __construct(protected ApiClient $client) // , protected string $foobar (if we want to add a variable we need to register it in AppServiceProvider)
  {
    // 
  }

  public function subscribe(string $email, string $list = null) 
  {
    $list ??= config('services.mailchimp.lists.subscribers');
    
    // $response = $mailchimp->ping->get();
    // $response = $mailchimp->lists->getAllLists();
    // $response = $mailchimp->lists->getList("bdb015d978");
    // $response = $mailchimp->lists->getListMembersInfo("bdb015d978");

    return $this->client->lists->addListMember($list, [
      "email_address" => $email,
      "status" => "subscribed",
    ]);
  }

  // protected function client()
  // {
  //   return $this->client->setConfig([
  //     'apiKey' => config('services.mailchimp.key'),
  //     'server' => 'us12'
  //   ]);
  // }
}