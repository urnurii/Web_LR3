<?php

class WeddingLogic
{
    public static function getWeddingWithParams(?string $fio_bride, ?string $fio_groom, ?int $min_budget, ?int $max_budget, ?int $host_id): array
    {
        $params = [];

        if (!empty($fio_bride)) {
            $params['fio_bride'] = "%$fio_bride%";
        }

        if (!empty($fio_groom)) {
            $params['fio_groom'] = "%$fio_groom%";
        }

        if (!empty($min_budget)) {
            $params['min_budget'] = $min_budget;
        }

        if (!empty($max_budget)) {
            $params['max_budget'] = $max_budget;
        }

        if (!empty($host_id)) {
            $params['host_id'] = $host_id;
        }

        return WeddingTable::getWeddingsWithParams($params);
    }

    public static function getHostsOptions($selectedHost): string
    {
        $html = '<option value="">Все организаторы</option>';

        $hosts = WeddingTable::getHosts();

        foreach ($hosts as $host) {
            $selected = ((int)$selectedHost === $host['id']) ? ' selected' : '';
            $html .= '<option value="' . $host['id'] . '"' . $selected . '>' . htmlspecialchars($host['fio_host']) . '</option>';
        }

        return $html;
    }

    public static function getMinMaxBudget(): array
    {
        return WeddingTable::getMinMaxBudget();
    }
}
