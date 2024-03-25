<?php
namespace App\Util;


class Helper {
public static function pagination(array $items, int $itemPerPage) {

    $currentPage = $_GET[PAGINATION];
    $totalItems = count($items);
    $totalPages = ceil($totalItems / $itemPerPage);
    if (!isset($currentPage) || !is_numeric($currentPage)) {
        header("location:" . createOrUpdateParams(PAGINATION."=1"));
        exit;
    }

    $nextPage = $currentPage + 1 > $totalPages  ? $totalPages : $currentPage + 1;
    $previousPage = $currentPage - 1 < 1 ? 1: $currentPage - 1;

    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
        $nextPage = $currentPage;
        header("location:" . createOrUpdateParams(PAGINATION ."=$currentPage"));
        exit;
    } else if ($currentPage < 1) {
        $currentPage = 1;
        $previousPage = $currentPage;
        header("location:" . createOrUpdateParams(PAGINATION."=$currentPage"));
        exit;
    }

    $startItem = $currentPage == 1 ? 1 :($currentPage-1) * $itemPerPage + 1;
    $endItem = $currentPage == 1 ? $itemPerPage : $currentPage * $itemPerPage;
    $trackingIndex = 1;
    $showItems = [];
    foreach ($items as $key => $value) {
        if ($trackingIndex >= $startItem && $trackingIndex <= $endItem) {
            $showItems[$key] = $value;
        }
        $trackingIndex++;
    }
    return [$currentPage,$totalPages, $previousPage, $nextPage, $startItem, $endItem, $showItems];
}

}
