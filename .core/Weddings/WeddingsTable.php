<?php

class WeddingTable
{
    public static function getHosts(): array
    {
        $query = Database::prepare("SELECT id, fio_host FROM wedding_host");
        $query->execute();
        return $query->fetchAll();
    }

    public static function getMinMaxBudget(): array
    {
        $query = Database::prepare("SELECT MIN(budget) AS min_budget, MAX(budget) AS max_budget FROM wedding");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function getWeddingsWithParams(array $params): array
    {
        $where = [];
        $bindings = [];

        if (isset($params['fio_bride'])) {
            $where[] = "wedding.fio_bride LIKE :fio_bride";
            $bindings[':fio_bride'] = $params['fio_bride'];
        }

        if (isset($params['fio_groom'])) {
            $where[] = "wedding.fio_groom LIKE :fio_groom";
            $bindings[':fio_groom'] = $params['fio_groom'];
        }

        if (isset($params['min_budget'])) {
            $where[] = "wedding.budget >= :min_budget";
            $bindings[':min_budget'] = $params['min_budget'];
        }

        if (isset($params['max_budget'])) {
            $where[] = "wedding.budget <= :max_budget";
            $bindings[':max_budget'] = $params['max_budget'];
        }

        if (isset($params['host_id'])) {
            $where[] = "wedding.id_host = :host_id";
            $bindings[':host_id'] = $params['host_id'];
        }

        $queryStr = 'SELECT wedding.id, wedding.fio_bride, wedding.fio_groom, wedding.text_invitation, wedding.photo_couple, wedding.budget, wedding_host.fio_host 
                     FROM wedding 
                     INNER JOIN wedding_host ON wedding.id_host = wedding_host.id' .
            (!empty($where) ? ' WHERE ' . implode(' AND ', $where) : '');

        $stmt = Database::prepare($queryStr);
        foreach ($bindings as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
