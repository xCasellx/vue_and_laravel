<?php


namespace App\Classes;


use App\Models\ParseData;
use Illuminate\Support\Facades\Validator;
use Maknz\Slack\Client;
use phpQuery;

class Parser
{
    private $url ;
    private $client;
    private $query;

    public function __construct($url)
    {
        $this->url = $url;
        $this->client = new Client(env("SLACK_NOTIFICATION_WEBHOOK"));
    }

    public function run()
    {
        $links = $this->getParserLink($this->url);
        $this->GetParserData($links);
    }

    private function getParserUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; WinNT; en; rv:1.0.2) Gecko/20030311 Beonex/0.8.2-stable');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER ,false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    private function getParserLink($url)
    {
        $parse = $this->getParserUrl($url);
        $mass = [];
        $dom = phpQuery::newDocument($parse);
        foreach ($dom->find(".space > .lheight22") as $key => $value){
            $pq = pq($value);
            $link = $pq->find("a")->attr("href");
            $validation = Validator::make(
                array("link" => $link),
                array("link" => "unique:parse_data"));
            if(!$validation->fails()) {
                $mass[] = $link;
            }
        }
        phpQuery::unloadDocuments();
        return $mass;
    }

    private function getParserData($links)
    {
        if(count($links) === 0) {
            return 0;
        }
        foreach ($links as $link) {
            $validation = Validator::make(
                array("link" => $link),
                array("link" => "unique:parse_data"));
            if(!$validation->fails()) {
                $data = new ParseData;
                $parse = $this->getParserUrl($link);
                $dom = phpQuery::newDocument($parse);
                $data["link"]  = $link;
                $data["title"] = trim($dom->find(".offer-titlebox > h1")->text(),"\n ");
                $data["image"] = $dom->find("#descImage > img")->attr("src");
                $data["price"] = $dom->find(".pricelabel__value")->text();
                $data["description"] = trim($dom->find("#textContent")->text(), "\n ");

                foreach ($dom->find(".offer-details__item") as $key => $value) {
                    $pq = pq($value);
                    if($pq->find(".offer-details__name")->text() == 'Год выпуска') {
                        $data["year_of_issue"] = $pq->find(".offer-details__value")->text();
                    }
                    if($pq->find(".offer-details__name")->text() == 'Вид топлива') {
                        $data["type_of_fuel"] = $pq->find(".offer-details__value")->text();
                    }
                    if($pq->find(".offer-details__name")->text() == 'Пробег') {
                        $data["mileage"] = $pq->find(".offer-details__value")->text();
                    }
                }
                $this->client->send("Найдено новое объявление:
                               *Год выпуска*: ". $data["year_of_issue"]."
                               *Вид топлива*: ". $data["type_of_fuel"]."
                               *Пробег*: ". $data["mileage"]."
                               *Стоимость*: ". $data["price"]."
                               <$link|*Ссылка*>
                               *Описание*: ".$data["description"]);
                $data->save();
                phpQuery::unloadDocuments();
            }

        }
        return true;
    }

}
