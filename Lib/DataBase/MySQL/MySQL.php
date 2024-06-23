<?php

# - NameSpace
    namespace Lib\Database\MySQL;
    use PDO;
    use PDOException;
    use Lib\Database\MySQL\MySQLCore;
    use Lib\Logger;

# - MySQL
    class MySQL extends MySQLCore
    {
        private $connection;

        public function __construct()
        {
            $this->connection = MySQLCore::getConnection();
        }

        public function insert(string $query, array $arrValues): int
        {
            try {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($arrValues);
                return $this->connection->lastInsertId();
            } catch (PDOException $e) {
                Logger::log("ARTICMI/ART00M1", "Insert failed: " . $e->getMessage());
                return 0;
            }
        }

        public function select(string $query): ?array
        {
            try {
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                Logger::log("ARTICMI/ART00M2", "Select failed: " . $e->getMessage());
                return null;
            }
        }

        public function selectAll(string $query): ?array
        {
            try {
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                Logger::log("ARTICMI/ART00M3", "Select all failed: " . $e->getMessage());
                return null;
            }
        }

        public function update(string $query, array $arrValues): bool
        {
            try {
                $stmt = $this->connection->prepare($query);
                return $stmt->execute($arrValues);
            } catch (PDOException $e) {
                Logger::log("ARTICMI/ART00M4", "Update failed: " . $e->getMessage());
                return false;
            }
        }

        public function delete(string $query): bool
        {
            try {
                $stmt = $this->connection->prepare($query);
                return $stmt->execute();
            } catch (PDOException $e) {
                Logger::log("ARTICMI/ART00M5", "Delete failed: " . $e->getMessage());
                return false;
            }
        }
    }