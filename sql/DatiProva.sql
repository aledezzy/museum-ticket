-- SQLBook: Code
/*Usa DBMuseo*/

USE DBMuseo;

/*Inserire dati di prova in tutte le tabelle*/

/*Inserire dati di prova in UTENTE*/
INSERT INTO UTENTE (Nome, Cognome, Email, Password, Ruolo, Disabilita) VALUES ('Mario', 'Rossi', 'mario.rossi@uda.it', 'password', 'Amministratore', NULL);
INSERT INTO UTENTE (Nome, Cognome, Email, Password, Ruolo, Disabilita) VALUES ('Luca', 'Bianchi', 'luca.bianchi@uda.it', 'password', 'Utente', NULL);

/*Inserire dati di prova in BANDITO*/
INSERT INTO BANDITO (Utente, Motivazione) VALUES (2, 'Motivazione 1');

/*Inserire dati di prova in DISABILITA*/
INSERT INTO DISABILITA (Descrizione, Documento) VALUES ('Legge 104', 'Certificato INPS 104');

/*Inserire dati di prova in EXTRA*/
INSERT INTO EXTRA (Descrizione, Supplemento) VALUES ('Audioguida', 5.00);
INSERT INTO EXTRA (Descrizione, Supplemento) VALUES ('Visita guidata', 10.00);

/*Inserire dati di prova in TIPO_BIGLIETTO*/
INSERT INTO TIPO_BIGLIETTO (Prezzo_Base, Titolo, Data_Inizio, Data_Fine) VALUES (10.00, 'Intero', '2020-01-01', '2020-12-31');
INSERT INTO TIPO_BIGLIETTO (Prezzo_Base, Titolo, Data_Inizio, Data_Fine) VALUES (5.00, 'Ridotto', '2020-01-01', '2020-12-31');


/*Inserire dati di prova in BIGLIETTO*/
INSERT INTO BIGLIETTO (Utente, Tipo) VALUES (1, 1);