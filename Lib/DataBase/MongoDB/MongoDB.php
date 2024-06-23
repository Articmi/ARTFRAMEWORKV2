<?php

# - NameSpace
    namespace Lib\Database\MySQL;
    use MongoDB\Database;
    use MongoDB\Driver\Exception\Exception;
    use Lib\Database\MongoDB\MongoCore;
    use Lib\Logger;

# - MongoDB
    class MongoDB
    {
        private $database;

        public function __construct()
        {
            $this->database = MongoCore::getDatabase();
        }

        public function insert(string $collection, array $document): ?string
        {
            try {
                $result = $this->database->$collection->insertOne($document);
                return $result->getInsertedId();
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0MO1", "Failed to insert into the database: " . $e->getMessage());
                return null;
            }
        }

        public function select(string $collection, array $filter = []): ?array
        {
            try {
                $document = $this->database->$collection->findOne($filter);
                return $document ? $document->jsonSerialize() : null;
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0MO2", "Failed to retrieve data from the database: " . $e->getMessage());
                return null;
            }
        }

        public function selectAll(string $collection, array $filter = []): ?array
        {
            try {
                $documents = $this->database->$collection->find($filter);
                return iterator_to_array($documents);
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0MO3", "Failed to retrieve all data from the database: " . $e->getMessage());
                return null;
            }
        }

        public function update(string $collection, array $filter, array $update): bool
        {
            try {
                $result = $this->database->$collection->updateOne($filter, ['$set' => $update]);
                return $result->isAcknowledged();
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0MO4", "Failed to update the database: " . $e->getMessage());
                return false;
            }
        }

        public function delete(string $collection, array $filter): bool
        {
            try {
                $result = $this->database->$collection->deleteOne($filter);
                return $result->isAcknowledged();
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0MO5", "Failed to delete from the database: " . $e->getMessage());
                return false;
            }
        }
    }