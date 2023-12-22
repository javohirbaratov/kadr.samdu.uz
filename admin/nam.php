

<?php 

    function HTTPPost($url, array $params) {
        $query = http_build_query($params);
        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

$val = HTTPPost("https://downloadgram.org/#downloadhere",array(
	"url" => "https://www.instagram.com/tv/CYweXEbA4gg/?utm_source=ig_web_copy_link",
	"locale" =>"en",
	"submit" =>"https://instafinsta.com",
	"_token" =>"4TDqkp60p9tP5K11nAsPywcKsKFetRxysmwtUWt8",
));
$doc = new DOMDocument();
$doc->loadXML("$val");
echo $doc->saveXML();
 ?>