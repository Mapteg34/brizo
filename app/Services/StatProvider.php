<?php

namespace App\Services;

use Carbon\Carbon;
use DB;

class StatProvider
{
    public function getTransfersStat(Carbon $from, Carbon $to): array
    {
        $from = $from->format('Y-m-d');
        $to   = $to->format('Y-m-d');

        $result = DB::select('
            WITH
                years AS (
                    SELECT YEAR(date) AS year, date
                    FROM (
                         SELECT STR_TO_DATE(CONCAT(seq, \'-01-01\'), \'%Y-%m-%d\') AS date
                         FROM seq_0_to_3800
                         WHERE seq >= YEAR(DATE(\''.$from.'\')) AND seq <= YEAR(DATE(\''.$to.'\'))
                     ) AS b
                ),
                years_months AS (
                    SELECT date, YEAR(date) as year, MONTH(date) as month
                    FROM (
                        SELECT STR_TO_DATE(CONCAT(years.year, \'-\', LPAD(m, 2, \'00\'), \'-01\'), \'%Y-%m-%d\') AS date
                        FROM years
                        JOIN (SELECT seq AS m FROM seq_0_to_11) AS months
                    ) AS b
                    WHERE
                        LAST_DAY(date) >= DATE(\''.$from.'\')
                        AND
                        (LAST_DAY(date) + INTERVAL 1 DAY - INTERVAL 1 MONTH) <= DATE(\''.$to.'\')
                ),
                temp_transfers AS (
                    SELECT
                        id,
                        book_id,
                        (LAST_DAY(created_at) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AS date,
                        YEAR(created_at) AS year
                    FROM transfers
                    WHERE created_at >= DATE(\''.$from.'\') AND created_at <= DATE(\''.$to.'\')
                )

                SELECT * FROM (
                    SELECT books.name, ym.year, ym.month, COUNT(t.id) as value
                    FROM books
                    JOIN years_months AS ym
                    LEFT JOIN temp_transfers AS t ON (books.id = t.book_id AND t.date = ym.date)
                    GROUP BY books.id, books.name, ym.year, ym.month
            
                    UNION ALL
            
                    SELECT null AS name, ym.year, ym.month, COUNT(t.id) AS value
                    FROM years_months AS ym
                    LEFT JOIN temp_transfers AS t ON (t.date = ym.date)
                    GROUP BY ym.year, ym.month
            
                    UNION ALL
            
                    SELECT null AS name, years.year, null AS month, COUNT(t.id) AS value
                    FROM years
                    LEFT JOIN temp_transfers AS t ON (years.year = t.year)
                    GROUP BY years.year
                ) as buf
        ');

        foreach ($result as &$line) {
            if (is_null($line->name)) {
                unset($line->name);
            }
            if (is_null($line->month)) {
                $line->date = $line->year;
            } else {
                $line->date = sprintf('%d-%02d', $line->year, $line->month);
            }
            unset($line->month);
            unset($line->year);
        }
        unset($line);

        return $result;
    }
}
