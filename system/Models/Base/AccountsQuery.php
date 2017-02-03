<?php

namespace Base;

use \Accounts as ChildAccounts;
use \AccountsQuery as ChildAccountsQuery;
use \Exception;
use \PDO;
use Map\AccountsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'accounts' table.
 *
 * 
 *
 * @method     ChildAccountsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAccountsQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method     ChildAccountsQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method     ChildAccountsQuery orderByProfilePic($order = Criteria::ASC) Order by the profile_pic column
 * @method     ChildAccountsQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildAccountsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildAccountsQuery orderByAge($order = Criteria::ASC) Order by the age column
 * @method     ChildAccountsQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildAccountsQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildAccountsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildAccountsQuery orderByNewsletter($order = Criteria::ASC) Order by the newsletter column
 * @method     ChildAccountsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildAccountsQuery orderByModified($order = Criteria::ASC) Order by the modified column
 *
 * @method     ChildAccountsQuery groupById() Group by the id column
 * @method     ChildAccountsQuery groupByFname() Group by the fname column
 * @method     ChildAccountsQuery groupByLname() Group by the lname column
 * @method     ChildAccountsQuery groupByProfilePic() Group by the profile_pic column
 * @method     ChildAccountsQuery groupByPassword() Group by the password column
 * @method     ChildAccountsQuery groupByEmail() Group by the email column
 * @method     ChildAccountsQuery groupByAge() Group by the age column
 * @method     ChildAccountsQuery groupByPhone() Group by the phone column
 * @method     ChildAccountsQuery groupByGender() Group by the gender column
 * @method     ChildAccountsQuery groupByStatus() Group by the status column
 * @method     ChildAccountsQuery groupByNewsletter() Group by the newsletter column
 * @method     ChildAccountsQuery groupByCreated() Group by the created column
 * @method     ChildAccountsQuery groupByModified() Group by the modified column
 *
 * @method     ChildAccountsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccounts findOne(ConnectionInterface $con = null) Return the first ChildAccounts matching the query
 * @method     ChildAccounts findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccounts matching the query, or a new ChildAccounts object populated from the query conditions when no match is found
 *
 * @method     ChildAccounts findOneById(int $id) Return the first ChildAccounts filtered by the id column
 * @method     ChildAccounts findOneByFname(string $fname) Return the first ChildAccounts filtered by the fname column
 * @method     ChildAccounts findOneByLname(string $lname) Return the first ChildAccounts filtered by the lname column
 * @method     ChildAccounts findOneByProfilePic(string $profile_pic) Return the first ChildAccounts filtered by the profile_pic column
 * @method     ChildAccounts findOneByPassword(string $password) Return the first ChildAccounts filtered by the password column
 * @method     ChildAccounts findOneByEmail(string $email) Return the first ChildAccounts filtered by the email column
 * @method     ChildAccounts findOneByAge(int $age) Return the first ChildAccounts filtered by the age column
 * @method     ChildAccounts findOneByPhone(string $phone) Return the first ChildAccounts filtered by the phone column
 * @method     ChildAccounts findOneByGender(string $gender) Return the first ChildAccounts filtered by the gender column
 * @method     ChildAccounts findOneByStatus(int $status) Return the first ChildAccounts filtered by the status column
 * @method     ChildAccounts findOneByNewsletter(boolean $newsletter) Return the first ChildAccounts filtered by the newsletter column
 * @method     ChildAccounts findOneByCreated(string $created) Return the first ChildAccounts filtered by the created column
 * @method     ChildAccounts findOneByModified(string $modified) Return the first ChildAccounts filtered by the modified column *

 * @method     ChildAccounts requirePk($key, ConnectionInterface $con = null) Return the ChildAccounts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOne(ConnectionInterface $con = null) Return the first ChildAccounts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccounts requireOneById(int $id) Return the first ChildAccounts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByFname(string $fname) Return the first ChildAccounts filtered by the fname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByLname(string $lname) Return the first ChildAccounts filtered by the lname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByProfilePic(string $profile_pic) Return the first ChildAccounts filtered by the profile_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByPassword(string $password) Return the first ChildAccounts filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByEmail(string $email) Return the first ChildAccounts filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByAge(int $age) Return the first ChildAccounts filtered by the age column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByPhone(string $phone) Return the first ChildAccounts filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByGender(string $gender) Return the first ChildAccounts filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByStatus(int $status) Return the first ChildAccounts filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByNewsletter(boolean $newsletter) Return the first ChildAccounts filtered by the newsletter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByCreated(string $created) Return the first ChildAccounts filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccounts requireOneByModified(string $modified) Return the first ChildAccounts filtered by the modified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccounts[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccounts objects based on current ModelCriteria
 * @method     ChildAccounts[]|ObjectCollection findById(int $id) Return ChildAccounts objects filtered by the id column
 * @method     ChildAccounts[]|ObjectCollection findByFname(string $fname) Return ChildAccounts objects filtered by the fname column
 * @method     ChildAccounts[]|ObjectCollection findByLname(string $lname) Return ChildAccounts objects filtered by the lname column
 * @method     ChildAccounts[]|ObjectCollection findByProfilePic(string $profile_pic) Return ChildAccounts objects filtered by the profile_pic column
 * @method     ChildAccounts[]|ObjectCollection findByPassword(string $password) Return ChildAccounts objects filtered by the password column
 * @method     ChildAccounts[]|ObjectCollection findByEmail(string $email) Return ChildAccounts objects filtered by the email column
 * @method     ChildAccounts[]|ObjectCollection findByAge(int $age) Return ChildAccounts objects filtered by the age column
 * @method     ChildAccounts[]|ObjectCollection findByPhone(string $phone) Return ChildAccounts objects filtered by the phone column
 * @method     ChildAccounts[]|ObjectCollection findByGender(string $gender) Return ChildAccounts objects filtered by the gender column
 * @method     ChildAccounts[]|ObjectCollection findByStatus(int $status) Return ChildAccounts objects filtered by the status column
 * @method     ChildAccounts[]|ObjectCollection findByNewsletter(boolean $newsletter) Return ChildAccounts objects filtered by the newsletter column
 * @method     ChildAccounts[]|ObjectCollection findByCreated(string $created) Return ChildAccounts objects filtered by the created column
 * @method     ChildAccounts[]|ObjectCollection findByModified(string $modified) Return ChildAccounts objects filtered by the modified column
 * @method     ChildAccounts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AccountsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Accounts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountsQuery) {
            return $criteria;
        }
        $query = new ChildAccountsQuery();
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
     * @return ChildAccounts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccounts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, fname, lname, profile_pic, password, email, age, phone, gender, status, newsletter, created, modified FROM accounts WHERE id = :p0';
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
            /** @var ChildAccounts $obj */
            $obj = new ChildAccounts();
            $obj->hydrate($row);
            AccountsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccounts|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AccountsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AccountsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%', Criteria::LIKE); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%', Criteria::LIKE); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the profile_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByProfilePic('fooValue');   // WHERE profile_pic = 'fooValue'
     * $query->filterByProfilePic('%fooValue%', Criteria::LIKE); // WHERE profile_pic LIKE '%fooValue%'
     * </code>
     *
     * @param     string $profilePic The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByProfilePic($profilePic = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profilePic)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_PROFILE_PIC, $profilePic, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the age column
     *
     * Example usage:
     * <code>
     * $query->filterByAge(1234); // WHERE age = 1234
     * $query->filterByAge(array(12, 34)); // WHERE age IN (12, 34)
     * $query->filterByAge(array('min' => 12)); // WHERE age > 12
     * </code>
     *
     * @param     mixed $age The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByAge($age = null, $comparison = null)
    {
        if (is_array($age)) {
            $useMinMax = false;
            if (isset($age['min'])) {
                $this->addUsingAlias(AccountsTableMap::COL_AGE, $age['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($age['max'])) {
                $this->addUsingAlias(AccountsTableMap::COL_AGE, $age['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_AGE, $age, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(AccountsTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(AccountsTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the newsletter column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsletter(true); // WHERE newsletter = true
     * $query->filterByNewsletter('yes'); // WHERE newsletter = true
     * </code>
     *
     * @param     boolean|string $newsletter The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByNewsletter($newsletter = null, $comparison = null)
    {
        if (is_string($newsletter)) {
            $newsletter = in_array(strtolower($newsletter), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccountsTableMap::COL_NEWSLETTER, $newsletter, $comparison);
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
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(AccountsTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(AccountsTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_CREATED, $created, $comparison);
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
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function filterByModified($modified = null, $comparison = null)
    {
        if (is_array($modified)) {
            $useMinMax = false;
            if (isset($modified['min'])) {
                $this->addUsingAlias(AccountsTableMap::COL_MODIFIED, $modified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modified['max'])) {
                $this->addUsingAlias(AccountsTableMap::COL_MODIFIED, $modified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountsTableMap::COL_MODIFIED, $modified, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAccounts $accounts Object to remove from the list of results
     *
     * @return $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function prune($accounts = null)
    {
        if ($accounts) {
            $this->addUsingAlias(AccountsTableMap::COL_ID, $accounts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the accounts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountsTableMap::clearInstancePool();
            AccountsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            AccountsTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            AccountsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(AccountsTableMap::COL_MODIFIED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(AccountsTableMap::COL_MODIFIED);
    }
    
    /**
     * Order by update date asc
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(AccountsTableMap::COL_MODIFIED);
    }
    
    /**
     * Order by create date desc
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(AccountsTableMap::COL_CREATED);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(AccountsTableMap::COL_CREATED, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date asc
     *
     * @return     $this|ChildAccountsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(AccountsTableMap::COL_CREATED);
    }

} // AccountsQuery
