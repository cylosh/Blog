<?php

namespace Base;

use \Comments as ChildComments;
use \CommentsQuery as ChildCommentsQuery;
use \Exception;
use \PDO;
use Map\CommentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;

/**
 * Base class that represents a query for the 'comments' table.
 *
 * 
 *
 * @method     ChildCommentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommentsQuery orderByArticleId($order = Criteria::ASC) Order by the article_id column
 * @method     ChildCommentsQuery orderByLft($order = Criteria::ASC) Order by the lft column
 * @method     ChildCommentsQuery orderByRgt($order = Criteria::ASC) Order by the rgt column
 * @method     ChildCommentsQuery orderByLvl($order = Criteria::ASC) Order by the lvl column
 * @method     ChildCommentsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildCommentsQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildCommentsQuery orderByFlag($order = Criteria::ASC) Order by the flag column
 * @method     ChildCommentsQuery orderByEdited($order = Criteria::ASC) Order by the edited column
 * @method     ChildCommentsQuery orderByPosted($order = Criteria::ASC) Order by the posted column
 *
 * @method     ChildCommentsQuery groupById() Group by the id column
 * @method     ChildCommentsQuery groupByArticleId() Group by the article_id column
 * @method     ChildCommentsQuery groupByLft() Group by the lft column
 * @method     ChildCommentsQuery groupByRgt() Group by the rgt column
 * @method     ChildCommentsQuery groupByLvl() Group by the lvl column
 * @method     ChildCommentsQuery groupByUserId() Group by the user_id column
 * @method     ChildCommentsQuery groupByContent() Group by the content column
 * @method     ChildCommentsQuery groupByFlag() Group by the flag column
 * @method     ChildCommentsQuery groupByEdited() Group by the edited column
 * @method     ChildCommentsQuery groupByPosted() Group by the posted column
 *
 * @method     ChildCommentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCommentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCommentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCommentsQuery leftJoinArticles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Articles relation
 * @method     ChildCommentsQuery rightJoinArticles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Articles relation
 * @method     ChildCommentsQuery innerJoinArticles($relationAlias = null) Adds a INNER JOIN clause to the query using the Articles relation
 *
 * @method     ChildCommentsQuery joinWithArticles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Articles relation
 *
 * @method     ChildCommentsQuery leftJoinWithArticles() Adds a LEFT JOIN clause and with to the query using the Articles relation
 * @method     ChildCommentsQuery rightJoinWithArticles() Adds a RIGHT JOIN clause and with to the query using the Articles relation
 * @method     ChildCommentsQuery innerJoinWithArticles() Adds a INNER JOIN clause and with to the query using the Articles relation
 *
 * @method     \ArticlesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildComments findOne(ConnectionInterface $con = null) Return the first ChildComments matching the query
 * @method     ChildComments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComments matching the query, or a new ChildComments object populated from the query conditions when no match is found
 *
 * @method     ChildComments findOneById(int $id) Return the first ChildComments filtered by the id column
 * @method     ChildComments findOneByArticleId(int $article_id) Return the first ChildComments filtered by the article_id column
 * @method     ChildComments findOneByLft(int $lft) Return the first ChildComments filtered by the lft column
 * @method     ChildComments findOneByRgt(int $rgt) Return the first ChildComments filtered by the rgt column
 * @method     ChildComments findOneByLvl(int $lvl) Return the first ChildComments filtered by the lvl column
 * @method     ChildComments findOneByUserId(int $user_id) Return the first ChildComments filtered by the user_id column
 * @method     ChildComments findOneByContent(string $content) Return the first ChildComments filtered by the content column
 * @method     ChildComments findOneByFlag(int $flag) Return the first ChildComments filtered by the flag column
 * @method     ChildComments findOneByEdited(string $edited) Return the first ChildComments filtered by the edited column
 * @method     ChildComments findOneByPosted(string $posted) Return the first ChildComments filtered by the posted column *

 * @method     ChildComments requirePk($key, ConnectionInterface $con = null) Return the ChildComments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOne(ConnectionInterface $con = null) Return the first ChildComments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComments requireOneById(int $id) Return the first ChildComments filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByArticleId(int $article_id) Return the first ChildComments filtered by the article_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByLft(int $lft) Return the first ChildComments filtered by the lft column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByRgt(int $rgt) Return the first ChildComments filtered by the rgt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByLvl(int $lvl) Return the first ChildComments filtered by the lvl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByUserId(int $user_id) Return the first ChildComments filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByContent(string $content) Return the first ChildComments filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByFlag(int $flag) Return the first ChildComments filtered by the flag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByEdited(string $edited) Return the first ChildComments filtered by the edited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComments requireOneByPosted(string $posted) Return the first ChildComments filtered by the posted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildComments objects based on current ModelCriteria
 * @method     ChildComments[]|ObjectCollection findById(int $id) Return ChildComments objects filtered by the id column
 * @method     ChildComments[]|ObjectCollection findByArticleId(int $article_id) Return ChildComments objects filtered by the article_id column
 * @method     ChildComments[]|ObjectCollection findByLft(int $lft) Return ChildComments objects filtered by the lft column
 * @method     ChildComments[]|ObjectCollection findByRgt(int $rgt) Return ChildComments objects filtered by the rgt column
 * @method     ChildComments[]|ObjectCollection findByLvl(int $lvl) Return ChildComments objects filtered by the lvl column
 * @method     ChildComments[]|ObjectCollection findByUserId(int $user_id) Return ChildComments objects filtered by the user_id column
 * @method     ChildComments[]|ObjectCollection findByContent(string $content) Return ChildComments objects filtered by the content column
 * @method     ChildComments[]|ObjectCollection findByFlag(int $flag) Return ChildComments objects filtered by the flag column
 * @method     ChildComments[]|ObjectCollection findByEdited(string $edited) Return ChildComments objects filtered by the edited column
 * @method     ChildComments[]|ObjectCollection findByPosted(string $posted) Return ChildComments objects filtered by the posted column
 * @method     ChildComments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CommentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CommentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Comments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCommentsQuery) {
            return $criteria;
        }
        $query = new ChildCommentsQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildComments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CommentsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildComments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, article_id, lft, rgt, lvl, user_id, content, flag, edited, posted FROM comments WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildComments $obj */
            $obj = new ChildComments();
            $obj->hydrate($row);
            CommentsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildComments|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the article_id column
     *
     * Example usage:
     * <code>
     * $query->filterByArticleId(1234); // WHERE article_id = 1234
     * $query->filterByArticleId(array(12, 34)); // WHERE article_id IN (12, 34)
     * $query->filterByArticleId(array('min' => 12)); // WHERE article_id > 12
     * </code>
     *
     * @see       filterByArticles()
     *
     * @param     mixed $articleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByArticleId($articleId = null, $comparison = null)
    {
        if (is_array($articleId)) {
            $useMinMax = false;
            if (isset($articleId['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ARTICLE_ID, $articleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($articleId['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_ARTICLE_ID, $articleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_ARTICLE_ID, $articleId, $comparison);
    }

    /**
     * Filter the query on the lft column
     *
     * Example usage:
     * <code>
     * $query->filterByLft(1234); // WHERE lft = 1234
     * $query->filterByLft(array(12, 34)); // WHERE lft IN (12, 34)
     * $query->filterByLft(array('min' => 12)); // WHERE lft > 12
     * </code>
     *
     * @param     mixed $lft The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByLft($lft = null, $comparison = null)
    {
        if (is_array($lft)) {
            $useMinMax = false;
            if (isset($lft['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_LFT, $lft['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lft['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_LFT, $lft['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_LFT, $lft, $comparison);
    }

    /**
     * Filter the query on the rgt column
     *
     * Example usage:
     * <code>
     * $query->filterByRgt(1234); // WHERE rgt = 1234
     * $query->filterByRgt(array(12, 34)); // WHERE rgt IN (12, 34)
     * $query->filterByRgt(array('min' => 12)); // WHERE rgt > 12
     * </code>
     *
     * @param     mixed $rgt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByRgt($rgt = null, $comparison = null)
    {
        if (is_array($rgt)) {
            $useMinMax = false;
            if (isset($rgt['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_RGT, $rgt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rgt['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_RGT, $rgt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_RGT, $rgt, $comparison);
    }

    /**
     * Filter the query on the lvl column
     *
     * Example usage:
     * <code>
     * $query->filterByLvl(1234); // WHERE lvl = 1234
     * $query->filterByLvl(array(12, 34)); // WHERE lvl IN (12, 34)
     * $query->filterByLvl(array('min' => 12)); // WHERE lvl > 12
     * </code>
     *
     * @param     mixed $lvl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByLvl($lvl = null, $comparison = null)
    {
        if (is_array($lvl)) {
            $useMinMax = false;
            if (isset($lvl['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_LVL, $lvl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lvl['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_LVL, $lvl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_LVL, $lvl, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%', Criteria::LIKE); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the flag column
     *
     * Example usage:
     * <code>
     * $query->filterByFlag(1234); // WHERE flag = 1234
     * $query->filterByFlag(array(12, 34)); // WHERE flag IN (12, 34)
     * $query->filterByFlag(array('min' => 12)); // WHERE flag > 12
     * </code>
     *
     * @param     mixed $flag The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByFlag($flag = null, $comparison = null)
    {
        if (is_array($flag)) {
            $useMinMax = false;
            if (isset($flag['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_FLAG, $flag['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($flag['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_FLAG, $flag['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_FLAG, $flag, $comparison);
    }

    /**
     * Filter the query on the edited column
     *
     * Example usage:
     * <code>
     * $query->filterByEdited('2011-03-14'); // WHERE edited = '2011-03-14'
     * $query->filterByEdited('now'); // WHERE edited = '2011-03-14'
     * $query->filterByEdited(array('max' => 'yesterday')); // WHERE edited > '2011-03-13'
     * </code>
     *
     * @param     mixed $edited The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByEdited($edited = null, $comparison = null)
    {
        if (is_array($edited)) {
            $useMinMax = false;
            if (isset($edited['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_EDITED, $edited['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edited['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_EDITED, $edited['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_EDITED, $edited, $comparison);
    }

    /**
     * Filter the query on the posted column
     *
     * Example usage:
     * <code>
     * $query->filterByPosted('2011-03-14'); // WHERE posted = '2011-03-14'
     * $query->filterByPosted('now'); // WHERE posted = '2011-03-14'
     * $query->filterByPosted(array('max' => 'yesterday')); // WHERE posted > '2011-03-13'
     * </code>
     *
     * @param     mixed $posted The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByPosted($posted = null, $comparison = null)
    {
        if (is_array($posted)) {
            $useMinMax = false;
            if (isset($posted['min'])) {
                $this->addUsingAlias(CommentsTableMap::COL_POSTED, $posted['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($posted['max'])) {
                $this->addUsingAlias(CommentsTableMap::COL_POSTED, $posted['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentsTableMap::COL_POSTED, $posted, $comparison);
    }

    /**
     * Filter the query by a related \Articles object
     *
     * @param \Articles|ObjectCollection $articles The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCommentsQuery The current query, for fluid interface
     */
    public function filterByArticles($articles, $comparison = null)
    {
        if ($articles instanceof \Articles) {
            return $this
                ->addUsingAlias(CommentsTableMap::COL_ARTICLE_ID, $articles->getId(), $comparison);
        } elseif ($articles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommentsTableMap::COL_ARTICLE_ID, $articles->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByArticles() only accepts arguments of type \Articles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Articles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function joinArticles($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Articles');

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
            $this->addJoinObject($join, 'Articles');
        }

        return $this;
    }

    /**
     * Use the Articles relation Articles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArticlesQuery A secondary query class using the current class as primary query
     */
    public function useArticlesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinArticles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Articles', '\ArticlesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildComments $comments Object to remove from the list of results
     *
     * @return $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function prune($comments = null)
    {
        if ($comments) {
            $this->addUsingAlias(CommentsTableMap::COL_ID, $comments->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the comments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommentsTableMap::clearInstancePool();
            CommentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            CommentsTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            CommentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CommentsTableMap::COL_EDITED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CommentsTableMap::COL_EDITED);
    }
    
    /**
     * Order by update date asc
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CommentsTableMap::COL_EDITED);
    }
    
    /**
     * Order by create date desc
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CommentsTableMap::COL_POSTED);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CommentsTableMap::COL_POSTED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date asc
     *
     * @return     $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CommentsTableMap::COL_POSTED);
    }

    // nested_set behavior
    
    /**
     * Filter the query to restrict the result to root objects
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function treeRoots()
    {
        return $this->addUsingAlias(ChildComments::LEFT_COL, 1, Criteria::EQUAL);
    }
    
    /**
     * Returns the objects in a certain tree, from the tree scope
     *
     * @param     int $scope        Scope to determine which objects node to return
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function inTree($scope = null)
    {
        return $this->addUsingAlias(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    }
    
    /**
     * Filter the query to restrict the result to descendants of an object
     *
     * @param     ChildComments $comments The object to use for descendant search
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function descendantsOf(ChildComments $comments)
    {
        return $this
            ->inTree($comments->getScopeValue())
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getLeftValue(), Criteria::GREATER_THAN)
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getRightValue(), Criteria::LESS_THAN);
    }
    
    /**
     * Filter the query to restrict the result to the branch of an object.
     * Same as descendantsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     ChildComments $comments The object to use for branch search
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function branchOf(ChildComments $comments)
    {
        return $this
            ->inTree($comments->getScopeValue())
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getLeftValue(), Criteria::GREATER_EQUAL)
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getRightValue(), Criteria::LESS_EQUAL);
    }
    
    /**
     * Filter the query to restrict the result to children of an object
     *
     * @param     ChildComments $comments The object to use for child search
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function childrenOf(ChildComments $comments)
    {
        return $this
            ->descendantsOf($comments)
            ->addUsingAlias(ChildComments::LEVEL_COL, $comments->getLevel() + 1, Criteria::EQUAL);
    }
    
    /**
     * Filter the query to restrict the result to siblings of an object.
     * The result does not include the object passed as parameter.
     *
     * @param     ChildComments $comments The object to use for sibling search
     * @param      ConnectionInterface $con Connection to use.
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function siblingsOf(ChildComments $comments, ConnectionInterface $con = null)
    {
        if ($comments->isRoot()) {
            return $this->
                add(ChildComments::LEVEL_COL, '1<>1', Criteria::CUSTOM);
        } else {
            return $this
                ->childrenOf($comments->getParent($con))
                ->prune($comments);
        }
    }
    
    /**
     * Filter the query to restrict the result to ancestors of an object
     *
     * @param     ChildComments $comments The object to use for ancestors search
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function ancestorsOf(ChildComments $comments)
    {
        return $this
            ->inTree($comments->getScopeValue())
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getLeftValue(), Criteria::LESS_THAN)
            ->addUsingAlias(ChildComments::RIGHT_COL, $comments->getRightValue(), Criteria::GREATER_THAN);
    }
    
    /**
     * Filter the query to restrict the result to roots of an object.
     * Same as ancestorsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     ChildComments $comments The object to use for roots search
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function rootsOf(ChildComments $comments)
    {
        return $this
            ->inTree($comments->getScopeValue())
            ->addUsingAlias(ChildComments::LEFT_COL, $comments->getLeftValue(), Criteria::LESS_EQUAL)
            ->addUsingAlias(ChildComments::RIGHT_COL, $comments->getRightValue(), Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order the result by branch, i.e. natural tree order
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function orderByBranch($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addDescendingOrderByColumn(ChildComments::LEFT_COL);
        } else {
            return $this
                ->addAscendingOrderByColumn(ChildComments::LEFT_COL);
        }
    }
    
    /**
     * Order the result by level, the closer to the root first
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    $this|ChildCommentsQuery The current query, for fluid interface
     */
    public function orderByLevel($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addDescendingOrderByColumn(ChildComments::LEVEL_COL)
                ->addDescendingOrderByColumn(ChildComments::LEFT_COL);
        } else {
            return $this
                ->addAscendingOrderByColumn(ChildComments::LEVEL_COL)
                ->addAscendingOrderByColumn(ChildComments::LEFT_COL);
        }
    }
    
    /**
     * Returns a root node for the tree
     *
     * @param      int $scope        Scope to determine which root node to return
     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return     ChildComments The tree root object
     */
    public function findRoot($scope = null, ConnectionInterface $con = null)
    {
        return $this
            ->addUsingAlias(ChildComments::LEFT_COL, 1, Criteria::EQUAL)
            ->inTree($scope)
            ->findOne($con);
    }
    
    /**
     * Returns the root objects for all trees.
     *
     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return    ChildComments[]|ObjectCollection|mixed the list of results, formatted by the current formatter
     */
    public function findRoots(ConnectionInterface $con = null)
    {
        return $this
            ->treeRoots()
            ->find($con);
    }
    
    /**
     * Returns a tree of objects
     *
     * @param      int $scope        Scope to determine which tree node to return
     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return     ChildComments[]|ObjectCollection|mixed the list of results, formatted by the current formatter
     */
    public function findTree($scope = null, ConnectionInterface $con = null)
    {
        return $this
            ->inTree($scope)
            ->orderByBranch()
            ->find($con);
    }
    
    /**
     * Returns the root nodes for the tree
     *
     * @param      Criteria $criteria    Optional Criteria to filter the query
     * @param      ConnectionInterface $con    Connection to use.
     * @return     ChildComments[]|ObjectCollection|mixed the list of results, formatted by the current formatter
     */
    static public function retrieveRoots(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        if (null === $criteria) {
            $criteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        }
        $criteria->add(ChildComments::LEFT_COL, 1, Criteria::EQUAL);
    
        return ChildCommentsQuery::create(null, $criteria)->find($con);
    }
    
    /**
     * Returns the root node for a given scope
     *
     * @param      int $scope        Scope to determine which root node to return
     * @param      ConnectionInterface $con    Connection to use.
     * @return     ChildComments            Propel object for root node
     */
    static public function retrieveRoot($scope = null, ConnectionInterface $con = null)
    {
        $c = new Criteria(CommentsTableMap::DATABASE_NAME);
        $c->add(ChildComments::LEFT_COL, 1, Criteria::EQUAL);
        $c->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        return ChildCommentsQuery::create(null, $c)->findOne($con);
    }
    
    /**
     * Returns the whole tree node for a given scope
     *
     * @param      int $scope        Scope to determine which root node to return
     * @param      Criteria $criteria    Optional Criteria to filter the query
     * @param      ConnectionInterface $con    Connection to use.
     * @return     ChildComments[]|ObjectCollection|mixed the list of results, formatted by the current formatter
     */
    static public function retrieveTree($scope = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        if (null === $criteria) {
            $criteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        }
        $criteria->addAscendingOrderByColumn(ChildComments::LEFT_COL);
        $criteria->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        return ChildCommentsQuery::create(null, $criteria)->find($con);
    }
    
    /**
     * Tests if node is valid
     *
     * @param      ChildComments $node    Propel object for src node
     * @return     bool
     */
    static public function isValid(ChildComments $node = null)
    {
        if (is_object($node) && $node->getRightValue() > $node->getLeftValue()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Delete an entire tree
     * 
     * @param      int $scope        Scope to determine which tree to delete
     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return     int  The number of deleted nodes
     */
    static public function deleteTree($scope = null, ConnectionInterface $con = null)
    {
        $c = new Criteria(CommentsTableMap::DATABASE_NAME);
        $c->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        return CommentsTableMap::doDelete($c, $con);
    }
    
    /**
     * Adds $delta to all L and R values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param int $delta               Value to be shifted by, can be negative
     * @param int $first               First node to be shifted
     * @param int $last                Last node to be shifted (optional)
     * @param int $scope               Scope to use for the shift
     * @param ConnectionInterface $con Connection to use.
     */
    static public function shiftRLValues($delta, $first, $last = null, $scope = null, ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }
    
        // Shift left column values
        $whereCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(ChildComments::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(ChildComments::LEFT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
        $whereCriteria->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        $valuesCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $valuesCriteria->add(ChildComments::LEFT_COL, array('raw' => ChildComments::LEFT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);
    
        $whereCriteria->doUpdate($valuesCriteria, $con);
    
        // Shift right column values
        $whereCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(ChildComments::RIGHT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(ChildComments::RIGHT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
        $whereCriteria->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        $valuesCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $valuesCriteria->add(ChildComments::RIGHT_COL, array('raw' => ChildComments::RIGHT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);
    
        $whereCriteria->doUpdate($valuesCriteria, $con);
    }
    
    /**
     * Adds $delta to level for nodes having left value >= $first and right value <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta        Value to be shifted by, can be negative
     * @param      int $first        First node to be shifted
     * @param      int $last            Last node to be shifted
     * @param      int $scope        Scope to use for the shift
     * @param      ConnectionInterface $con        Connection to use.
     */
    static public function shiftLevel($delta, $first, $last, $scope = null, ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentsTableMap::DATABASE_NAME);
        }
    
        $whereCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $whereCriteria->add(ChildComments::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        $whereCriteria->add(ChildComments::RIGHT_COL, $last, Criteria::LESS_EQUAL);
        $whereCriteria->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        $valuesCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $valuesCriteria->add(ChildComments::LEVEL_COL, array('raw' => ChildComments::LEVEL_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);
    
        $whereCriteria->doUpdate($valuesCriteria, $con);
    }
    
    /**
     * Reload all already loaded nodes to sync them with updated db
     *
     * @param      ChildComments $prune        Object to prune from the update
     * @param      ConnectionInterface $con        Connection to use.
     */
    static public function updateLoadedNodes($prune = null, ConnectionInterface $con = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            $keys = array();
            /** @var $obj ChildComments */
            foreach (CommentsTableMap::$instances as $obj) {
                if (!$prune || !$prune->equals($obj)) {
                    $keys[] = $obj->getPrimaryKey();
                }
            }
    
            if (!empty($keys)) {
                // We don't need to alter the object instance pool; we're just modifying these ones
                // already in the pool.
                $criteria = new Criteria(CommentsTableMap::DATABASE_NAME);
                $criteria->add(CommentsTableMap::COL_ID, $keys, Criteria::IN);
                $dataFetcher = ChildCommentsQuery::create(null, $criteria)->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
                while ($row = $dataFetcher->fetch()) {
                    $key = CommentsTableMap::getPrimaryKeyHashFromRow($row, 0);
                    /** @var $object ChildComments */
                    if (null !== ($object = CommentsTableMap::getInstanceFromPool($key))) {
                        $object->setScopeValue($row[1]);
                        $object->setLeftValue($row[2]);
                        $object->setRightValue($row[3]);
                        $object->setLevel($row[4]);
                        $object->clearNestedSetChildren();
                    }
                }
                $dataFetcher->close();
            }
        }
    }
    
    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      int $left    left column value
     * @param      integer $scope    scope column value
     * @param      mixed $prune    Object to prune from the shift
     * @param      ConnectionInterface $con    Connection to use.
     */
    static public function makeRoomForLeaf($left, $scope, $prune = null, ConnectionInterface $con = null)
    {
        // Update database nodes
        ChildCommentsQuery::shiftRLValues(2, $left, null, $scope, $con);
    
        // Update all loaded nodes
        ChildCommentsQuery::updateLoadedNodes($prune, $con);
    }
    
    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      integer $scope    scope column value
     * @param      ConnectionInterface $con    Connection to use.
     */
    static public function fixLevels($scope, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        $c->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
        $c->addAscendingOrderByColumn(ChildComments::LEFT_COL);
        $dataFetcher = ChildCommentsQuery::create(null, $c)->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        
        // set the class once to avoid overhead in the loop
        $cls = CommentsTableMap::getOMClass(false);
        $level = null;
        // iterate over the statement
        while ($row = $dataFetcher->fetch()) {
    
            // hydrate object
            $key = CommentsTableMap::getPrimaryKeyHashFromRow($row, 0);
            /** @var $obj ChildComments */
            if (null === ($obj = CommentsTableMap::getInstanceFromPool($key))) {
                $obj = new $cls();
                $obj->hydrate($row);
                CommentsTableMap::addInstanceToPool($obj, $key);
            }
    
            // compute level
            // Algorithm shamelessly stolen from sfPropelActAsNestedSetBehaviorPlugin
            // Probably authored by Tristan Rivoallan
            if ($level === null) {
                $level = 0;
                $i = 0;
                $prev = array($obj->getRightValue());
            } else {
                while ($obj->getRightValue() > $prev[$i]) {
                    $i--;
                }
                $level = ++$i;
                $prev[$i] = $obj->getRightValue();
            }
    
            // update level in node if necessary
            if ($obj->getLevel() !== $level) {
                $obj->setLevel($level);
                $obj->save($con);
            }
        }
        $dataFetcher->close();
    }
    
    /**
     * Updates all scope values for items that has negative left (<=0) values.
     *
     * @param      mixed     $scope
     * @param      ConnectionInterface $con  Connection to use.
     */
    public static function setNegativeScope($scope, ConnectionInterface $con = null)
    {
        //adjust scope value to $scope
        $whereCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $whereCriteria->add(ChildComments::LEFT_COL, 0, Criteria::LESS_EQUAL);
    
        $valuesCriteria = new Criteria(CommentsTableMap::DATABASE_NAME);
        $valuesCriteria->add(ChildComments::SCOPE_COL, $scope, Criteria::EQUAL);
    
        $whereCriteria->doUpdate($valuesCriteria, $con);
    }

} // CommentsQuery
