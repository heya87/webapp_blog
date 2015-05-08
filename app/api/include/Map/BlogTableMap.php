<?php

namespace Map;

use \Blog;
use \BlogQuery;
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
 * This class defines the structure of the 'Blog' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BlogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.BlogTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Blog';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Blog';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Blog';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the idBlog field
     */
    const COL_IDBLOG = 'Blog.idBlog';

    /**
     * the column name for the Title field
     */
    const COL_TITLE = 'Blog.Title';

    /**
     * the column name for the Destination field
     */
    const COL_DESTINATION = 'Blog.Destination';

    /**
     * the column name for the User_idUser field
     */
    const COL_USER_IDUSER = 'Blog.User_idUser';

    /**
     * the column name for the Description field
     */
    const COL_DESCRIPTION = 'Blog.Description';

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
        self::TYPE_PHPNAME       => array('Idblog', 'Title', 'Destination', 'UserIduser', 'Description', ),
        self::TYPE_CAMELNAME     => array('idblog', 'title', 'destination', 'userIduser', 'description', ),
        self::TYPE_COLNAME       => array(BlogTableMap::COL_IDBLOG, BlogTableMap::COL_TITLE, BlogTableMap::COL_DESTINATION, BlogTableMap::COL_USER_IDUSER, BlogTableMap::COL_DESCRIPTION, ),
        self::TYPE_FIELDNAME     => array('idBlog', 'Title', 'Destination', 'User_idUser', 'Description', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idblog' => 0, 'Title' => 1, 'Destination' => 2, 'UserIduser' => 3, 'Description' => 4, ),
        self::TYPE_CAMELNAME     => array('idblog' => 0, 'title' => 1, 'destination' => 2, 'userIduser' => 3, 'description' => 4, ),
        self::TYPE_COLNAME       => array(BlogTableMap::COL_IDBLOG => 0, BlogTableMap::COL_TITLE => 1, BlogTableMap::COL_DESTINATION => 2, BlogTableMap::COL_USER_IDUSER => 3, BlogTableMap::COL_DESCRIPTION => 4, ),
        self::TYPE_FIELDNAME     => array('idBlog' => 0, 'Title' => 1, 'Destination' => 2, 'User_idUser' => 3, 'Description' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('Blog');
        $this->setPhpName('Blog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Blog');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idBlog', 'Idblog', 'INTEGER', true, null, null);
        $this->addColumn('Title', 'Title', 'VARCHAR', false, 45, null);
        $this->addColumn('Destination', 'Destination', 'LONGVARCHAR', false, null, null);
        $this->addForeignPrimaryKey('User_idUser', 'UserIduser', 'INTEGER' , 'User', 'idUser', true, null, null);
        $this->addColumn('Description', 'Description', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':User_idUser',
    1 => ':idUser',
  ),
), null, null, null, false);
        $this->addRelation('Post', '\\Post', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':Blog_idTrip',
    1 => ':idBlog',
  ),
), null, null, 'Posts', false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Blog $obj A \Blog object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getIdblog(), (string) $obj->getUserIduser()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Blog object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Blog) {
                $key = serialize(array((string) $value->getIdblog(), (string) $value->getUserIduser()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Blog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idblog', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('UserIduser', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idblog', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('UserIduser', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idblog', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 3 + $offset
                : self::translateFieldName('UserIduser', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? BlogTableMap::CLASS_DEFAULT : BlogTableMap::OM_CLASS;
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
     * @return array           (Blog object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BlogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BlogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BlogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BlogTableMap::OM_CLASS;
            /** @var Blog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BlogTableMap::addInstanceToPool($obj, $key);
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
            $key = BlogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BlogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Blog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BlogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BlogTableMap::COL_IDBLOG);
            $criteria->addSelectColumn(BlogTableMap::COL_TITLE);
            $criteria->addSelectColumn(BlogTableMap::COL_DESTINATION);
            $criteria->addSelectColumn(BlogTableMap::COL_USER_IDUSER);
            $criteria->addSelectColumn(BlogTableMap::COL_DESCRIPTION);
        } else {
            $criteria->addSelectColumn($alias . '.idBlog');
            $criteria->addSelectColumn($alias . '.Title');
            $criteria->addSelectColumn($alias . '.Destination');
            $criteria->addSelectColumn($alias . '.User_idUser');
            $criteria->addSelectColumn($alias . '.Description');
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
        return Propel::getServiceContainer()->getDatabaseMap(BlogTableMap::DATABASE_NAME)->getTable(BlogTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BlogTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BlogTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BlogTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Blog or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Blog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BlogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Blog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BlogTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(BlogTableMap::COL_IDBLOG, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(BlogTableMap::COL_USER_IDUSER, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = BlogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BlogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BlogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Blog table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BlogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Blog or Criteria object.
     *
     * @param mixed               $criteria Criteria or Blog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BlogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Blog object
        }

        if ($criteria->containsKey(BlogTableMap::COL_IDBLOG) && $criteria->keyContainsValue(BlogTableMap::COL_IDBLOG) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BlogTableMap::COL_IDBLOG.')');
        }


        // Set the correct dbName
        $query = BlogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BlogTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BlogTableMap::buildTableMap();
