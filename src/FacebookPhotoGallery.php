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
    public function albums($limit = null, $before = null, $after = null)
    {
        $fields = 'name,link,created_time,cover_photo{picture,images.limit(1)}';

        $response = $this->client->request(
            'GET',
            $this->pageId .
            '/albums?fields=' . $fields .
            '&access_token=' . $this->accessToken .
            '&before=' . $before .
            '&after=' . $after .
            '&limit=' . $limit
        );

        $results = json_decode($response->getBody());

        return $results;
    }

    public function albumPhotos($albumId, $limit = null, $before = null, $after = null)
    {
        $fields = 'photo_count,photos{images,name}';

        $response = $this->client->request(
            'GET',
            $albumId .
            '/photos?fields=' . $fields .
            '&accessToken=' . $this->accessToken .
            '&before=' . $before .
            '&after=' . $after .
            '&limit=' . $limit
        );

        $results = json_decode($response->getBody());

        return $results;
    }
}
