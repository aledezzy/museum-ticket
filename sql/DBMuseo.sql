/*Database del museo*/
/*
UTENTE (ID, Nome, Cognome, Email, Password, Ruolo, Disabilita)
BANDITO (Utente, Motivazione)
DISABILITA (ID, Descrizione, Documento)
BIGLIETTO (ID, Utente* (FK di Utente ID), Tipo* (FK di ID tipo biglietto))
AGGIUNTE (Biglietto, Aggiunta* (FK di ID extra)
EXTRA (ID, Descrizione, Supplemento)
TIPO_BIGLIETTO (ID, Prezzo_Base, Titolo, Data_Inizio*, Data_Fine*)
*/
CREATE DATABASE IF NOT EXISTS DBMuseo;

USE DBMuseo;

/*Crea le tabelle*/
CREATE TABLE IF NOT EXISTS UTENTE (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Ruolo ENUM('Amministratore', 'Utente') NOT NULL,
    Disabilita INT,
    FOREIGN KEY (Disabilita) REFERENCES DISABILITA(ID)
);

CREATE TABLE IF NOT EXISTS BANDITO (
    Utente INT PRIMARY KEY,
    Motivazione VARCHAR(100) NOT NULL,
    FOREIGN KEY (Utente) REFERENCES UTENTE(ID)
);

CREATE TABLE IF NOT EXISTS DISABILITA (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Descrizione VARCHAR(100) NOT NULL,
    Documento VARCHAR(100) NOT NULL
);


CREATE TABLE IF NOT EXISTS EXTRA (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Descrizione VARCHAR(100) NOT NULL,
    Supplemento DECIMAL(5, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS TIPO_BIGLIETTO (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Prezzo_Base DECIMAL(5, 2) NOT NULL,
    Titolo VARCHAR(50) NOT NULL,
    Data_Inizio DATE NOT NULL,
    Data_Fine DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS BIGLIETTO (
    ID INT AUTO_INCREMENT PRIMARY KEY,  
    Utente INT NOT NULL,
    Tipo INT NOT NULL,
    FOREIGN KEY (Utente) REFERENCES UTENTE(ID),
    FOREIGN KEY (Tipo) REFERENCES TIPO_BIGLIETTO(ID)
);
CREATE TABLE IF NOT EXISTS AGGIUNTE (
    Biglietto INT NOT NULL,
    Aggiunta INT NOT NULL,
    PRIMARY KEY (Biglietto, Aggiunta),
    FOREIGN KEY (Biglietto) REFERENCES BIGLIETTO(ID),
    FOREIGN KEY (Aggiunta) REFERENCES EXTRA(ID)
);


/*crea un index per email*/
CREATE UNIQUE INDEX IF NOT EXISTS email ON UTENTE(Email);