<?
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

$dom = new Dom;
$dom->loadFromUrl('https://laminat-tula.ru/catalog/keramogranit/kerranova/-keramogranit-k-40-lr-light-beige-60x60-ot-kerranova-%28rossiya%29/');
$arrMorePhoto = [];
$arrProps = [];
$contents = $dom->find('.container');

    $contentWrapper = $contents->find('.catalog-element-wrapper');
    $html = $contents->innerHtml;

    $morePhoto = $contentWrapper->find('.more-photo-wrapper')->find('.img-wrap');
    foreach ($morePhoto as $photo) {
        $arrMorePhoto[]['src'] = $photo->find('img')->getAttribute('src');
    }

    $resProperties = $contentWrapper->find('.prop-wrapper')->find('p');
    foreach ($resProperties as $key => $properties) {
        $arrProps[$key]['Name'] = $properties->text();
        $arrProps[$key]['Value'] = $properties->find('span')[0]->innerHtml;
    }

    $resCollection = $contents->find('.sumular_products_wrapp')->find('.catalog-wrapper')->find('.simular_product_slide_cont');
    foreach ($resCollection as $item) {
        $arrCollection[]['Name'] = $item->find('.caption')->find('.h3-style')->text();
    }

    $arrRes = array(
        '1' => array(
            'Name' => $dom->find('.big_container')[2]->find('.small_container')->find('h1')[0]->innerHtml,
            'PrevPhoto' => $contentWrapper->find('.modalZoom')->find('img')->getAttribute('src'),
            'MorePhoto' => $arrMorePhoto,
            'priceType' => array(
                '1' => array(
                    'Price' => $contentWrapper->find('.cost')->find('p')[0]->find('span')[0]->innerHtml,
                    'Unit' => 'м2',
                ),
                '2' => array(
                    'Price' => $contentWrapper->find('.cost')->find('p')[1]->find('span')[0]->innerHtml,
                    'Unit' => 'шт',
                )
            ),
            'Properties' => $arrProps,
            'Collection' => $arrCollection
        )
    );

$json = json_encode($arrRes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT, $depth = 512);
if($json) file_put_contents("example.json", $json);