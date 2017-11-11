<?php
namespace KeriganSolutions\FacebookPhotoGallery;

use GuzzleHttp\Client;

class FacebookPhotoGallery
{
    public static function albums()
    {
        $accessToken = FACEBOOK_ACCESS_TOKEN;
        $pageId      = FACEBOOK_PAGE_ID;
        $fields      = 'name,link,created_time,cover_photo{picture,images.limit(1)}';

        $client = new Client(['base_uri' => 'https://graph.facebook.com/v2.11/']);

        $response = $client->request(
            'GET',
            $pageId.'/albums?fields='.$fields.'&access_token='.$accessToken
        );

        $results = json_decode($response->getBody());

        return $results->data;
    }
}
