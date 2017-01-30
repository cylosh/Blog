<?php

namespace Map;

use \Articles;
use \ArticlesQuery;
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
 * This class defines the structure of the 'articles' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ArticlesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ArticlesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'articles';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Articles';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Articles';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'articles.id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'articles.user_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'articles.title';

    /**
     * the column name for the url field
     */
    const COL_URL = 'articles.url';

    /**
     * the column name for the content field
     */
    const COL_CONTENT = 'articles.content';

    /**
     * the column name for the tags field
     */
    const COL_TAGS = 'articles.tags';

    /**
     * the column name for the likes field
     */
    const COL_LIKES = 'articles.likes';

    /**
     * the column name for the img_path field
     */
    const COL_IMG_PATH = 'articles.img_path';

    /**
     * the column name for the img_frame field
     */
    const COL_IMG_FRAME = 'articles.img_frame';

    /**
     * the column name for the comments_allowed field
     */
    const COL_COMMENTS_ALLOWED = 'articles.comments_allowed';

    /**
     * the column name for the modified field
     */
    const COL_MODIFIED = 'articles.modified';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'articles.created';

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
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'Title', 'Url', 'Content', 'Tags', 'Likes', 'ImgPath', 'ImgFrame', 'CommentsAllowed', 'Modified', 'Created', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'title', 'url', 'content', 'tags', 'likes', 'imgPath', 'imgFrame', 'commentsAllowed', 'modified', 'created', ),
        self::TYPE_COLNAME       => array(ArticlesTableMap::COL_ID, ArticlesTableMap::COL_USER_ID, ArticlesTableMap::COL_TITLE, ArticlesTableMap::COL_URL, ArticlesTableMap::COL_CONTENT, ArticlesTableMap::COL_TAGS, ArticlesTableMap::COL_LIKES, ArticlesTableMap::COL_IMG_PATH, ArticlesTableMap::COL_IMG_FRAME, ArticlesTableMap::COL_COMMENTS_ALLOWED, ArticlesTableMap::COL_MODIFIED, ArticlesTableMap::COL_CREATED, ),
        self::TYPE_FIELDNAME     => array('id', 'user_id', 'title', 'url', 'content', 'tags', 'likes', 'img_path', 'img_frame', 'comments_allowed', 'modified', 'created', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'Title' => 2, 'Url' => 3, 'Content' => 4, 'Tags' => 5, 'Likes' => 6, 'ImgPath' => 7, 'ImgFrame' => 8, 'CommentsAllowed' => 9, 'Modified' => 10, 'Created' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'title' => 2, 'url' => 3, 'content' => 4, 'tags' => 5, 'likes' => 6, 'imgPath' => 7, 'imgFrame' => 8, 'commentsAllowed' => 9, 'modified' => 10, 'created' => 11, ),
        self::TYPE_COLNAME       => array(ArticlesTableMap::COL_ID => 0, ArticlesTableMap::COL_USER_ID => 1, ArticlesTableMap::COL_TITLE => 2, ArticlesTableMap::COL_URL => 3, ArticlesTableMap::COL_CONTENT => 4, ArticlesTableMap::COL_TAGS => 5, ArticlesTableMap::COL_LIKES => 6, ArticlesTableMap::COL_IMG_PATH => 7, ArticlesTableMap::COL_IMG_FRAME => 8, ArticlesTableMap::COL_COMMENTS_ALLOWED => 9, ArticlesTableMap::COL_MODIFIED => 10, ArticlesTableMap::COL_CREATED => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'user_id' => 1, 'title' => 2, 'url' => 3, 'content' => 4, 'tags' => 5, 'likes' => 6, 'img_path' => 7, 'img_frame' => 8, 'comments_allowed' => 9, 'modified' => 10, 'created' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('articles');
        $this->setPhpName('Articles');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Articles');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', false, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('content', 'Content', 'LONGVARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'LONGVARCHAR', false, null, null);
        $this->addColumn('likes', 'Likes', 'SMALLINT', false, null, null);
        $this->addColumn('img_path', 'ImgPath', 'VARCHAR', false, 55, null);
        $this->addColumn('img_frame', 'ImgFrame', 'VARCHAR', false, 25, null);
        $this->addColumn('comments_allowed', 'CommentsAllowed', 'BOOLEAN', false, 1, null);
        $this->addColumn('modified', 'Modified', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
        $this->addColumn('created', 'Created', 'TIMESTAMP', false, null, '0000-00-00 00:00:00');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
            'timestampable' => array('create_column' => 'created', 'update_column' => 'modified', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'sluggable' => array('slug_column' => 'url', 'slug_pattern' => '/blog/{Title}', 'replace_pattern' => '/[^\w]+/u', 'replacement' => '-', 'separator' => '/', 'permanent' => 'true', 'scope_column' => '', 'unique_constraint' => 'true', ),
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
        return $withPrefix ? ArticlesTableMap::CLASS_DEFAULT : ArticlesTableMap::OM_CLASS;
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
     * @return array           (Articles object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ArticlesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ArticlesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ArticlesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ArticlesTableMap::OM_CLASS;
            /** @var Articles $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ArticlesTableMap::addInstanceToPool($obj, $key);
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
            $key = ArticlesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ArticlesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Articles $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ArticlesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ArticlesTableMap::COL_ID);
            $criteria->addSelectColumn(ArticlesTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ArticlesTableMap::COL_TITLE);
            $criteria->addSelectColumn(ArticlesTableMap::COL_URL);
            $criteria->addSelectColumn(ArticlesTableMap::COL_CONTENT);
            $criteria->addSelectColumn(ArticlesTableMap::COL_TAGS);
            $criteria->addSelectColumn(ArticlesTableMap::COL_LIKES);
            $criteria->addSelectColumn(ArticlesTableMap::COL_IMG_PATH);
            $criteria->addSelectColumn(ArticlesTableMap::COL_IMG_FRAME);
            $criteria->addSelectColumn(ArticlesTableMap::COL_COMMENTS_ALLOWED);
            $criteria->addSelectColumn(ArticlesTableMap::COL_MODIFIED);
            $criteria->addSelectColumn(ArticlesTableMap::COL_CREATED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.content');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.likes');
            $criteria->addSelectColumn($alias . '.img_path');
            $criteria->addSelectColumn($alias . '.img_frame');
            $criteria->addSelectColumn($alias . '.comments_allowed');
            $criteria->addSelectColumn($alias . '.modified');
            $criteria->addSelectColumn($alias . '.created');
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
        return Propel::getServiceContainer()->getDatabaseMap(ArticlesTableMap::DATABASE_NAME)->getTable(ArticlesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ArticlesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ArticlesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ArticlesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Articles or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Articles object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticlesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Articles) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ArticlesTableMap::DATABASE_NAME);
            $criteria->add(ArticlesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ArticlesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ArticlesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ArticlesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the articles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ArticlesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Articles or Criteria object.
     *
     * @param mixed               $criteria Criteria or Articles object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticlesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Articles object
        }

        if ($criteria->containsKey(ArticlesTableMap::COL_ID) && $criteria->keyContainsValue(ArticlesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ArticlesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ArticlesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ArticlesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ArticlesTableMap::buildTableMap();
