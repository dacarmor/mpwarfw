<?php

namespace Mpwarfw\Component\Database;

class Database extends \PDO
{

    const DB_type = 'mysql';
    const DB_host = 'localhost';
    const DB_name = 'mpwarfw_davidcm';
    const DB_user = 'root';
    const DB_pass = 'strongpassword';

    public function __construct() {

        try {
            parent::__construct( self::DB_type . ':host=' . self::DB_host . ';dbname=' . self::DB_name, self::DB_user, self::DB_pass );
        }
        catch ( \PDOException $e ) {
            die( $e->getMessage() );
        }

    }

    public function select( $query, $array = array() ) {

        $statement = $this->prepare( $query );
        foreach ( $array as $key => $value ) {
            $statement->bindValue( ":$key", $value );
        }
        $statement->execute();
        return $statement->fetchAll( \PDO::FETCH_ASSOC );

    }

    public function insert( $table, $data ) {

        $columns = implode( ', ', array_keys( $data ) );
        $keyValues = ':' . implode( ', :', array_keys( $data ) );
        $statement = $this->prepare( 'INSERT INTO '. $table .' ('. $columns. ') VALUES ('. $keyValues .')' );
        foreach ( $data as $key => $value ) {
            $statement->bindValue( ":$key", $value );
        }
        return $statement->execute();

    }

    public function update( $table, $data, $where ) {

        $values = '';
        $conditions = '';
        foreach ( $data as $key => $value ) {
            $values .= "$key=:$key, ";
        }
        $values = rtrim( $values, ', ' );
        foreach ( $where as $key => $cond ) {
            $conditions .= "$key=:$key, ";
        }
        $conditions = rtrim( $conditions, ', ' );
        $statement = $this->prepare( 'UPDATE '. $table .' SET '. $values .' WHERE '. $conditions );
        foreach ( $data as $key => $value ) {
            $statement->bindValue( ":$key", $value );
        }
        foreach ( $where as $key => $cond ) {
            $statement->bindValue( ":$key", $cond );
        }
        return $statement->execute();

    }

    public function delete( $table, $where, $limit = 1 ) {
        
        return $this->exec( 'DELETE FROM '. $table .' WHERE '. $where .' LIMIT '. $limit );
    
    }
}