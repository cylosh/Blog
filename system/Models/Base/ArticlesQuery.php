<?php

namespace Base;

use \Articles as ChildArticles;
use \ArticlesQuery as ChildArticlesQuery;
use \Exception;
use \PDO;
use Map\ArticlesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'articles' table.
 *
 * 
 *
 * @method     ChildArticlesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildArticlesQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildArticlesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildArticlesQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildArticlesQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildArticlesQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildArticlesQuery orderByLikes($order = Criteria::ASC) Order by the likes column
 * @method     ChildArticlesQuery orderByImgPath($order = Criteria::ASC) Order by the img_path column
 * @method     ChildArticlesQuery orderByImgFrame($order = Criteria::ASC) Order by the img_frame column
 * @method     ChildArticlesQuery orderByCommentsAllowed($order = Criteria::ASC) Order by the comments_allowed column
 * @method     ChildArticlesQuery orderByModified($order = Criteria::ASC) Order by the modified column
 * @method     ChildArticlesQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     ChildArticlesQuery groupById() Group by the id column
 * @method     ChildArticlesQuery groupByUserId() Group by the user_id column
 * @method     ChildArticlesQuery groupByTitle() Group by the title column
 * @method     ChildArticlesQuery groupByUrl() Group by the url column
 * @method     ChildArticlesQuery groupByContent() Group by the content column
 * @method     ChildArticlesQuery groupByTags() Group by the tags column
 * @method     ChildArticlesQuery groupByLikes() Group by the likes column
 * @method     ChildArticlesQuery groupByImgPath() Group by the img_path column
 * @method     ChildArticlesQuery groupByImgFrame() Group by the img_frame column
 * @method     ChildArticlesQuery groupByCommentsAllowed() Group by the comments_allowed column
 * @method     ChildArticlesQuery groupByModified() Group by the modified column
 * @method     ChildArticlesQuery groupByCreated() Group by the created column
 *
 * @method     ChildArticlesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArticlesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArticlesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArticlesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArticlesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArticlesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArticlesQuery leftJoinAccounts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Accounts relation
 * @method     ChildArticlesQuery rightJoinAccounts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Accounts relation
 * @method     ChildArticlesQuery innerJoinAccounts($relationAlias = null) Adds a INNER JOIN clause to the query using the Accounts relation
 *
 * @method     ChildArticlesQuery joinWithAccounts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Accounts relation
 *
 * @method     ChildArticlesQuery leftJoinWithAccounts() Adds a LEFT JOIN clause and with to the query using the Accounts relation
 * @method     ChildArticlesQuery rightJoinWithAccounts() Adds a RIGHT JOIN clause and with to the query using the Accounts relation
 * @method     ChildArticlesQuery innerJoinWithAccounts() Adds a INNER JOIN clause and with to the query using the Accounts relation
 *
 * @method     ChildArticlesQuery leftJoinComments($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comments relation
 * @method     ChildArticlesQuery rightJoinComments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comments relation
 * @method     ChildArticlesQuery innerJoinComments($relationAlias = null) Adds a INNER JOIN clause to the query using the Comments relation
 *
 * @method     ChildArticlesQuery joinWithComments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Comments relation
 *
 * @method     ChildArticlesQuery leftJoinWithComments() Adds a LEFT JOIN clause and with to the query using the Comments relation
 * @method     ChildArticlesQuery rightJoinWithComments() Adds a RIGHT JOIN clause and with to the query using the Comments relation
 * @method     ChildArticlesQuery innerJoinWithComments() Adds a INNER JOIN clause and with to the query using the Comments relation
 *
 * @method     \AccountsQuery|\CommentsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArticles findOne(ConnectionInterface $con = null) Return the first ChildArticles matching the query
 * @method     ChildArticles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArticles matching the query, or a new ChildArticles object populated from the query conditions when no match is found
 *
 * @method     ChildArticles findOneById(int $id) Return the first ChildArticles filtered by the id column
 * @method     ChildArticles findOneByUserId(int $user_id) Return the first ChildArticles filtered by the user_id column
 * @method     ChildArticles findOneByTitle(string $title) Return the first ChildArticles filtered by the title column
 * @method     ChildArticles findOneByUrl(string $url) Return the first ChildArticles filtered by the url column
 * @method     ChildArticles findOneByContent(string $content) Return the first ChildArticles filtered by the content column
 * @method     ChildArticles findOneByTags(string $tags) Return the first ChildArticles filtered by the tags column
 * @method     ChildArticles findOneByLikes(int $likes) Return the first ChildArticles filtered by the likes column
 * @method     ChildArticles findOneByImgPath(string $img_path) Return the first ChildArticles filtered by the img_path column
 * @method     ChildArticles findOneByImgFrame(string $img_frame) Return the first ChildArticles filtered by the img_frame column
 * @method     ChildArticles findOneByCommentsAllowed(boolean $comments_allowed) Return the first ChildArticles filtered by the comments_allowed column
 * @method     ChildArticles findOneByModified(string $modified) Return the first ChildArticles filtered by the modified column
 * @method     ChildArticles findOneByCreated(string $created) Return the first ChildArticles filtered by the created column *

 * @method     ChildArticles requirePk($key, ConnectionInterface $con = null) Return the ChildArticles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOne(ConnectionInterface $con = null) Return the first ChildArticles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticles requireOneById(int $id) Return the first ChildArticles filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByUserId(int $user_id) Return the first ChildArticles filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByTitle(string $title) Return the first ChildArticles filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByUrl(string $url) Return the first ChildArticles filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByContent(string $content) Return the first ChildArticles filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByTags(string $tags) Return the first ChildArticles filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByLikes(int $likes) Return the first ChildArticles filtered by the likes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByImgPath(string $img_path) Return the first ChildArticles filtered by the img_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByImgFrame(string $img_frame) Return the first ChildArticles filtered by the img_frame column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByCommentsAllowed(boolean $comments_allowed) Return the first ChildArticles filtered by the comments_allowed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByModified(string $modified) Return the first ChildArticles filtered by the modified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticles requireOneByCreated(string $created) Return the first ChildArticles filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArticles objects based on current ModelCriteria
 * @method     ChildArticles[]|ObjectCollection findById(int $id) Return ChildArticles objects filtered by the id column
 * @method     ChildArticles[]|ObjectCollection findByUserId(int $user_id) Return ChildArticles objects filtered by the user_id column
 * @method     ChildArticles[]|ObjectCollection findByTitle(string $title) Return ChildArticles objects filtered by the title column
 * @method     ChildArticles[]|ObjectCollection findByUrl(string $url) Return ChildArticles objects filtered by the url column
 * @method     ChildArticles[]|ObjectCollection findByContent(string $content) Return ChildArticles objects filtered by the content column
 * @method     ChildArticles[]|ObjectCollection findByTags(string $tags) Return ChildArticles objects filtered by the tags column
 * @method     ChildArticles[]|ObjectCollection findByLikes(int $likes) Return ChildArticles objects filtered by the likes column
 * @method     ChildArticles[]|ObjectCollection findByImgPath(string $img_path) Return ChildArticles objects filtered by the img_path column
 * @method     ChildArticles[]|ObjectCollection findByImgFrame(string $img_frame) Return ChildArticles objects filtered by the img_frame column
 * @method     ChildArticles[]|ObjectCollection findByCommentsAllowed(boolean $comments_allowed) Return ChildArticles objects filtered by the comments_allowed column
 * @method     ChildArticles[]|ObjectCollection findByModified(string $modified) Return ChildArticles objects filtered by the modified column
 * @method     ChildArticles[]|ObjectCollection findByCreated(string $created) Return ChildArticles objects filtered by the created column
 * @method     ChildArticles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArticlesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ArticlesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Articles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArticlesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArticlesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArticlesQuery) {
            return $criteria;
        }
        $query = new ChildArticlesQuery();
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
     * @return ChildArticles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticlesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ArticlesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildArticles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, title, url, content, tags, likes, img_path, img_frame, comments_allowed, modified, created FROM articles WHERE id = :p0';
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
            /** @var ChildArticles $obj */
            $obj = new ChildArticles();
            $obj->hydrate($row);
            ArticlesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildArticles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArticlesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArticlesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByAccounts()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_URL, $url, $comparison);
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
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%', Criteria::LIKE); // WHERE tags LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tags The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByTags($tags = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_TAGS, $tags, $comparison);
    }

    /**
     * Filter the query on the likes column
     *
     * Example usage:
     * <code>
     * $query->filterByLikes(1234); // WHERE likes = 1234
     * $query->filterByLikes(array(12, 34)); // WHERE likes IN (12, 34)
     * $query->filterByLikes(array('min' => 12)); // WHERE likes > 12
     * </code>
     *
     * @param     mixed $likes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByLikes($likes = null, $comparison = null)
    {
        if (is_array($likes)) {
            $useMinMax = false;
            if (isset($likes['min'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_LIKES, $likes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($likes['max'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_LIKES, $likes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_LIKES, $likes, $comparison);
    }

    /**
     * Filter the query on the img_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImgPath('fooValue');   // WHERE img_path = 'fooValue'
     * $query->filterByImgPath('%fooValue%', Criteria::LIKE); // WHERE img_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgPath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByImgPath($imgPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgPath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_IMG_PATH, $imgPath, $comparison);
    }

    /**
     * Filter the query on the img_frame column
     *
     * Example usage:
     * <code>
     * $query->filterByImgFrame('fooValue');   // WHERE img_frame = 'fooValue'
     * $query->filterByImgFrame('%fooValue%', Criteria::LIKE); // WHERE img_frame LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgFrame The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByImgFrame($imgFrame = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgFrame)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_IMG_FRAME, $imgFrame, $comparison);
    }

    /**
     * Filter the query on the comments_allowed column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentsAllowed(true); // WHERE comments_allowed = true
     * $query->filterByCommentsAllowed('yes'); // WHERE comments_allowed = true
     * </code>
     *
     * @param     boolean|string $commentsAllowed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByCommentsAllowed($commentsAllowed = null, $comparison = null)
    {
        if (is_string($commentsAllowed)) {
            $commentsAllowed = in_array(strtolower($commentsAllowed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_COMMENTS_ALLOWED, $commentsAllowed, $comparison);
    }

    /**
     * Filter the query on the modified column
     *
     * Example usage:
     * <code>
     * $query->filterByModified('2011-03-14'); // WHERE modified = '2011-03-14'
     * $query->filterByModified('now'); // WHERE modified = '2011-03-14'
     * $query->filterByModified(array('max' => 'yesterday')); // WHERE modified > '2011-03-13'
     * </code>
     *
     * @param     mixed $modified The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByModified($modified = null, $comparison = null)
    {
        if (is_array($modified)) {
            $useMinMax = false;
            if (isset($modified['min'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_MODIFIED, $modified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modified['max'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_MODIFIED, $modified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_MODIFIED, $modified, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(ArticlesTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlesTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related \Accounts object
     *
     * @param \Accounts|ObjectCollection $accounts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByAccounts($accounts, $comparison = null)
    {
        if ($accounts instanceof \Accounts) {
            return $this
                ->addUsingAlias(ArticlesTableMap::COL_USER_ID, $accounts->getId(), $comparison);
        } elseif ($accounts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticlesTableMap::COL_USER_ID, $accounts->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAccounts() only accepts arguments of type \Accounts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Accounts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function joinAccounts($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Accounts');

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
            $this->addJoinObject($join, 'Accounts');
        }

        return $this;
    }

    /**
     * Use the Accounts relation Accounts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AccountsQuery A secondary query class using the current class as primary query
     */
    public function useAccountsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAccounts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Accounts', '\AccountsQuery');
    }

    /**
     * Filter the query by a related \Comments object
     *
     * @param \Comments|ObjectCollection $comments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArticlesQuery The current query, for fluid interface
     */
    public function filterByComments($comments, $comparison = null)
    {
        if ($comments instanceof \Comments) {
            return $this
                ->addUsingAlias(ArticlesTableMap::COL_ID, $comments->getArticleId(), $comparison);
        } elseif ($comments instanceof ObjectCollection) {
            return $this
                ->useCommentsQuery()
                ->filterByPrimaryKeys($comments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComments() only accepts arguments of type \Comments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function joinComments($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comments');

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
            $this->addJoinObject($join, 'Comments');
        }

        return $this;
    }

    /**
     * Use the Comments relation Comments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CommentsQuery A secondary query class using the current class as primary query
     */
    public function useCommentsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinComments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comments', '\CommentsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildArticles $articles Object to remove from the list of results
     *
     * @return $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function prune($articles = null)
    {
        if ($articles) {
            $this->addUsingAlias(ArticlesTableMap::COL_ID, $articles->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the articles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticlesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArticlesTableMap::clearInstancePool();
            ArticlesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticlesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArticlesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ArticlesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ArticlesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ArticlesTableMap::COL_MODIFIED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ArticlesTableMap::COL_MODIFIED);
    }
    
    /**
     * Order by update date asc
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ArticlesTableMap::COL_MODIFIED);
    }
    
    /**
     * Order by create date desc
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ArticlesTableMap::COL_CREATED);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ArticlesTableMap::COL_CREATED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date asc
     *
     * @return     $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ArticlesTableMap::COL_CREATED);
    }

    // sluggable behavior
    
    /**
     * Filter the query on the slug column
     *
     * @param     string $slug The value to use as filter.
     *
     * @return    $this|ChildArticlesQuery The current query, for fluid interface
     */
    public function filterBySlug($slug)
    {
        return $this->addUsingAlias(ArticlesTableMap::COL_URL, $slug, Criteria::EQUAL);
    }
    
    /**
     * Find one object based on its slug
     *
     * @param     string $slug The value to use as filter.
     * @param     ConnectionInterface $con The optional connection object
     *
     * @return    ChildArticles the result, formatted by the current formatter
     */
    public function findOneBySlug($slug, $con = null)
    {
        return $this->filterBySlug($slug)->findOne($con);
    }

} // ArticlesQuery
