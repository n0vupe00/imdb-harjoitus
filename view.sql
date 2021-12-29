// View1 luontilause
CREATE OR REPLACE VIEW View1(Year, Number_of_movies)
AS SELECT T.start_year, COUNT(*) AS  Number_of_movies
FROM Titles AS T
WHERE T.title_type IN ('movie','video')
GROUP BY T.start_year
HAVING T.start_year BETWEEN 1990 AND 2019
ORDER BY T.start_year ASC;

//GetAliasesByRegion-proseduuri
BEGIN

SELECT title FROM aliases WHERE (region = regionName)
GROUP BY title_id ORDER BY title LIMIT 10;

END