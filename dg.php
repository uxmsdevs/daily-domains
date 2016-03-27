<?php

ini_set('memory_limit', '1024M');

$today = date('Y-m-d');
$dailyDomainsFolder = 'expired_domains/';
$todaysDomainsListFileName = "$today.txt";

$todaysDomainsListFileDir = $dailyDomainsFolder.$todaysDomainsListFileName;

// Create dir
if (!is_dir($dailyDomainsFolder)) {
    try {
        mkdir($dailyDomainsFolder);
    } catch (Exception $e) {
        // 
    }
}

// If today's domain not fetched yet..
if (!is_file($todaysDomainsListFileDir)) {
    try {
        $expiredDomainsList = fopen("http://domaingraveyard.com/list/$todaysDomainsListFileName", 'r');
        file_put_contents($todaysDomainsListFileDir, $expiredDomainsList);
    } catch (Exception $e) {
        //
    }
}

// Open today's domain list file
$todaysDomainList = file($todaysDomainsListFileDir, FILE_IGNORE_NEW_LINES);

echo '<h3>Total domain names expire today:</h3>'.count($todaysDomainList);
echo '<br>';

$rand = [];
for ($i = 0; $i < 5; $i++) { 
    $randNum = rand(1, count($todaysDomainList));
    $rand[] = $todaysDomainList[$randNum];
}

echo '<h3>random 5:</h3>';
foreach ($rand as $domain) {
    echo "$domain<br>";
}

