<?php
namespace KeriganSolutions\FacebookPhotoGallery;

use GuzzleHttp\Client;

class FacebookPhotoGallery
{
    public static function albums()
    {
        $accessToken = FACEBOOK_ACCESS_TOKEN;
        $pageId      = FACEBOOK_PAGE_ID;
        $fields      = 'albums{name,link,created_time,cover_photo{images.limit(1)}}';

        $client = new Client(['base_uri' => '"https://graph.facebook.com/v2.11/']);

        $response = $client->request(
            'GET',
            $pageId.'?fields='.$fields
        );

        $results = json_decode($response->getBody());

        return $results;
    }
}
