<?php
namespace KeriganSolutions\FacebookPhotoGallery;

use GuzzleHttp\Client;

class FacebookPhotoGallery
{

    public function __construct()
    {
        $this->accessToken = FACEBOOK_ACCESS_TOKEN;
        $this->pageId      = FACEBOOK_PAGE_ID;
        $this->client      = new Client(['base_uri' => 'https://graph.facebook.com/v2.11/']);
    }
    public static function albums($after = null)
    {
        $fields = 'name,link,created_time,cover_photo{picture,images.limit(1)}';

        $response = $this->client->request(
            'GET',
            $this->pageId.'/albums?fields='.$fields. '&after='. $after . '&access_token='.$this->accessToken
        );

        $results = json_decode($response->getBody());

        return $results->data;
    }

    public function albumPhotos($albumId, $after)
    {
        $fields = 'photo_count,photos{images,name}';

        $response = $this->client->request(
            'GET',
            $albumId . '?fields=' . $fields . '&after=' . $after . '&accessToken=' . $this->accessToken
        );

        $results = json_decode($response->getBody());

        return $results->data;
    }
}
