/* progetto basi di dati NICOLO' CINELLI */
DROP DATABASE IF EXISTS PROGETTO;
CREATE DATABASE IF NOT EXISTS PROGETTO;
USE PROGETTO;
#creazione delle tabelle
CREATE TABLE SPECIE(
	classe VARCHAR(200),
	nomeLatino VARCHAR(200) PRIMARY KEY,
    nomeItaliano VARCHAR(200),
    annoClassificazione INT,
    livelloVulnerabilita VARCHAR(20),
    linkWikipedia VARCHAR(100)
    
    )ENGINE=INNODB;
    
CREATE TABLE SPECIEVEGETALE(
	nomeLatino VARCHAR(30) PRIMARY KEY,
    lunghezza INT,
    diametro INT,
    
    FOREIGN KEY(nomeLatino) REFERENCES SPECIE(nomeLatino) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE SPECIEANIMALE(
	nomeLatino VARCHAR(200) PRIMARY KEY,
    peso INT,
    altezza INT, 
    proleMedia INT,
    
    FOREIGN KEY(nomeLatino) REFERENCES SPECIE(nomeLatino) ON DELETE CASCADE
) ENGINE=INNODB;
    
    CREATE TABLE UTENTE(
	nome VARCHAR(20) PRIMARY KEY,
    professione VARCHAR(30),
    foto BLOB,
    contatoreAvvistamentiEffettuati INT DEFAULT NULL,
    annoNascita INT,
    email VARCHAR(30),
    password VARCHAR(20),
    tipoUtente ENUM("SEMPLICE","PREMIUM","AMMINISTRATORE")
) ENGINE=INNODB;

CREATE TABLE UTENTESEMPLICE(
	nome VARCHAR(20) PRIMARY KEY REFERENCES UTENTE(nome)
)ENGINE=INNODB;

CREATE TABLE CLASSIFICA(
	id INT AUTO_INCREMENT PRIMARY KEY,
    classificazioniTotali INT,
    classificazioniCorrette INT,
    classificazioniErrate INT,
    affidabilita INT DEFAULT NULL
)ENGINE=INNODB;
    
CREATE TABLE UTENTEPREMIUM(
	nome VARCHAR(200) PRIMARY KEY REFERENCES UTENTE(nome),
    idClassifica INT,
    
    FOREIGN KEY(idClassifica) REFERENCES CLASSIFICA(id)
)ENGINE=INNODB;

CREATE TABLE UTENTEAMMINISTRATORE(
	nome VARCHAR(200) PRIMARY KEY REFERENCES UTENTE(nome)
)ENGINE=INNODB;
    
CREATE TABLE MODIFICASPECIE(
	timestamp TIMESTAMP,
    nomeLatinoSpecie VARCHAR(200),
    nomeAmministratore VARCHAR(200),

	FOREIGN KEY(nomeLatinoSpecie) REFERENCES SPECIE(nomeLatino),
    FOREIGN KEY(nomeAmministratore) REFERENCES UTENTEAMMINISTRATORE(nome) ON DELETE CASCADE
) ENGINE=INNODB; 
    
CREATE TABLE HABITAT(
	nome VARCHAR(200) PRIMARY KEY,
    descrizione VARCHAR(200)
    
) ENGINE=INNODB;

CREATE TABLE MODIFICAHABITAT(
	timestamp TIMESTAMP,
    nomeHabitat VARCHAR(20),
    nomeAmministratore VARCHAR(20),
    
	FOREIGN KEY(nomeHabitat) REFERENCES HABITAT(nome),
    FOREIGN KEY(nomeAmministratore) REFERENCES UTENTEAMMINISTRATORE(nome)
) ENGINE=INNODB;

CREATE TABLE OSPITA(
	nomeLatinoSpecie VARCHAR(30) REFERENCES SPECIE(nomeLatino) ON DELETE CASCADE,
	nomeHabitat VARCHAR(30) REFERENCES HABITAT(nome) ON DELETE CASCADE,
    
    PRIMARY KEY(nomeLatinoSpecie,nomeHabitat)
) ENGINE=INNODB;

CREATE TABLE MESSAGGIO(
	timestamp TIMESTAMP,
	nomeMittente VARCHAR(200),
    nomeRicevente VARCHAR(200),
    titolo VARCHAR(200),
    testo VARCHAR(300),
    
    PRIMARY KEY(timestamp,nomeMittente,nomeRicevente),
    FOREIGN KEY(nomeMittente) REFERENCES UTENTE(nome) ON DELETE CASCADE,
	FOREIGN KEY(nomeRicevente) REFERENCES UTENTE(nome) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE CAMPAGNAFONDI(
	nrProgr INT AUTO_INCREMENT PRIMARY KEY,
    saldoAttuale INT,
    stato ENUM ("APERTO","CHIUSO"),
    importoObiettivo INT, 
    descrizione VARCHAR(150),
    dataInizio DATE,
    nomeFondatore VARCHAR(200),
    
    FOREIGN KEY(nomeFondatore) REFERENCES UTENTEAMMINISTRATORE(nome) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE ESCURSIONE(
	id INT AUTO_INCREMENT PRIMARY KEY,
	titolo VARCHAR(200),
    nMaxPartecipanti INT,
    descrizione VARCHAR(200),
    tragitto VARCHAR(200),
    data DATE,
    stato ENUM("APERTO","CHIUSO"),
    partecipantiAttuali INT,
    orarioPartenza INT,
    orarioRitorno INT,
    nomeCreatoreEscursione VARCHAR(200),
    
    FOREIGN KEY(nomeCreatoreEscursione) REFERENCES UTENTEPREMIUM(nome)
) ENGINE=INNODB;
    

CREATE TABLE AVVISTAMENTO(
	codice INT AUTO_INCREMENT PRIMARY KEY,
    nomeUtente VARCHAR(20),
    data DATE,
    latitudine INT,
    longitudine INT, 
    foto blob,
    nomeHabitat VARCHAR(20),
    nomeLatino VARCHAR(30),
    
    FOREIGN KEY(nomeUtente) REFERENCES UTENTE(nome),
    FOREIGN KEY(nomeHabitat) REFERENCES HABITAT(nome),
    FOREIGN KEY(nomeLatino) REFERENCES SPECIE(nomeLatino)
) ENGINE=INNODB;

CREATE TABLE DONAZIONE(
	codice INT AUTO_INCREMENT PRIMARY KEY,
	nomeUtente VARCHAR(20),
    nrProgrCampagnaFondi INT,
    importo INT,
    note VARCHAR(50),
    
    FOREIGN KEY(nomeUtente) REFERENCES UTENTE(nome) ON DELETE CASCADE,
    FOREIGN KEY(nrProgrCampagnaFondi) REFERENCES CAMPAGNAFONDI(nrProgr) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE PROPOSTACLASSIFICAZIONE(
    codiceAvvistamento INT,
    data DATE,
    commento VARCHAR(50),
    nomeUtente VARCHAR(20),
    nomeLatino VARCHAR(30),
    
    PRIMARY KEY(codiceAvvistamento,nomeUtente),
	FOREIGN KEY(nomeUtente) REFERENCES UTENTE(nome) ON DELETE CASCADE,
    FOREIGN KEY(codiceAvvistamento) REFERENCES AVVISTAMENTO(codice) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE ISCRIZIONE(
    id INT AUTO_INCREMENT REFERENCES ESCURSIONE(nMaxPartecipanti) ON DELETE CASCADE,
    id_Escursione INT REFERENCES ESCURSIONE(id),
    nomeUtente VARCHAR(20) REFERENCES UTENTE(nome) ON DELETE CASCADE,
    
    PRIMARY KEY(id, nomeUtente)
) ENGINE=INNODB;

#inserimento habitat
INSERT INTO HABITAT VALUES("Laguna", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=69");
INSERT INTO HABITAT VALUES("Lago", "https://it.wikipedia.org/wiki/Lago");
INSERT INTO HABITAT VALUES("Foresta di conifere","https://it.wikipedia.org/wiki/Foreste_di_conifere_temperate");
#inserimento prima specie vegetale
INSERT INTO SPECIE VALUES("Polypodiopsida", "Marsileaquadrifolia", "Trifoglio acquatico comune",1800,"Critico","https://it.wikipedia.org/wiki/Marsilea_quadrifolia");
INSERT INTO SPECIEVEGETALE VALUES("Marsileaquadrifolia",30,15);
INSERT INTO OSPITA VALUES("Marsileaquadrifolia","Laguna");
#inserimento seconda specie vegetale
INSERT INTO SPECIE VALUES("Angiosperme","Galanthus nivalis","Bucaneve",1753, "Critico","https://en.wikipedia.org/wiki/Galanthus_nivalis");
INSERT INTO SPECIEVEGETALE VALUES("Galanthus nivalis",30,5);
INSERT INTO OSPITA VALUES("Galanthus nivalis","Foresta di conifere");
#inserimento prima specie animale
INSERT INTO SPECIE VALUES("MAMMALIA","Hystrix cristata","Istrice",1758,"Minimo","https://it.wikipedia.org/wiki/Hystrix_cristata");
INSERT INTO SPECIEANIMALE VALUES("Hystrix cristata",20,850,2);
INSERT INTO OSPITA VALUES("Hystrix cristata","Foresta mediterranea");
#inserimento seconda specie animale
INSERT INTO SPECIE VALUES("MAMMALIA","Chionomys nivalis","Arvicola delle nevi",1842,"Minimo","https://it.wikipedia.org/wiki/Chionomys_nivalis");
INSERT INTO SPECIEANIMALE VALUES("Chionomys nivalis",100,48,6);
INSERT INTO OSPITA VALUES("Chionomys nivalis","Foresta di conifere");
#inserimento utente admin
INSERT INTO UTENTE VALUES("ADMIN","GESTORE",null,null,2020,"admin@admin.com","ADMIN","AMMINISTRATORE");
INSERT INTO UTENTEAMMINISTRATORE VALUES ("ADMIN");
INSERT INTO UTENTE VALUES("PREMIUM","PREMIUM",null,null,2020,"premium@premium.com","PREMIUM","PREMIUM");
INSERT INTO UTENTEPREMIUM VALUES ("PREMIUM",null);
INSERT INTO AVVISTAMENTO VALUES (null,"ADMIN","2020-01-01","1223","2344",null,"Laguna",null);
INSERT INTO AVVISTAMENTO VALUES (null,"ADMIN","2020-01-01","45354","4422",null,"Lago",null);
#INSERT INTO CAMPAGNAFONDI VALUES (null,null,"APERTO","5000","CORONAVIRUS","2020-01-01","ADMIN");

#STORED PROCEDURES 1: creo una stored procedures da richiamare all'interno del trigger 1
DELIMITER $
CREATE PROCEDURE getSpecieMaggioranza()
BEGIN
	create view contaSpecie(tot,nomeLatino) as (
		select count(*)as tot, nomeLatino
		from PROPOSTACLASSIFICAZIONE,AVVISTAMENTO
		where (AVVISTAMENTO.codice=codiceAvvistamento)
		group by nomeLatino
		having count(*)>=5
	);
	select nomeLatino
	from contaSpecie
	group by nomeLatino
	having max(tot);
END $
DELIMITER ;

#TRIGGER 1: Nel momento in cui si raggiungono almeno 5 proposte, ed
#esiste una specie che ha ricevuto la maggioranza delle indicazioni di 
#classificazione, si aggiunge un collegamento tra l'avvistamento e la specie
DELIMITER $
CREATE TRIGGER contaSpecie
AFTER INSERT ON PROPOSTACLASSIFICAZIONE
FOR EACH ROW
BEGIN
	IF (SELECT codice FROM AVVISTAMENTO,PROPOSTACLASSIFICAZIONE WHERE (codiceAvvistamento=codice) GROUP BY codice HAVING count(*)>=5) = AVVISTAMENTO.codice THEN
    INSERT INTO AVVISTAMENTO(nomeLatino) VALUES(getSpecieMaggioranza());
    END IF;
END $
DELIMITER ;

#STOREDPROCEDURE 2: Salvo il nomeUtente che dev'essere promosso a premium
DELIMITER $
CREATE PROCEDURE getUtenteDaPromuovere()
BEGIN
	SELECT nomeUtente FROM AVVISTAMENTO GROUP BY nomeUtente HAVING count(*)>=3;
END $
DELIMITER ;

#TRIGGER 2: Un utente semplice viene promosso a utente premium
#nel momento in cui inserisce almeno 3 segnalazioni
DELIMITER $
CREATE TRIGGER aggiornaUtente
AFTER INSERT ON AVVISTAMENTO
FOR EACH ROW
BEGIN
  DECLARE cont SMALLINT;
  DECLARE c CURSOR FOR SELECT count(*) FROM AVVISTAMENTO WHERE AVVISTAMENTO.nomeUtente=NEW.nomeUtente;
  OPEN c;
  FETCH c INTO cont;
  CLOSE c;
  IF(cont>2) THEN
    UPDATE UTENTE SET tipoUtente="PREMIUM" WHERE ((UTENTE.nome=NEW.nomeUtente) AND (UTENTE.tipoUtente="SEMPLICE"));
  END IF;
END $
DELIMITER ;
/*
DELIMITER $
CREATE TRIGGER aggiornaUtente
AFTER INSERT ON AVVISTAMENTO
FOR EACH ROW
BEGIN
	IF ((SELECT nomeUtente FROM AVVISTAMENTO GROUP BY nomeUtente HAVING count(*)>=3 ) = AVVISTAMENTO.nomeUtente) THEN
	INSERT INTO UTENTEPREMIUM(nome) VALUES(getUtenteDaPromuovere());
    UPDATE UTENTE SET tipoUtente="PREMIUM";
    DELETE FROM UTENTESEMPLICE WHERE UTENTESEMPLICE.nome=UTENTEPREMIUM.nome;
    END IF;
END $
DELIMITER ; */
#TRIGGER 3: Chiude l'escursione appena si raggiunge il numero max
#dei partecipanti
DELIMITER $
CREATE TRIGGER chiudiEscursione
AFTER UPDATE ON ESCURSIONE
FOR EACH ROW 
BEGIN 
	UPDATE ESCURSIONE SET stato='CHIUSO' WHERE (partecipantiAttuali>=nMaxPartecipanti);
END $
DELIMITER ;
#TRIGGER 4: Quando la campagna fondi raggiunge l'importo previsto, il 
#suo stato viene settato a "Chiuso" e non è possibile ricevere altre 
#donazioni dagli utenti 
DELIMITER $
CREATE TRIGGER chiudiCampagna
AFTER UPDATE ON CAMPAGNAFONDI 
FOR EACH ROW
BEGIN 
	IF (NEW.saldoAttuale <> OLD.saldoAttuale) THEN
    UPDATE CAMPAGNAFONDI SET stato='CHIUSO' WHERE (saldoAttuale>=importoObiettivo);
	END IF;
END $
DELIMITER ;
#TRIGGER 5: Incremento l'attributo partecipantiAttuali ogni volta in cui un nuovo utente
#si iscrive all'escursione
DELIMITER $
CREATE TRIGGER conteggiaIscritti
AFTER UPDATE ON ISCRIZIONE
FOR EACH ROW
BEGIN 
	IF (ISCRIZIONE.id=ESCURSIONE.id) THEN
		UPDATE ESCURSIONE SET partecipantiAttuali=partecipantiAttuali+1;
	END IF;
END $
DELIMITER ;

#TRIGGER 6: gestisco le statistiche
DELIMITER $
CREATE TRIGGER gestioneClassifiche
AFTER UPDATE ON AVVISTAMENTO
FOR EACH ROW
BEGIN
	IF (AVVISTAMENTO.nomeLatino<>NULL) THEN 
		IF (AVVISTAMENTO.nomeLatino=PROPOSTACLASSIFICAZIONE.nomeLatino) THEN
			IF(select id from CLASSIFICA,UTENTE,UTENTEPREMIUM where ((UTENTE.nome=UTENTEPREMIUM.nome) and (UTENTEPREMIUM.classificaId=CLASSIFICA.id)) = CLASSIFICA.id) THEN
				UPDATE CLASSIFICA.classificazioniCorrette SET CLASSIFICA.classificazioniCorrette=CLASSIFICA.classificazioniCorrette+1;
				UPDATE CLASSIFICA.classificazioniTotali SET CLASSIFICA.classificazioniTotali=CLASSIFICA.classificazioniTotali+1;
                UPDATE CLASSIFICA.affidabilita SET CLASSIFICA.affidabilita=calcolaAffidabilita();
			END IF;
		ELSE 
			IF(select id from CLASSIFICA,UTENTE,UTENTEPREMIUM where ((UTENTE.nome=UTENTEPREMIUM.nome) and (UTENTEPREMIUM.classificaId=CLASSIFICA.id)) = CLASSIFICA.id) THEN
				UPDATE CLASSIFICA.classificazioniErrate SET CLASSIFICA.classificazioniErrate=CLASSIFICA.classificazioniErrate+1;
                UPDATE CLASSIFICA.classificazioniTotali SET CLASSIFICA.classificazioniTotali=CLASSIFICA.classificazioniTotali+1;
				UPDATE CLASSIFICA.affidabilita SET CLASSIFICA.affidabilita=calcolaAffidabilita();
			END IF;
		END IF;
	END IF;
END $
DELIMITER ;
/*#TRIGGER X: La somma delle donazioni compone il saldoAttuale della campagnaFondi
DELIMITER $
CREATE TRIGGER saldoAttuale
AFTER INSERT ON DONAZIONE
FOR EACH ROW
BEGIN
	UPDATE CAMPAGNAFONDI SET CAMPAGNAFONDI.saldoAttuale=CAMPAGNAFONDI.saldoAttuale+(SELECT importo FROM DONAZIONE WHERE DONAZIONE.nrProgrCampagnaFondi=CAMPAGNAFONDI.nrProgr);
END $
DELIMITER ;  */
#STORED PROCEDURE 4: calcolo affidabilità
DELIMITER $
CREATE PROCEDURE calcolaAffidabilita()
BEGIN	
	UPDATE CLASSIFICA.affidabilita SET CLASSIFICA.affidabilita=CLASSIFICA.classificazioniCorrette/CLASSIFICA.classificazioniTotali;
END $
DELIMITER ;
#STORED PROCEDURE 5: creo nuovo utente semplice
DELIMITER $
CREATE PROCEDURE creaNuovoUtenteSemplice(IN nomeU VARCHAR(30), IN annoNascitaU INT, IN professioneU VARCHAR(30), IN emailU VARCHAR(20), IN passwordU VARCHAR(20), IN fotoU BLOB)
BEGIN
	INSERT INTO UTENTE(nome,annoNascita, professione,email, password, foto, tipoUtente) VALUES(nomeU, annoNascitaU,  professioneU, emailU, passwordU,fotoU, "SEMPLICE");
    INSERT INTO UTENTESEMPLICE(nome) VALUES(nomeU);
END $
DELIMITER ;
#STORED PROCEDURE 7: creo nuovo utente amministratore
DELIMITER $
CREATE PROCEDURE creaNuovoUtenteAmministratore(IN nomeU VARCHAR(30), IN professioneU VARCHAR(20), IN fotoU BLOB, IN annoNascitaU INT, IN emailU VARCHAR(20), IN passwordU VARCHAR(20))
BEGIN
	INSERT INTO UTENTE(nome, professione, foto, annoNascita, email, password) VALUES(nomeU, professioneU, fotoU, annoNascitaU, emailU, passwordU);
    INSERT INTO UTENTEAMMINISTRATORE(nome) VALUES(nomeU);
END $
DELIMITER ;
#STORED PROCEDURE 9: creo nuovo avvistamento
DELIMITER $
CREATE PROCEDURE creaNuovoAvvistamento(IN nomeUtenteA VARCHAR(20),IN dataA DATE, IN latitudineA INT, IN longitudineA INT,IN fotoA BLOB, IN nomeHabitatA VARCHAR(20))
BEGIN
	UPDATE UTENTE SET contatoreAvvistamentiEffettuati=contatoreAvvistamentiEffettuati+1 WHERE nome=nomeUtenteA;
	INSERT INTO AVVISTAMENTO(nomeUtente,data,latitudine,longitudine,foto,nomeHabitat) VALUES (nomeUtenteA,dataA,latitudineA,longitudineA,fotoA,nomeHabitatA);
END $
DELIMITER ;
#STORED PROCEDURE 10: creo nuova proposta
DELIMITER $
CREATE PROCEDURE creaNuovaProposta(IN codiceAvvistamentoP INT, IN dataP DATE, commentoP VARCHAR(50), nomeUtenteP VARCHAR(30), nomeLatinoP VARCHAR(30))
BEGIN 
    START TRANSACTION;
    INSERT INTO PROPOSTACLASSIFICAZIONE(codiceAvvistamento, data, commento, nomeUtente, nomeLatino) VALUES(codiceAvvistamentoP,dataP,commentoP,nomeUtenteP,nomeLatinoP);
    COMMIT;
END $
DELIMITER ;
#STORED PROCEDURE 11: creo nuova escursione
DELIMITER $
CREATE PROCEDURE creaNuovaEscursione(IN titoloE VARCHAR(20),IN nMaxPartecipantiE INT,IN descrizioneE VARCHAR(200),IN tragittoE VARCHAR(200),IN dataE DATE,IN orarioPartenzaE INT,IN orarioRitornoE INT,IN nomeCreatoreEscursioneE VARCHAR(20))
BEGIN
    START TRANSACTION;
    INSERT INTO ESCURSIONE(titolo,nMaxPartecipanti,descrizione,tragitto,data,stato,partecipantiAttuali,orarioPartenza,orarioRitorno,nomeCreatoreEscursione) VALUES(titoloE,nMaxPartecipantiE,descrizioneE,tragittoE,dataE,"APERTO","",orarioPartenzaE,orarioRitornoE,nomeCreatoreEscursioneE);
    COMMIT;
END $
DELIMITER ;
#STORED PROCEDURE 12: nuova campagna fondi
DELIMITER $
CREATE PROCEDURE creaNuovaCampagna(IN importoObiettivoC INT,IN descrizioneC VARCHAR(150),IN dataInizioC DATE,IN nomeFondatoreC VARCHAR(200))
BEGIN
    START TRANSACTION;
    INSERT INTO CAMPAGNAFONDI(stato,importoObiettivo,descrizione,dataInizio,nomeFondatore)VALUES("APERTO",importoObiettivoC,descrizioneC,dataInizioC,nomeFondatoreC);
    COMMIT;
END $
DELIMITER ;
#STORED PROCEDURE 13: nuovo messaggio
DELIMITER $
CREATE PROCEDURE nuovoMessaggio(IN timestampM TIMESTAMP,IN nomeMittenteM VARCHAR(200),IN nomeRiceventeM VARCHAR(200),IN titoloM VARCHAR(200),IN testoM VARCHAR(300))
BEGIN
		IF EXISTS (SELECT nome FROM UTENTE WHERE nome = nomeRiceventeM) THEN
			START TRANSACTION;
			INSERT INTO MESSAGGIO(timestamp,nomeMittente,nomeRicevente,titolo,testo)VALUES(timestampM,nomeMittenteM,nomeRiceventeM,titoloM,testoM);
            COMMIT;
		END IF;
END $
DELIMITER ;
#STORED PROCEDURE 14: nuova donazione
DELIMITER $
CREATE PROCEDURE nuovaDonazione(IN nomeUtenteD VARCHAR(20),IN nrProgrCampagnaFondiD INT,IN importoD INT,IN noteD VARCHAR(50))
BEGIN
	IF EXISTS(SELECT nrProgr FROM CAMPAGNAFONDI WHERE (CAMPAGNAFONDI.nrProgr=nrProgrCampagnaFondiD)AND(CAMPAGNAFONDI.stato="APERTO")) THEN
		START TRANSACTION;
		UPDATE CAMPAGNAFONDI SET saldoAttuale=+importoD;
		INSERT INTO DONAZIONE(nomeUtente,nrProgrCampagnaFondi,importo,note)VALUES(nomeUtenteD,nrProgrCampagnaFondiD,importoD,noteD);
		COMMIT;
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 15: visualizza escursioni
DELIMITER $
CREATE PROCEDURE visualizzaEscursioni()
BEGIN
	SELECT * FROM ESCURSIONI WHERE stato="APERTO";
END $
DELIMITER ;
#STORED PROCEDURE 16: visualizza campagne fondi
DELIMITER $
CREATE PROCEDURE visualizzaCampagne()
BEGIN
	SELECT * FROM CAMPAGNAFONDI WHERE stato="APERTO";
END $
DELIMITER ;
#STORED PROCEDURE 17: visualizza dati utente
DELIMITER $
CREATE PROCEDURE visualizzaUtente(IN nomeU VARCHAR(20))
BEGIN
	IF EXISTS(SELECT nome FROM UTENTE WHERE UTENTE.nome=nomeU) THEN
		SELECT * FROM UTENTE WHERE UTENTE.nome=nomeU;
	END IF;
END $
DELIMITER ;
#STORED PRCEDURE 18: iscrizione Escursione
DELIMITER $
CREATE PROCEDURE iscrizioneEscursione(IN idE INT,IN nomeUtenteE VARCHAR(20))
BEGIN
	IF EXISTS(SELECT id FROM ESCURSIONE WHERE (ESCURSIONE.id=idE)AND(ESCURSIONE.stato="APERTO")) THEN
		INSERT INTO ISCRIZIONE(id_Escursione,nomeUtente)VALUES(idE,nomeUtenteE);
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 19: nuova specie animale (ADMIN)
DELIMITER $
CREATE PROCEDURE nuovaSpecieAnimale(IN timestampS TIMESTAMP, IN nomeAmministratoreS VARCHAR(200),IN nomeLatinoS VARCHAR(200),IN nomeItalianoS VARCHAR(200),IN classeS VARCHAR(200),IN linkWikipediaS VARCHAR(200),IN livelloVulnerabilitaS VARCHAR(200),IN annoClassificazioneS INT,IN pesoS INT,IN altezzaS INT,IN proleMediaS INT)
BEGIN
	INSERT INTO SPECIE(classe, nomeLatino, nomeItaliano, annoClassificazione, livelloVulnerabilita, linkWikipedia) VALUES(classeS, nomeLatinoS, nomeItalianoS, annoClassificazioneS, livelloVulnerabilitaS, linkWikipediaS);
    INSERT INTO SPECIEANIMALE(nomeLatino,peso,altezza,proleMedia) VALUES(nomeLatinoS,pesoS,altezzaS,proleMediaS);
    INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampS, nomeLatinoS, nomeAmministratoreS);
END $
DELIMITER ;
#STORED PROCEDURE 20: aggiorna specie animale (ADMIN)
DELIMITER $
CREATE PROCEDURE aggiornaSpecieAnimale(IN timestampS TIMESTAMP, IN nomeAmministratoreS VARCHAR(200),IN nomeLatinoX VARCHAR(30),IN pesoX INT, IN altezzaX INT, IN proleMediaX INT)
BEGIN 
	IF EXISTS(SELECT nomeLatino FROM SPECIEANIMALE WHERE nomeLatino=nomeLatinoX) THEN
		UPDATE SPECIEANIMALE SET peso=pesoX, altezza=altezzaX, proleMedia=proleMediaX WHERE nomeLatino=nomeLatinoX;
        INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampS, nomeLatinoX, nomeAmministratoreS);
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 21: rimuovi specie animale (ADMIN)
DELIMITER $
CREATE PROCEDURE rimuoviSpecieAnimale(IN timestampx TIMESTAMP, IN nomeAmministratorex VARCHAR(200),IN nomeLatinox VARCHAR(200))
BEGIN

	IF EXISTS(SELECT nomeLatino FROM SPECIE WHERE nomeLatino=nomeLatinox) THEN
		INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampx, nomeLatinox, nomeAmministratorex);
        SET FOREIGN_KEY_CHECKS = 0;
		DELETE FROM SPECIE WHERE nomeLatino=nomeLatinox;
        DELETE FROM SPECIEANIMALE WHERE nomeLatino=nomeLatinox;
		
	END IF;
  
END $
DELIMITER ;
#STORED PROCEDURE 22: nuova specie vegetale (ADMIN)
DELIMITER $
CREATE PROCEDURE nuovaSpecieVegetale(IN timestampS TIMESTAMP, IN nomeAmministratoreS VARCHAR(200),IN nomeLatinoS VARCHAR(30),IN nomeItalianoS VARCHAR(30),IN classeS VARCHAR(20),IN linkWikipediaS VARCHAR(100),IN livelloVulnerabilitaS VARCHAR(20),IN annoClassificazioneS INT,IN lunghezzaS INT,IN diametroS INT)
BEGIN
	INSERT INTO SPECIE(classe, nomeLatino, nomeItaliano, annoClassificazione, livelloVulnerabilita, linkWikipedia) VALUES(classeS, nomeLatinoS, nomeItalianoS, annoClassificazioneS, livelloVulnerabilitaS, linkWikipediaS);
    INSERT INTO SPECIEVEGETALE(nomeLatino,lunghezza,diametro) VALUES(nomeLatinoS,lunghezzaS,diametroS);
	INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampS, nomeLatinoS, nomeAmministratoreS);
END $
DELIMITER ;
#STORED PROCEDURE 23: aggiorna specie vegetale (ADMIN)
DELIMITER $
CREATE PROCEDURE aggiornaSpecieVegetale(IN timestampS TIMESTAMP, IN nomeAmministratoreS VARCHAR(200),IN nomeLatinoX VARCHAR(30),IN lunghezzaX INT, IN diametroX INT)
BEGIN 
	IF EXISTS(SELECT nomeLatino FROM SPECIEVEGETALE WHERE nomeLatino=nomeLatinoX) THEN
		UPDATE SPECIEVEGETALE SET lunghezza=lunghezzaX, diametro=diametroX WHERE nomeLatino=nomeLatinoX;
        INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampS, nomeLatinoX, nomeAmministratoreS);
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 24: rimuovi specie vegetale (ADMIN)
DELIMITER $
CREATE PROCEDURE rimuoviSpecieVegetale(IN timestampx timestamp, IN nomeAmministratorex VARCHAR(200),IN nomeLatinox VARCHAR(30))
BEGIN
	IF EXISTS(SELECT nomeLatino FROM SPECIE WHERE nomeLatino=nomeLatinox) THEN
		INSERT INTO MODIFICASPECIE(timestamp, nomeLatinoSpecie, nomeAmministratore) VALUES (timestampx, nomeLatinox, nomeAmministratorex);
		SET FOREIGN_KEY_CHECKS = 0;
		DELETE FROM SPECIE WHERE nomeLatino=nomeLatinox;
        DELETE FROM SPECIEVEGETALE WHERE nomeLatino=nomeLatinox;
       
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 25: nuovo habitat (ADMIN)
DELIMITER $
CREATE PROCEDURE nuovoHabitat(IN timestampH timestamp, IN nomeAmministratoreH VARCHAR(200), IN nomeH VARCHAR(30), IN descrizioneH VARCHAR(100))
BEGIN
	INSERT INTO HABITAT(nome,descrizione) VALUES(nomeH,descrizioneH);
    INSERT INTO MODIFICAHABITAT(timestamp, nomeHabitat, nomeAmministratore) VALUES (timestampH, nomeH, nomeAmministratoreH);
END $
DELIMITER ;
#STORED PROCEDURE 26: aggiorna habitat (ADMIN)
DELIMITER $
CREATE PROCEDURE aggiornaHabitat(IN timestampH timestamp, IN nomeAmministratoreH VARCHAR(200),IN nomeH VARCHAR(30), IN descrizioneH VARCHAR(100))
BEGIN
	IF EXISTS(SELECT nome FROM HABITAT WHERE nome=nomeH) THEN
		UPDATE HABITAT SET descrizione=descrizioneH WHERE nome=nomeH;
        INSERT INTO MODIFICAHABITAT(timestamp, nomeHabitat, nomeAmministratore) VALUES (timestampH, nomeH, nomeAmministratoreH);
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 27: rimuovi habitat (ADMIN)
DELIMITER $
CREATE PROCEDURE rimuoviHabitat(IN timestampH timestamp, IN nomeAmministratoreH VARCHAR(200),IN nomeH VARCHAR(30))
BEGIN
	IF EXISTS(SELECT nome FROM HABITAT WHERE nome=nomeH) THEN
		SET FOREIGN_KEY_CHECKS = 0;
		DELETE FROM HABITAT WHERE nome=nomeH;
        INSERT INTO MODIFICAHABITAT(timestamp, nomeHabitat, nomeAmministratore) VALUES (timestampH, nomeH, nomeAmministratoreH);
	END IF;
END $
DELIMITER ;
#STORED PROCEDURE 28: correggere manualmente una classificazione (SOLO admin)
DELIMITER $
CREATE PROCEDURE correggiClassificazione(IN codiceX INT,IN nomeLatinoX VARCHAR(30))
BEGIN
	IF EXISTS(SELECT codice FROM AVVISTAMENTO WHERE AVVISTAMENTO.codice=codiceX) THEN
		SET AUTOCOMMIT=0;
        START TRANSACTION;
		UPDATE nomeLatino SET nomeLatino=nomeLatinoX;
        COMMIT;
    END IF;
END $
DELIMITER ;
#STORED PROCEDURE 29: visualizza classifica utente (affidabilita)
DELIMITER $
CREATE PROCEDURE visualizzaClassificaAffidabilita()
BEGIN
		SELECT id,affidabilita FROM UTENTEPREMIUM,CLASSIFICA WHERE UTENTEPREMIUM.idClassifica=CLASSIFICA.id ORDER BY affidabilita DESC; #serve per l'ordinamento DECRESCENTE
END $
DELIMITER ;
#STORED PROCEDURE 30: visualizza classifica specie in base al numero di segnalazioni ricevute
DELIMITER $
CREATE PROCEDURE visualizzaClassificaSpecieSegnalazioni()
BEGIN
	CREATE VIEW contaSegnalazioniSpecie(nomeLatino, tot) AS (
		SELECT SPECIE.nomeLatino, count(*) as tot
        FROM SPECIE, AVVISTAMENTO
        WHERE AVVISTAMENTO.nomeLatino=SPECIE.nomeLatino
        GROUP BY SPECIE.nomeLatino
        );
	SELECT * FROM contaSegnalazioniSpecie ORDER BY tot DESC;
END $
DELIMITER ;
#STORED PROCEDURE 31: visualizza classifica utenti più attivi
DELIMITER $
CREATE PROCEDURE visualizzaClassificaUtentiAttivi()
BEGIN
	CREATE VIEW contaSegnalazioniUtente(nome,tot) AS(
		SELECT nome,count(*) AS tot
		FROM UTENTE,AVVISTAMENTO
		WHERE UTENTE.nome=AVVISTAMENTO.nomeUtente
		GROUP BY nome
	);
	SELECT * FROM contaSegnalazioniUtente ORDER BY tot DESC;
END $
DELIMITER ;
call creaNuovaEscursione("Gita","20","Viaggio in danimarca","Italia-Danimarca","2020-01-01","9","18","PREMIUM"); 
#call creaNuovoAvvistamento("ADMIN","2020-01-01","1223","2344",null,"Laguna");
call nuovoMessaggio(current_date,"ADMIN","ADMIN","Bella","T'appost");
call nuovoMessaggio(current_date,"PREMIUM","ADMIN","Bella","T'appost");
call creaNuovaCampagna("5000","CORONAVIRUS","2020-01-01","ADMIN");
call nuovaDonazione("ADMIN","1","70","ce la faremoooooo");
call nuovaSpecieAnimale(current_date,"ADMIN","brooo","frate","mallared","","Minimo","1999","30","40","2");
call nuovaSpecieVegetale(current_date,"ADMIN","braaa","frate","mallared","","Minimo","1999","30","40");
call nuovoHabitat(current_date,"ADMIN","Maremma","https://it.wikipedia.org/wiki/Maremma");
#INSERT INTO AVVISTAMENTO VALUES (null,"ADMIN","2020-01-01","111111","22222",null,"Lago",null);
#call aggiornaSpecieVegetale(current_date,"ADMIN","braaa","90","90");
#call rimuoviSpecieAnimale(current_date,"ADMIN","brooo");
#call rimuoviSpecieVegetale(current_date,"ADMIN","Galanthus nivalis");
#call rimuoviHabitat(current_date,"ADMIN","Lago");
#call nuovaDonazione("ADMIN","1","30","dai dai");