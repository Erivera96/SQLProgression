/*
 * LeetCode # 620: Given a cinema table, find the movies that were not described as boring 
 * and only print odd ones, order by highest rating first.
*/

SELECT
    id,
    movie,
    description,
    rating
FROM
    cinema
WHERE
    description <> 'boring' AND (id %2) <> 0
ORDER BY
    rating DESC;
