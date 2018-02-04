<?php
class TokenProxy{
    protected $http;

    public function __construct(\GuzzleHttp\Client $http){
        $this->http = $http;
    }

    public function proxy($grantType, array $data=[]){
        // /oauth/token
        $data = array_merge($data,[
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SCRECT'),
            'grant_type' => $grant_type,
        ]);
        $response = $this->http->post('http://xxxxxx/oauth/token',[
            'form_params' => $data
        ]);
        
        $token = json_decode((string) $response->getBody(), true);
        
        return response()->json([
            'token' => $token['access_token'],
            'expires_in' => $token['expires_in']
        ])->cookie('refreshToken', $token['refresh_token'], 86400, null, null, false, true);
    }

}
