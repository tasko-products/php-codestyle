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
    private function expectOrderFromUri(MockInterface $someService, SomeOtherClass $otherClass, Order $order): void {
        $someService->expects()->getOrderByUri($otherClass->getResource()->getUri())->andReturns($order);
    }
```

**Good**

```php
    private function expectOrderFromUri(
        MockInterface $someService,
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

more CleanCode principles: https://github.com/piotrplenik/clean-code-php
