# PHP Codestyle

The tasko Codestyle is based on the
[PSR-12](https://www.php-fig.org/psr/psr-12/) guidlines with some addtions.

## Every new PHP file has to have header
This block of code provides information about the copyright and license of the
code and declares strict typing.

```php
<?php
/**
 * @copyright    (c) tasko Products GmbH
 * @license      Commercial
 */

declare(strict_types=1);
```
4 spaces by `copyright` and 6 spaces by `license`

## Comment Your Code

This doesn't mean that you start commenting everywhere in your code and create a
huge load of unwanted comments. If you do so then your failing to express the
code you had written to other developers.

Comment whenever it's necessary, when you have some complicated code or
expression so that developers and you at later point will understand what you
were trying to achieve.

**Bad**

```php
/** Get the user details */
public function getUserSalary(int $id): string 
{
    /** Fetch the user details by id */
    $user = User::where('id', $id)->first();

    /** Calling function to calculate user's current month salary */
    $this->currentMonthSalary($user);
    //...
}

/** Calculating the current month salary of user */
private function currentMonthSalary(User $user): void
{
    /** Salary = (Total Days - Leave Days) * PerDay Salary */
    // ...
}
```

**Good**

```php
public function getUserSalary(int $id): void
{
    $user = User::where('id', $id)->first();

    $this->currentMonthSalary($user);
    //...
}

private function currentMonthSalary(User $user): string
{
    /** Salary = (Total Days - Leave Days) * PerDay Salary */
    // ...
}
```

## Use Meaningful & Pronounceable Variable Names

**Bad**

```php
$ymdstr = date('d-M-Y', strtotime($customer->created_at));
```

**Good**

```php
$customerRegisteredDate = date('d-M-Y', strtotime($customer->created_at));
```

## Use Proper & Meaningful Method Names

**Bad**

```php
public function user($email): void
{
    // ...
}
```

**Good**

```php
public function getUserDetailsByEmail($email): array
{
    // ...
}
```

## Readable & Searchable Code

Try to use CONSTANTS or Functions for more readable & searchable code. This
helps you very much in a longer run

**Bad**

```php
// What the heck is 1 & 2 for?
if ($user->gender == 1) {
    // ...
}

if ($user->gender == 2) {
    // ...
}
```

**Good**

```php
public const MALE = 1;
public const FEMALE = 2;

if ($user->gender === MALE) {
    // ...
}

if ($user->gender === FEMALE) {
    // ...
}
```

## Avoid Deep Nesting & Return Early

Avoid deep nesting as much as possible and use early returns.
Deep nesting, also known as excessive nesting, occurs when multiple levels of
indentation are used in code to represent a complex control flow. While nesting
is sometimes necessary for creating complex algorithms, it is generally best to
avoid excessive nesting in your coding style for the following reasons:

+ Decreased readability: When code is excessively nested, it can be difficult to
read and understand. This can lead to errors, especially when other developers
need to read or modify your code.
+ Increased complexity: Excessive nesting can make code more complex than it
needs to be. This can make it harder to maintain, debug, and test.
+ Reduced performance: Excessive nesting can reduce performance, as each level
of nesting requires additional processing time. This may not be noticeable in
small applications, but it can have a significant impact on larger applications.
+ Higher risk of errors: Deeply nested code is more error-prone, as it can be
difficult to keep track of all the conditions and logic. This can lead to bugs,
unexpected results, and security vulnerabilities.

To avoid excessive nesting, you can use techniques like early return, guard
clauses, and flattening conditional statements. These techniques can help
simplify your code, make it more readable, and reduce the risk of errors:

### 1) <ins>Early Return</ins>:
**Bad**

```php
public function calculatePrice($quantity, $pricePerUnit): float {
    $price = 0;
    if ($quantity > 0) {
        $price = $quantity * $pricePerUnit;
        if ($price > 100) {
            //...
        }
    }
    
    return $price;
}
```

**Good**

```php
public function calculatePrice($quantity, $pricePerUnit): float {
    if ($quantity <= 0) {
        return 0;
    }
    
    $price = $quantity * $pricePerUnit;
    if ($price > 100) {
        //...
    }
    
    return $price;
}
```

### 2) <ins>Guard Clauses</ins>:
**Bad**

```php
public function calculateTax($price, $taxRate): int {
    $tax = 0;
    if ($price > 0) {
        $tax = $price * $taxRate;
    }
    
    return $tax;
}
```

**Good**

```php
public function calculateTax($price, $taxRate): int {
    if ($price <= 0) {
        return 0;
    }
    
    return $price * $taxRate;    
}
```

### 3) <ins>Flattening Conditional Statements</ins>:
**Bad**

```php
if ($user->isAdmin()) {
    if ($user->isSuperAdmin()) {
        // do something
    }
    else {
        // do something else
    }
}
else {
    // do something different
}
```

**Good**

```php
if ($user->isSuperAdmin()) {
    // do something
}
else if ($user->isAdmin()) {
    // do something else
}
else {
    // do something different
}
```

## Avoid Useless Variables As Much As Possible

**Basically if you use the variable more than 2 times in a code then keep that
variable else directly use it inside the code.** This improves the readability
and makes your code cleaner.

**Bad**

```php
public function addNumbers($a, $b): int {
    $result = $a + $b;
    $finalResult = $result * 2; // Useless variable
    return $finalResult;
}
```

**Good**

```php
public function addNumbers($a, $b): int {
    return ($a + $b) * 2; // Directly use the expression
}
```

## Null Coalescing Operator ( ?? )

Null Coalescing operator checks if the variable or the condition was empty or
not.

**Bad**

```php
if (!empty($user)) {
  return $user;
}

return false;
```

**Good**

```php
return $user ?? false;
```

## Comparison (===, !==)

**Bad**

The simple comparison will convert the string in an integer.

```php
$a = '7';
$b = 7;

if ($a != $b) {
    // The expression will always pass
}
```

The comparison $a != $b returns FALSE but in fact it's TRUE! The string 7 is
different from the integer 7.

**Good**

The identical comparison will compare type and value.

```php
$a = '7';
$b = 7;

if ($a !== $b) {
    // The expression is verified
}
```

The comparison $a !== $b returns TRUE.

## Null check

**Good**

It is a good habit to check for nullable variables using the
`null === $variable` format:

```php
if (null === $variable) {
    // code here
}
```

This format helps to prevent <ins>**accidental**</ins> assignment of null
values to variables such as:

```php
if ($variable = null) {
    
}
```

## Encapsulate Conditionals
Writing conditions is not bad but if you encapsulate into methods/functions then
it will help better readability and maintain code in the future.

**Bad**

```php
if ($article->status === 'published') {
    // ...
}
```

**Good**

```php
if ($article->isPublished()) {
    // ...
}
```

## Use an IDE ruler of 80 characters
If a line of code exceeds 80 characters, use the line-breaks accordingly:

**Bad**

```php
private function withOrderFromUri(\Mockery\MockInterface $someService, SomeOtherClass $otherClass, Order $order): void {
    $someService->expects()->getOrderByUri($otherClass->getResource()->getUri())->andReturns($order);
}
```

**Good**

```php
private function withOrderFromUri(
    \Mockery\MockInterface $someService,
    SomeOtherClass $otherClass,
    Order $order,
): void {
    $someService
        ->expects()
        ->getOrderByUri($otherClass->getResource()->getUri())
        ->andReturns($order)
    ;
}
```

The use of line breaks and indentation in the second function makes the code
more readable and easier to understand, especially when dealing with longer
method chains.

Pay attention, that in this example semicolon is placed on the new line to make
it more visible, where is the end fo this chained code expression.

When using the nullsafe operator (or some other) in a chained method, it is
necessary to begin the new line with the operator. This ensures that the
operator is properly applied to the previous method call in the chain.

```php
// Set the billing address for an invoice
$invoice->setBillingAddress(
    $order->getCustomer()
        ?->getAddress()
        ?->getBillingAddress()
);
```

### Long strings - an exception

However, we do not apply this rule to long strings. The reason for this is that
breaking long strings into several short strings makes them much harder to find,
especially when it comes to log messages. For practical reasons, we refrain
from using more readable and accessible code at this point.

**Bad**

```php
private function doSomething(Some $thing, string $callerId): void
{
    $this->logger->info(
        'Something really important happented within {something}, triggered'
        . 'from caller {callerId}',
        [
            'something' => $thing->getName(),
            'callerId' => $callerId,
        ],
    );
}
```

**Good**

```php
private function doSomething(Some $thing, string $callerId): void
{
    $this->logger->info(
        'Something really important happented within {something}, triggered from caller {callerId}',
        [
            'something' => $thing->getName(),
            'callerId' => $callerId,
        ],
    );
}
```

## Unit tests

Unit tests are to be set up according to the AAA pattern, whereby the areas are
not labeled. This applies to simple test functions as well as to table-driven
tests (data providers).

**Bad**

```php
public function testCalculateTotalPriceForArticles(): void
{
    $taxService = \Mockery::mock(TaxServiceInterface::class);
    $taxService->expects()->getTaxRate()->andReturns(0.19);

    $logger = \Mockery::mock(LoggerInterface::class);
    $logger
        ->expects()
        ->info(
            'A total price {totalPrice} has been calculated, including a tax portion of {taxRate}%',
            [
                'totalPrice' => 51.1581,
                'taxRate' => 0.19,
            ],
        )
    ;

    $this->assertEquals(
        51.1581,
        (new PriceCalculationService($taxService, $logger))
            ->calculateTotalPriceForArticles(
                [
                    (new Article)->setPrice(10.00),
                    (new Article)->setPrice(10.90),
                    (new Article)->setPrice(10.09),
                    (new Article)->setPrice(2.00),
                ],
            ),
    );
}
```

**Better**

Based on the AAA pattern, the readability of the unit test is now improved by
separating the essential areas of the test. This separation is achieved through
groupings that follow a defined order.

At the beginning of a test, all dependencies of the class under test are mocked
in the Arrange section if the test case requires it - not every test case
requires mocks.

The Arrange section is followed by the Act section, which initializes the
parameters required for the test-case. These are placed as close to the method
under test as possible for better readability and grouping.

```php
public function testCalculateTotalPriceForArticles(): void
{
    $taxService = \Mockery::mock(TaxServiceInterface::class);
    $taxService->expects()->getTaxRate()->andReturns(0.19);

    $logger = \Mockery::mock(LoggerInterface::class);
    $logger
        ->expects()
        ->info(
            'A total price {totalPrice} has been calculated, including a tax portion of {taxRate}%',
            [
                'totalPrice' => 51.1581,
                'taxRate' => 0.19,
            ],
        )
    ;

    $service = new PriceCalculationService($taxService, $logger);

    $articles = [
        (new Article)->setPrice(10.00),
        (new Article)->setPrice(10.90),
        (new Article)->setPrice(10.09),
        (new Article)->setPrice(2.00),
    ];

    $actual = $service->calculateTotalPriceForArticles($articles);

    $this->assertEquals(51.1581, $actual);
}
```

**Good**

Creating mocks of classes and configuring function calls can produce very
large, unreadable code, depending on the complexity of the function parameters. 

To further improve readability and test code reusability, let's take a look at
our own assertion function syntax.

The assertion functions are divided into **with**, **without**, and **expects**
assertions. The with and without assertions are always for the case that a
function of a mock does or does not provide data. These are often used for
repositories, but there are also examples of API or configuration services.

Finally, there are the expects assertions. These are used for all other actions
we expect to happen to our mocks. This includes classic interactions like
sending a message, logging and API calls, i.e. everything that cannot be (well)
combined linguistically with "with" or "without" - after all, our goal is to
write readable tests.

As a team, we agreed that the order in which the assertion functions are
declared is also important. In the tests in the Arrange section, we always start
with the providing with/without assertions and their mocks. Followed by the
expects assertions before the initialization of the class under test. Mocks
that have with/without & expects assertions are an exception. If they occur,
they should be placed between the with/without assertions and the expects
assertions. Again, the with and without assertions are defined on the mock
first, followed by the expects assertions.

It is also worth noting that assertion functions, and in particular with and
without assertions, can often be provided via repository-specific test traits,
and can therefore be used across the board in all tests that integrate the
repositories as dependencies. The same is applicable to info, warning, and
error log expect assertions.

```php
public function testCalculateTotalPriceForArticles(): void
{
    $taxService = \Mockery::mock(TaxServiceInterface::class);
    $this->withTaxRate($taxService);

    $logger = \Mockery::mock(LoggerInterface::class);
    $this->expectsPriceCalculatedInfoLog($logger);

    $service = new PriceCalculationService($taxService, $logger);

    $articles = [
        (new Article)->setPrice(10.00),
        (new Article)->setPrice(10.90),
        (new Article)->setPrice(10.09),
        (new Article)->setPrice(2.00),
    ];

    $actual = $service->calculateTotalPriceForArticles($articles);

    $this->assertEquals(51.1581, $actual);
}

private function withTaxRate(\Mockery\MockInterface $taxService): void
{
    $taxService->expects()->getTaxRate()->andReturns(0.19);
}

private function expectsPriceCalculatedInfoLog(
    \Mockery\MockInterface $logger,
): void {
    $logger
        ->expects()
        ->info(
            'A total price {totalPrice} has been calculated, including a tax portion of {taxRate}%',
            [
                'totalPrice' => 51.1581,
                'taxRate' => 0.19,
            ],
        )
    ;
}
```

## Trailing commas

Based on PER Coding Styles 2.0, we use trailing commas for related multiline
statements such as function parameters, function calls, and arrays.

This gives us several advantages. The first advantage is probably a bit
surprising at first glance: we get a more consistent and clearer syntax. For all
related multiline statements, there is only one rule - indent and append a
comma. Not like before, where this rule applied to all lines except the last.
Without a trailing comma, it is more difficult for colleagues, one of whom adds
trailing commas and the other does not, as well as for code style fixers who
have to correct a more complex set of rules.

Another advantage of trailing commas is that it simplifies versioning and code
review. When additional lines are added using trailing commas, there is only one
diff on one line instead of two lines.

**Bad array**

```php
$handbags = [
    'Hermes Birkin',
    'Chanel 2.55',
    'Louis Vuitton Speedy'
];
```

**Good array**

```php
$handbags = [
    'Hermes Birkin',
    'Chanel 2.55',
    'Louis Vuitton Speedy',
];
```

**Bad function declaration**

```php
/**
 * @param string ...$other
 */
function compareHandbags(
    string $handbag,
    ...$other
) {
    // compare logic
}
```

**Good function declaration**

```php
/**
 * @param string ...$other
 */
function compareHandbags(
    string $handbag,
    ...$other,
) {
    // compare logic
}
```

**Bad function call**

```php
compareHandbags(
    'Prada Galleria',
    'Dior Saddle',
    'Gucci Dionysus'
);
```

**Good function call**

```php
compareHandbags(
    'Prada Galleria',
    'Dior Saddle',
    'Gucci Dionysus',
);
```

**Bad match**

```php
$recommendation = match ($userPreference) {
    'classic' => 'Chanel 2.55',
    'modern' => 'Stella McCartney Falabella',
    'versatile' => 'Louis Vuitton Neverfull'
};
```

**Good match**

```php
$recommendation = match ($userPreference) {
    'classic' => 'Chanel 2.55',
    'modern' => 'Stella McCartney Falabella',
    'versatile' => 'Louis Vuitton Neverfull',
};
```

more CleanCode principles: https://github.com/piotrplenik/clean-code-php
