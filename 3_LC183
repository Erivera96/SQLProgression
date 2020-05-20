/*
 * LeetCode # 183: Given a table of Customers (with Id and Name) and 
 * a table of Orders (with Id and Customer Id), find the customers that
 * never ordered. (display just name titled as Customers)
*/

SELECT
    c.Name AS Customers
FROM
    Customers AS c
    
LEFT OUTER JOIN
    Orders AS o
ON
    c.Id = o.CustomerId
WHERE
    o.CustomerId IS NULL
