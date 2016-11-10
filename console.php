<?php
require_once "app/core/Loader.php";
// TODO Fix configuration in console.php
//$config = json_decode(file_get_contents("config.json"));
$consoleHandler = new ConsoleHandler($config);
if(isset($argv[1])){
    switch ($argv[1]){
        case "crawl:test":
            echo "Insert url: ";
            $url = readline();
            $crawler = new Crawler($url, new ConfigurationHandler(dirname(__FILE__) . "/app/config/config.json"));
            file_put_contents("textcurl.html", $crawler->getContent());
            break;
        case "crawl:start":
            $handler = new CrawlHandler();
            $handler->fetchUrlsFromFile();
            $itemsExport = array();
            $archives = $handler->getArchives();
            $countSingles = 0;
            foreach($archives as $archive){
                $countSingles += count($archive->getItems());
            }
            $count = 0;
            echo "\nFetching items:\n";
            foreach($archives as $archive){
                foreach($archive->getItems() as $item){
                    $percent = round((($count++ / $countSingles) * 100), 0);
                    $memory = round(memory_get_usage(true) / 1024 / 1024, 0);
                    echo "Progress: {$percent}% | Done: {$count}/{$countSingles} | Memory: {$memory}MB\r";
                    $itemsExport[] = $item->getExport();
                    file_put_contents("items.json", json_encode($itemsExport, JSON_UNESCAPED_UNICODE));
                    $item->destroy();
                }
            }
        break;
        case "single:fields:add":
            $config = $consoleHandler->addField();
            break;
        case "single:fields:remove":
            $config = $consoleHandler->removeField();
            break;
        case "archive:items:edit":
            $config = $consoleHandler->editArchiveItems();
            break;
        case "archive:nextpage:edit":
            $config = $consoleHandler->editArchiveNextpage();
            break;
        case "cache:clear":
            $consoleHandler->clearCache();
            break;
        case "html:clear":
            $consoleHandler->clearHtml();
            break;
        case "images:clear":
            $consoleHandler->clearImages();
            break;
    }
//    file_put_contents("config.json", json_encode($config, JSON_UNESCAPED_UNICODE));
} else {
    echo "Console Usage:\n";
    echo "- - - - - - - \n";
    echo "console crawl:test\n";
    echo "console crawl:start\n";
    echo "console single:fields:add\n";
    echo "console single:fields:remove\n";
    echo "console archive:items:edit\n";
    echo "console archive:nextpage:edit\n";
}