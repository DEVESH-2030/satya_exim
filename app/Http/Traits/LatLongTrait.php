<?php
namespace App\Http\Traits;

trait LatLongTrait {

    /**
     * @method to fetch the Lat, Long From Address String
     * @param Address String 
     * @return lat, long 
     */
    public function geocode($address)
    {
        # url encode the address
        $address = urlencode($address);

        # Define the Api Key for Google Api
        $apiKey = 'AIzaSyC3tI2o08AKcPpSK40CbVIqMPzbjPHiglA';

        # google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=$apiKey ";

        # get the json response
        $resp_json = file_get_contents($url);

        # decode the json
        $resp = json_decode($resp_json, true);

        # response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK') {
            # get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

            # verify if data is complete
            if($lati && $longi && $formatted_address) {
                # put the data in the array
                $data_arr = array();

                # push Data in empty array
                array_push(
                $data_arr,
                $lati,
                $longi,
                $formatted_address
                );

                # return the data Array
                return $data_arr;
            } else {
                return false;
            }
        } else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }
}