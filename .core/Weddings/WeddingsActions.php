<?php

class WeddingActions
{
    public static function clearFilters() : void
    {
        if (isset($_GET['clearFilter'])) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            die();
        }
    }

    public static function getWeddingItemsTable() : array
    {
        return WeddingLogic::getWeddingWithParams(
            $_GET['fio_bride'] ?? null,
            $_GET['fio_groom'] ?? null,
            $_GET['min_budget'] ?? null,
            $_GET['max_budget'] ?? null,
            $_GET['host_id'] ?? null
        );
    }

    public static function getHostsOptions() : string
    {
        return WeddingLogic::getHostsOptions($_GET['host_id'] ?? null);
    }

    public static function getBudgetRange() : array
    {
        return WeddingLogic::getMinMaxBudget();
    }
}
