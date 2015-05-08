<?php

namespace Base;

use \Image as ChildImage;
use \ImageQuery as ChildImageQuery;
use \Exception;
use \PDO;
use Map\ImageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Image' table.
 *
 *
 *
 * @method     ChildImageQuery orderByIdimage($order = Criteria::ASC) Order by the idImage column
 * @method     ChildImageQuery orderByTitle($order = Criteria::ASC) Order by the Title column
 * @method     ChildImageQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildImageQuery orderByPostIdpost($order = Criteria::ASC) Order by the Post_idPost column
 *
 * @method     ChildImageQuery groupByIdimage() Group by the idImage column
 * @method     ChildImageQuery groupByTitle() Group by the Title column
 * @method     ChildImageQuery groupByUrl() Group by the url column
 * @method     ChildImageQuery groupByPostIdpost() Group by the Post_idPost column
 *
 * @method     ChildImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildImageQuery leftJoinPost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Post relation
 * @method     ChildImageQuery rightJoinPost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Post relation
 * @method     ChildImageQuery innerJoinPost($relationAlias = null) Adds a INNER JOIN clause to the query using the Post relation
 *
 * @method     \PostQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildImage findOne(ConnectionInterface $con = null) Return the first ChildImage matching the query
 * @method     ChildImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildImage matching the query, or a new ChildImage object populated from the query conditions when no match is found
 *
 * @method     ChildImage findOneByIdimage(int $idImage) Return the first ChildImage filtered by the idImage column
 * @method     ChildImage findOneByTitle(string $Title) Return the first ChildImage filtered by the Title column
 * @method     ChildImage findOneByUrl(string $url) Return the first ChildImage filtered by the url column
 * @method     ChildImage findOneByPostIdpost(int $Post_idPost) Return the first ChildImage filtered by the Post_idPost column *

 * @method     ChildImage requirePk($key, ConnectionInterface $con = null) Return the ChildImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOne(ConnectionInterface $con = null) Return the first ChildImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImage requireOneByIdimage(int $idImage) Return the first ChildImage filtered by the idImage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOneByTitle(string $Title) Return the first ChildImage filtered by the Title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOneByUrl(string $url) Return the first ChildImage filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOneByPostIdpost(int $Post_idPost) Return the first ChildImage filtered by the Post_idPost column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildImage objects based on current ModelCriteria
 * @method     ChildImage[]|ObjectCollection findByIdimage(int $idImage) Return ChildImage objects filtered by the idImage column
 * @method     ChildImage[]|ObjectCollection findByTitle(string $Title) Return ChildImage objects filtered by the Title column
 * @method     ChildImage[]|ObjectCollection findByUrl(string $url) Return ChildImage objects filtered by the url column
 * @method     ChildImage[]|ObjectCollection findByPostIdpost(int $Post_idPost) Return ChildImage objects filtered by the Post_idPost column
 * @method     ChildImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ImageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Image', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildImageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildImageQuery) {
            return $criteria;
        }
        $query = new ChildImageQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$idImage, $Post_idPost] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ImageTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ImageTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idImage, Title, url, Post_idPost FROM Image WHERE idImage = :p0 AND Post_idPost = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildImage $obj */
            $obj = new ChildImage();
            $obj->hydrate($row);
            ImageTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildImage|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ImageTableMap::COL_IDIMAGE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ImageTableMap::COL_IDIMAGE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ImageTableMap::COL_POST_IDPOST, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idImage column
     *
     * Example usage:
     * <code>
     * $query->filterByIdimage(1234); // WHERE idImage = 1234
     * $query->filterByIdimage(array(12, 34)); // WHERE idImage IN (12, 34)
     * $query->filterByIdimage(array('min' => 12)); // WHERE idImage > 12
     * </code>
     *
     * @param     mixed $idimage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByIdimage($idimage = null, $comparison = null)
    {
        if (is_array($idimage)) {
            $useMinMax = false;
            if (isset($idimage['min'])) {
                $this->addUsingAlias(ImageTableMap::COL_IDIMAGE, $idimage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idimage['max'])) {
                $this->addUsingAlias(ImageTableMap::COL_IDIMAGE, $idimage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_IDIMAGE, $idimage, $comparison);
    }

    /**
     * Filter the query on the Title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE Title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE Title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the Post_idPost column
     *
     * Example usage:
     * <code>
     * $query->filterByPostIdpost(1234); // WHERE Post_idPost = 1234
     * $query->filterByPostIdpost(array(12, 34)); // WHERE Post_idPost IN (12, 34)
     * $query->filterByPostIdpost(array('min' => 12)); // WHERE Post_idPost > 12
     * </code>
     *
     * @see       filterByPost()
     *
     * @param     mixed $postIdpost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByPostIdpost($postIdpost = null, $comparison = null)
    {
        if (is_array($postIdpost)) {
            $useMinMax = false;
            if (isset($postIdpost['min'])) {
                $this->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $postIdpost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postIdpost['max'])) {
                $this->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $postIdpost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $postIdpost, $comparison);
    }

    /**
     * Filter the query by a related \Post object
     *
     * @param \Post|ObjectCollection $post The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildImageQuery The current query, for fluid interface
     */
    public function filterByPost($post, $comparison = null)
    {
        if ($post instanceof \Post) {
            return $this
                ->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $post->getIdpost(), $comparison);
        } elseif ($post instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ImageTableMap::COL_POST_IDPOST, $post->toKeyValue('Idpost', 'Idpost'), $comparison);
        } else {
            throw new PropelException('filterByPost() only accepts arguments of type \Post or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Post relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function joinPost($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Post');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Post');
        }

        return $this;
    }

    /**
     * Use the Post relation Post object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PostQuery A secondary query class using the current class as primary query
     */
    public function usePostQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPost($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Post', '\PostQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildImage $image Object to remove from the list of results
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function prune($image = null)
    {
        if ($image) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ImageTableMap::COL_IDIMAGE), $image->getIdimage(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ImageTableMap::COL_POST_IDPOST), $image->getPostIdpost(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ImageTableMap::clearInstancePool();
            ImageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ImageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ImageQuery
