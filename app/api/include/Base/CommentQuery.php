<?php

namespace Base;

use \Comment as ChildComment;
use \CommentQuery as ChildCommentQuery;
use \Exception;
use \PDO;
use Map\CommentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Comment' table.
 *
 *
 *
 * @method     ChildCommentQuery orderByIdcomment($order = Criteria::ASC) Order by the idComment column
 * @method     ChildCommentQuery orderByText($order = Criteria::ASC) Order by the Text column
 * @method     ChildCommentQuery orderByDatetime($order = Criteria::ASC) Order by the DateTime column
 * @method     ChildCommentQuery orderByUserIduser($order = Criteria::ASC) Order by the User_idUser column
 * @method     ChildCommentQuery orderByPostIdpost($order = Criteria::ASC) Order by the Post_idPost column
 *
 * @method     ChildCommentQuery groupByIdcomment() Group by the idComment column
 * @method     ChildCommentQuery groupByText() Group by the Text column
 * @method     ChildCommentQuery groupByDatetime() Group by the DateTime column
 * @method     ChildCommentQuery groupByUserIduser() Group by the User_idUser column
 * @method     ChildCommentQuery groupByPostIdpost() Group by the Post_idPost column
 *
 * @method     ChildCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommentQuery leftJoinPost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Post relation
 * @method     ChildCommentQuery rightJoinPost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Post relation
 * @method     ChildCommentQuery innerJoinPost($relationAlias = null) Adds a INNER JOIN clause to the query using the Post relation
 *
 * @method     ChildCommentQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildCommentQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildCommentQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     \PostQuery|\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildComment findOne(ConnectionInterface $con = null) Return the first ChildComment matching the query
 * @method     ChildComment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComment matching the query, or a new ChildComment object populated from the query conditions when no match is found
 *
 * @method     ChildComment findOneByIdcomment(int $idComment) Return the first ChildComment filtered by the idComment column
 * @method     ChildComment findOneByText(string $Text) Return the first ChildComment filtered by the Text column
 * @method     ChildComment findOneByDatetime(string $DateTime) Return the first ChildComment filtered by the DateTime column
 * @method     ChildComment findOneByUserIduser(int $User_idUser) Return the first ChildComment filtered by the User_idUser column
 * @method     ChildComment findOneByPostIdpost(int $Post_idPost) Return the first ChildComment filtered by the Post_idPost column *

 * @method     ChildComment requirePk($key, ConnectionInterface $con = null) Return the ChildComment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComment requireOne(ConnectionInterface $con = null) Return the first ChildComment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComment requireOneByIdcomment(int $idComment) Return the first ChildComment filtered by the idComment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComment requireOneByText(string $Text) Return the first ChildComment filtered by the Text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComment requireOneByDatetime(string $DateTime) Return the first ChildComment filtered by the DateTime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComment requireOneByUserIduser(int $User_idUser) Return the first ChildComment filtered by the User_idUser column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComment requireOneByPostIdpost(int $Post_idPost) Return the first ChildComment filtered by the Post_idPost column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildComment objects based on current ModelCriteria
 * @method     ChildComment[]|ObjectCollection findByIdcomment(int $idComment) Return ChildComment objects filtered by the idComment column
 * @method     ChildComment[]|ObjectCollection findByText(string $Text) Return ChildComment objects filtered by the Text column
 * @method     ChildComment[]|ObjectCollection findByDatetime(string $DateTime) Return ChildComment objects filtered by the DateTime column
 * @method     ChildComment[]|ObjectCollection findByUserIduser(int $User_idUser) Return ChildComment objects filtered by the User_idUser column
 * @method     ChildComment[]|ObjectCollection findByPostIdpost(int $Post_idPost) Return ChildComment objects filtered by the Post_idPost column
 * @method     ChildComment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Comment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommentQuery) {
            return $criteria;
        }
        $query = new ChildCommentQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$idComment, $User_idUser, $Post_idPost] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildComment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommentTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
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
     * @return ChildComment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idComment, Text, DateTime, User_idUser, Post_idPost FROM Comment WHERE idComment = :p0 AND User_idUser = :p1 AND Post_idPost = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildComment $obj */
            $obj = new ChildComment();
            $obj->hydrate($row);
            CommentTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return ChildComment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CommentTableMap::COL_IDCOMMENT, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CommentTableMap::COL_IDCOMMENT, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CommentTableMap::COL_USER_IDUSER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(CommentTableMap::COL_POST_IDPOST, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idComment column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcomment(1234); // WHERE idComment = 1234
     * $query->filterByIdcomment(array(12, 34)); // WHERE idComment IN (12, 34)
     * $query->filterByIdcomment(array('min' => 12)); // WHERE idComment > 12
     * </code>
     *
     * @param     mixed $idcomment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByIdcomment($idcomment = null, $comparison = null)
    {
        if (is_array($idcomment)) {
            $useMinMax = false;
            if (isset($idcomment['min'])) {
                $this->addUsingAlias(CommentTableMap::COL_IDCOMMENT, $idcomment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcomment['max'])) {
                $this->addUsingAlias(CommentTableMap::COL_IDCOMMENT, $idcomment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::COL_IDCOMMENT, $idcomment, $comparison);
    }

    /**
     * Filter the query on the Text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE Text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE Text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the DateTime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('2011-03-14'); // WHERE DateTime = '2011-03-14'
     * $query->filterByDatetime('now'); // WHERE DateTime = '2011-03-14'
     * $query->filterByDatetime(array('max' => 'yesterday')); // WHERE DateTime > '2011-03-13'
     * </code>
     *
     * @param     mixed $datetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(CommentTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(CommentTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::COL_DATETIME, $datetime, $comparison);
    }

    /**
     * Filter the query on the User_idUser column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIduser(1234); // WHERE User_idUser = 1234
     * $query->filterByUserIduser(array(12, 34)); // WHERE User_idUser IN (12, 34)
     * $query->filterByUserIduser(array('min' => 12)); // WHERE User_idUser > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userIduser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByUserIduser($userIduser = null, $comparison = null)
    {
        if (is_array($userIduser)) {
            $useMinMax = false;
            if (isset($userIduser['min'])) {
                $this->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $userIduser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIduser['max'])) {
                $this->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $userIduser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $userIduser, $comparison);
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
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPostIdpost($postIdpost = null, $comparison = null)
    {
        if (is_array($postIdpost)) {
            $useMinMax = false;
            if (isset($postIdpost['min'])) {
                $this->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $postIdpost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postIdpost['max'])) {
                $this->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $postIdpost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $postIdpost, $comparison);
    }

    /**
     * Filter the query by a related \Post object
     *
     * @param \Post|ObjectCollection $post The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPost($post, $comparison = null)
    {
        if ($post instanceof \Post) {
            return $this
                ->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $post->getIdpost(), $comparison);
        } elseif ($post instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommentTableMap::COL_POST_IDPOST, $post->toKeyValue('Idpost', 'Idpost'), $comparison);
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
     * @return $this|ChildCommentQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $user->getIduser(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommentTableMap::COL_USER_IDUSER, $user->toKeyValue('PrimaryKey', 'Iduser'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildComment $comment Object to remove from the list of results
     *
     * @return $this|ChildCommentQuery The current query, for fluid interface
     */
    public function prune($comment = null)
    {
        if ($comment) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CommentTableMap::COL_IDCOMMENT), $comment->getIdcomment(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CommentTableMap::COL_USER_IDUSER), $comment->getUserIduser(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(CommentTableMap::COL_POST_IDPOST), $comment->getPostIdpost(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommentTableMap::clearInstancePool();
            CommentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CommentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CommentQuery
