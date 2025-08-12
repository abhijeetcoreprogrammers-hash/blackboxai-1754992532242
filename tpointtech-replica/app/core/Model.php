<?php
/**
 * Base Model Class
 * Provides common database functionality for all models
 */

class Model {
    protected $pdo;
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $hidden = [];
    
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    
    /**
     * Find record by ID
     */
    public function find($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            
            if ($result) {
                return $this->hideFields($result);
            }
            return null;
        } catch (PDOException $e) {
            error_log("Find error in {$this->table}: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Find all records
     */
    public function findAll($conditions = [], $orderBy = null, $limit = null, $offset = 0) {
        try {
            $sql = "SELECT * FROM {$this->table}";
            $params = [];
            
            if (!empty($conditions)) {
                $whereClause = [];
                foreach ($conditions as $field => $value) {
                    if (is_array($value)) {
                        $placeholders = str_repeat('?,', count($value) - 1) . '?';
                        $whereClause[] = "{$field} IN ({$placeholders})";
                        $params = array_merge($params, $value);
                    } else {
                        $whereClause[] = "{$field} = ?";
                        $params[] = $value;
                    }
                }
                $sql .= " WHERE " . implode(' AND ', $whereClause);
            }
            
            if ($orderBy) {
                $sql .= " ORDER BY {$orderBy}";
            }
            
            if ($limit) {
                $sql .= " LIMIT {$limit}";
                if ($offset > 0) {
                    $sql .= " OFFSET {$offset}";
                }
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $results = $stmt->fetchAll();
            
            return array_map([$this, 'hideFields'], $results);
        } catch (PDOException $e) {
            error_log("FindAll error in {$this->table}: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Find one record by conditions
     */
    public function findOne($conditions = []) {
        $results = $this->findAll($conditions, null, 1);
        return !empty($results) ? $results[0] : null;
    }
    
    /**
     * Create new record
     */
    public function create($data) {
        try {
            // Filter data based on fillable fields
            $filteredData = $this->filterFillable($data);
            
            if (empty($filteredData)) {
                return false;
            }
            
            $fields = array_keys($filteredData);
            $placeholders = str_repeat('?,', count($fields) - 1) . '?';
            
            $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES ({$placeholders})";
            $stmt = $this->pdo->prepare($sql);
            
            if ($stmt->execute(array_values($filteredData))) {
                return $this->pdo->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log("Create error in {$this->table}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Update record
     */
    public function update($id, $data) {
        try {
            $filteredData = $this->filterFillable($data);
            
            if (empty($filteredData)) {
                return false;
            }
            
            $fields = array_keys($filteredData);
            $setClause = implode(' = ?, ', $fields) . ' = ?';
            
            $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = ?";
            $params = array_merge(array_values($filteredData), [$id]);
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Update error in {$this->table}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Delete record
     */
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete error in {$this->table}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Count records
     */
    public function count($conditions = []) {
        try {
            $sql = "SELECT COUNT(*) as count FROM {$this->table}";
            $params = [];
            
            if (!empty($conditions)) {
                $whereClause = [];
                foreach ($conditions as $field => $value) {
                    $whereClause[] = "{$field} = ?";
                    $params[] = $value;
                }
                $sql .= " WHERE " . implode(' AND ', $whereClause);
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch();
            
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            error_log("Count error in {$this->table}: " . $e->getMessage());
            return 0;
        }
    }
    
    /**
     * Execute custom query
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Execute custom query and return single result
     */
    public function queryOne($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("QueryOne error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Begin transaction
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }
    
    /**
     * Commit transaction
     */
    public function commit() {
        return $this->pdo->commit();
    }
    
    /**
     * Rollback transaction
     */
    public function rollback() {
        return $this->pdo->rollback();
    }
    
    /**
     * Get paginated results
     */
    public function paginate($page = 1, $perPage = 20, $conditions = [], $orderBy = null) {
        $offset = ($page - 1) * $perPage;
        $data = $this->findAll($conditions, $orderBy, $perPage, $offset);
        $total = $this->count($conditions);
        
        return [
            'data' => $data,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
            'has_next' => $page < ceil($total / $perPage),
            'has_prev' => $page > 1
        ];
    }
    
    /**
     * Search records
     */
    public function search($query, $fields = [], $limit = 50) {
        if (empty($fields)) {
            return [];
        }
        
        try {
            $searchConditions = [];
            $params = [];
            
            foreach ($fields as $field) {
                $searchConditions[] = "{$field} LIKE ?";
                $params[] = "%{$query}%";
            }
            
            $sql = "SELECT * FROM {$this->table} WHERE " . implode(' OR ', $searchConditions);
            
            if ($limit) {
                $sql .= " LIMIT {$limit}";
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $results = $stmt->fetchAll();
            
            return array_map([$this, 'hideFields'], $results);
        } catch (PDOException $e) {
            error_log("Search error in {$this->table}: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Filter data based on fillable fields
     */
    protected function filterFillable($data) {
        if (empty($this->fillable)) {
            return $data;
        }
        
        return array_intersect_key($data, array_flip($this->fillable));
    }
    
    /**
     * Hide sensitive fields from result
     */
    protected function hideFields($data) {
        if (empty($this->hidden) || !is_array($data)) {
            return $data;
        }
        
        foreach ($this->hidden as $field) {
            unset($data[$field]);
        }
        
        return $data;
    }
    
    /**
     * Validate data
     */
    public function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            $ruleArray = explode('|', $rule);
            
            foreach ($ruleArray as $singleRule) {
                if ($singleRule === 'required' && empty($value)) {
                    $errors[$field] = ucfirst($field) . ' is required';
                    break;
                }
                
                if ($singleRule === 'unique') {
                    $existing = $this->findOne([$field => $value]);
                    if ($existing) {
                        $errors[$field] = ucfirst($field) . ' already exists';
                        break;
                    }
                }
                
                if (strpos($singleRule, 'min:') === 0) {
                    $min = (int)substr($singleRule, 4);
                    if (strlen($value) < $min) {
                        $errors[$field] = ucfirst($field) . " must be at least {$min} characters";
                        break;
                    }
                }
                
                if (strpos($singleRule, 'max:') === 0) {
                    $max = (int)substr($singleRule, 4);
                    if (strlen($value) > $max) {
                        $errors[$field] = ucfirst($field) . " must not exceed {$max} characters";
                        break;
                    }
                }
                
                if ($singleRule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = ucfirst($field) . ' must be a valid email address';
                    break;
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Get table name
     */
    public function getTable() {
        return $this->table;
    }
    
    /**
     * Get primary key
     */
    public function getPrimaryKey() {
        return $this->primaryKey;
    }
    
    /**
     * Get last inserted ID
     */
    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Check if record exists
     */
    public function exists($conditions) {
        return $this->count($conditions) > 0;
    }
    
    /**
     * Increment field value
     */
    public function increment($id, $field, $amount = 1) {
        try {
            $sql = "UPDATE {$this->table} SET {$field} = {$field} + ? WHERE {$this->primaryKey} = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$amount, $id]);
        } catch (PDOException $e) {
            error_log("Increment error in {$this->table}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Decrement field value
     */
    public function decrement($id, $field, $amount = 1) {
        try {
            $sql = "UPDATE {$this->table} SET {$field} = {$field} - ? WHERE {$this->primaryKey} = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$amount, $id]);
        } catch (PDOException $e) {
            error_log("Decrement error in {$this->table}: " . $e->getMessage());
            return false;
        }
    }
}
?>
