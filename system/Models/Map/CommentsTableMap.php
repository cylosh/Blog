<?php

namespace Map;

use \Comments;
use \CommentsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'comments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CommentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CommentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'comments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Comments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Comments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'comments.id';

    /**
     * the column name for the article_id field
     */
    const COL_ARTICLE_ID = 'comments.article_id';

    /**
     * the column name for the lft field
     */
    const COL_LFT = 'comments.lft';

    /**
     * the column name for the rgt field
     */
    const COL_RGT = 'comments.rgt';

    /**
     * the column name for the lvl field
     */
    const COL_LVL = 'comments.lvl';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'comments.user_id';

    /**
     * the column name for the content field
     */
    const COL_CONTENT = 'comments.content';

    /**
     * the column name for the flag field
     */
    const COL_FLAG = 'comments.flag';

    /**
     * the column name for the edited field
     */
    const COL_EDITED = 'comments.edited';

    /**
     * the column name for the posted field
     */
    const COL_POSTED = 'comments.posted';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'ArticleId', 'Lft', 'Rgt', 'Lvl', 'UserId', 'Content', 'Flag', 'Edited', 'Posted', ),
        self::TYPE_CAMELNAME     => array('id', 'articleId', 'lft', 'rgt', 'lvl', 'userId', 'content', 'flag', 'edited', 'posted', ),
        self::TYPE_COLNAME       => array(CommentsTableMap::COL_ID, CommentsTableMap::COL_ARTICLE_ID, CommentsTableMap::COL_LFT, CommentsTableMap::COL_RGT, CommentsTableMap::COL_LVL, CommentsTableMap::COL_USER_ID, CommentsTableMap::COL_CONTENT, CommentsTableMap::COL_FLAG, CommentsTableMap::COL_EDITED, CommentsTableMap::COL_POSTED, ),
        self::TYPE_FIELDNAME     => array('id', 'article_id', 'lft', 'rgt', 'lvl', 'user_id', 'content', 'flag', 'edited', 'posted', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ArticleId' => 1, 'Lft' => 2, 'Rgt' => 3, 'Lvl' => 4, 'UserId' => 5, 'Content' => 6, 'Flag' => 7, 'Edited' => 8, 'Posted' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'articleId' => 1, 'lft' => 2, 'rgt' => 3, 'lvl' => 4, 'userId' => 5, 'content' => 6, 'flag' => 7, 'edited' => 8, 'posted' => 9, ),
        self::TYPE_COLNAME       => array(CommentsTableMap::COL_ID => 0, CommentsTableMap::COL_ARTICLE_ID => 1, CommentsTableMap::COL_LFT => 2, CommentsTableMap::COL_RGT => 3, CommentsTableMap::COL_LVL => 4, CommentsTableMap::COL_USER_ID => 5, CommentsTableMap::COL_CONTENT => 6, CommentsTableMap::COL_FLAG => 7, CommentsTableMap::COL_EDITED => 8, CommentsTableMap::COL_POSTED => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'article_id' => 1, 'lft' => 2, 'rgt' => 3, 'lvl' => 4, 'user_id' => 5, 'content' => 6, 'flag' => 7, 'edited' => 8, 'posted' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('comments');
        $this->setPhpName('Comments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Comments');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('article_id', 'ArticleId', 'INTEGER', 'articles', 'id', false, null, null);
        $this->addColumn('lft', 'Lft', 'INTEGER', false, null, null);
        $this->addColumn('rgt', 'Rgt', 'INTEGER', false, null, null);
        $this->addColumn('lvl', 'Lvl', 'INTEGER', false, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', false, null, null);
        $this->addColumn('content', 'Content', 'LONGVARCHAR', false, null, null);
        $this->addColumn('flag', 'Flag', 'SMALLINT', false, null, null);
        $this->addColumn('edited', 'Edited', 'TIMESTAMP', false, null, null);
        $this->addColumn('posted', 'Posted', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Articles', '\\Articles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':article_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'posted', 'update_column' => 'edited', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'nested_set' => array('left_column' => 'lft', 'right_column' => 'rgt', 'level_column' => 'lvl', 'use_scope' => 'true', 'scope_column' => 'article_id', 'method_proxies' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CommentsTableMap::CLASS_DEFAULT : CommentsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Comments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CommentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CommentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CommentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CommentsTableMap::OM_CLASS;
            /** @var Comments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CommentsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CommentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CommentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Comments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CommentsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CommentsTableMap::COL_ID);
            $criteria->addSelectColumn(CommentsTableMap::COL_ARTICLE_ID);
            $criteria->addSelectColumn(CommentsTableMap::COL_LFT);
            $criteria->addSelectColumn(CommentsTableMap::COL_RGT);
            $criteria->addSelectColumn(CommentsTableMap::COL_LVL);
            $criteria->addSelectColumn(CommentsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(CommentsTableMap::COL_CONTENT);
            $criteria->addSelectColumn(CommentsTableMap::COL_FLAG);
            $criteria->addSelectColumn(CommentsTableMap::COL_EDITED);
            $criteria->addSelectColumn(CommentsTableMap::COL_POSTED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.article_id');
            $criteria->addSelectColumn($alias . '.lft');
            $criteria->addSelectColumn($alias . '.rgt');
            $criteria->addSelectColumn($alias . '.lvl');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.content');
            $criteria->addSelectColumn($alias . '.flag');
            $criteria->addSelectColumn($alias . '.edited');
            $criteria->addSelectColumn($alias . '.posted');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CommentsTableMap::DATABASE_NAME)->getTable(CommentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CommentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CommentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CommentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Comments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Comments object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Comments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CommentsTableMap::DATABASE_NAME);
            $criteria->add(CommentsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CommentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CommentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CommentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the comments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CommentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Comments or Criteria object.
     *
     * @param mixed               $criteria Criteria or Comments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Comments object
        }

        if ($criteria->containsKey(CommentsTableMap::COL_ID) && $criteria->keyContainsValue(CommentsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CommentsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CommentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CommentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CommentsTableMap::buildTableMap();
