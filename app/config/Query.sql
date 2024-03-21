-- I titoli e le date delle esposizioni tematiche che si sono tenute nel periodo 1 gennaio - 31 dicembre di un determinato anno
SELECT Titolo, Data_Inizio
FROM TIPO_BIGLIETTO
WHERE Data_Inizio > 'aaaa-01-1' AND Data_Fine < 'aaaa-12-31';

-- Il numero dei biglietti emessi per una determinata esposizione
SELECT Count(B.ID)
FROM BIGLIETTO AS B, TIPO_BIGLIETTO AS T
WHERE B.ID = T.ID AND
      T.Titolo = 'x';

-- Il ricavato della vendita dei biglietti di una determinata esposizione
SELECT Sum(Prezzo)
FROM BIGLIETTO AS B, TIPO_BIGLIETTO AS T
WHERE B.ID = T.ID AND
      T.titolo = 'x';