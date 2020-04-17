--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;


CREATE USER phalcon_user WITH PASSWORD '1234';
GRANT ALL PRIVILEGES ON DATABASE devtools TO phalcon_user;

--
-- Tables for testing describeReferences()
--
-- Table: foreign_key_parent
CREATE TABLE foreign_key_parent (
    id SERIAL,
    name character varying(70) NOT NULL,
    refer_int integer NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (refer_int)
);

ALTER TABLE public.foreign_key_parent OWNER TO postgres;

-- Table: foreign_key_child
CREATE TABLE foreign_key_child (
    id SERIAL,
    name character varying(70) NOT NULL,
    child_int integer NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (child_int)
);

ALTER TABLE public.foreign_key_child OWNER TO postgres;

--
-- Table for testing generating migrations and methods batchInsert(), batchDelete()
--
-- Table: test_insert_delete
CREATE TABLE test_insert_delete (
  id SERIAL,
  login_type_id INTEGER NOT NULL,
  username VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  email_addr VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  phone_num BIGINT NULL,
  token_id BIGINT NULL,
  PRIMARY KEY (id),
  UNIQUE (username)
);

ALTER TABLE public.test_insert_delete OWNER TO postgres;

INSERT INTO public.test_insert_delete VALUES
  (3, 3, 'superadmin3', 'First name Last name', 'email@test.com', '', NULL, null);

DROP TABLE IF EXISTS test_migrations;
CREATE TABLE test_migrations (
    id SERIAL,
    name VARCHAR(45) NOT NULL,
    created_at timestamp  NOT NULL,
    updated_at timestamp  NOT NULL,
    active smallint  NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE "genScaffold" (
  id SERIAL PRIMARY KEY,
  firstname varchar(255) default NULL,
  surname varchar(255) default NULL,
  membertype varchar(255),
  dateofbirth varchar(255)
);

INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Geoffrey','Horne','A4X9V','19-04-16'),('Vielka','Vaughan','Q0N0T','19-04-15'),('Amery','Armstrong','T0Y1D','19-04-16'),('Malcolm','Rosario','E7D7H','19-04-16'),('Tanya','Stafford','P6X1A','19-04-17'),('Mannix','Jackson','G8Q8I','19-04-16'),('Uriah','Jensen','E6R4U','19-04-17'),('Keely','Mercado','S8T7U','19-04-17'),('Stone','Flores','S3S1E','19-04-17'),('Karly','Clarke','T9F9W','19-04-16');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('August','Gallegos','F8V3Z','19-04-15'),('Pascale','Mccullough','I0Q1U','19-04-15'),('Isabella','Talley','W5E3G','19-04-17'),('Ingrid','Sampson','L9J9D','19-04-17'),('Cyrus','Woodward','D4E4L','19-04-15'),('Wade','Weaver','H5E9I','19-04-17'),('Breanna','Bass','N8U9K','19-04-17'),('Joan','Curtis','W2Q8O','19-04-16'),('Marcia','Watson','V7B5G','19-04-15'),('Lars','Foreman','C4N3P','19-04-17');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Branden','Alvarado','P9D4P','19-04-17'),('Adena','Kramer','Z7A0Z','19-04-15'),('Maite','Deleon','Q7U7A','19-04-17'),('Clayton','Harrison','Z7J1G','19-04-16'),('Samson','Daugherty','T9H0S','19-04-17'),('Bree','Dickson','A6N2H','19-04-16'),('Lawrence','Warner','X8G9A','19-04-15'),('Wang','Richards','R9Y8S','19-04-17'),('Yoko','Haynes','J4T8Q','19-04-17'),('Kasper','Bullock','U6Z2K','19-04-16');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Damian','Wheeler','X9F6H','19-04-15'),('Thane','Herring','O1R8A','19-04-15'),('Julian','Fry','B4S4N','19-04-17'),('Noah','Marshall','M2K0E','19-04-15'),('Slade','Riddle','T1D4K','19-04-16'),('Barry','Espinoza','K9R6W','19-04-17'),('Axel','Hoffman','Q0K1Z','19-04-16'),('Amy','Ewing','R1R0F','19-04-15'),('Ali','Black','O4L5F','19-04-15'),('Lucius','Morgan','C1Q3J','19-04-15');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Olivia','Rosales','B1C5A','19-04-15'),('Dylan','Lewis','H2A9F','19-04-17'),('Sandra','Johns','O0A4H','19-04-15'),('Myra','Stephens','P4E4B','19-04-16'),('Blaine','Simmons','W9T6I','19-04-17'),('Emily','Richard','A0K1M','19-04-17'),('Quintessa','Osborn','B8H1I','19-04-15'),('Cameron','Buckley','D2B1F','19-04-17'),('Edward','Perez','X1W8Y','19-04-16'),('Byron','Melendez','W3Z6V','19-04-16');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Jena','Hester','L2S3Q','19-04-17'),('Alfreda','Ortiz','H7X1P','19-04-16'),('Francesca','Delgado','T2F8I','19-04-16'),('Sage','Koch','E4B3Y','19-04-16'),('Iona','Morgan','P0B7B','19-04-17'),('Ima','Bradford','I8G6T','19-04-17'),('Imani','Perez','C6O7J','19-04-15'),('Curran','Rutledge','F2R5P','19-04-16'),('Karen','Nichols','K0W9M','19-04-15'),('Richard','Pittman','V0A6S','19-04-17');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Steven','Cohen','T3O5T','19-04-17'),('Dara','Osborne','I7C5C','19-04-16'),('Timothy','Walker','G9P1K','19-04-15'),('Kylee','Mckenzie','L6Y0D','19-04-17'),('Chanda','Booker','T6X2H','19-04-16'),('Luke','Wyatt','L6Y5X','19-04-15'),('Sydney','Burks','M2W7F','19-04-16'),('Mariam','Dixon','F8P5N','19-04-16'),('Susan','Hunter','X5R0A','19-04-15'),('Alec','Snow','F3W2L','19-04-17');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Scarlet','Dixon','P5U9M','19-04-15'),('Noelle','Miranda','X4A5C','19-04-16'),('Mariko','Solomon','P1O3P','19-04-17'),('Nathan','Martin','Q8B5T','19-04-16'),('Ryder','Willis','K4L9W','19-04-15'),('Kevin','Ballard','A9I2E','19-04-15'),('Leah','Knapp','H9H5P','19-04-16'),('Nita','Webb','A4Y7N','19-04-17'),('Jasmine','Yang','D6L6Z','19-04-16'),('Jacqueline','Cantrell','B1K5I','19-04-16');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Zoe','Huffman','H1C0V','19-04-17'),('Keane','House','F7W8C','19-04-15'),('Kane','Soto','D2S2R','19-04-16'),('Ulric','Salas','R6S8M','19-04-16'),('Sage','Watson','X9Z6M','19-04-15'),('Phillip','Hayden','L7P3N','19-04-15'),('Alexa','Conrad','X7X3B','19-04-17'),('Amena','Bonner','Q9F1R','19-04-15'),('Derek','Bradshaw','J2W1X','19-04-16'),('Tanek','Morin','Q7C6Q','19-04-16');
INSERT INTO "genScaffold" (firstname,surname,membertype,dateofbirth) VALUES ('Devin','Vazquez','P0X6H','19-04-16'),('Idona','Barker','X9B9L','19-04-15'),('Jocelyn','Pollard','N1X0S','19-04-16'),('Michael','Lamb','S3U1W','19-04-16'),('Matthew','Joseph','U2Z0H','19-04-17'),('Rogan','Dominguez','A4E0X','19-04-16'),('Chloe','Guzman','R1R2Z','19-04-16'),('Isabelle','Stark','B3Z7X','19-04-15'),('Hayes','Kaufman','Y6P1I','19-04-16'),('Drew','Henry','Q2T7U','19-04-15');


--
-- Table structures for testing generating scaffold compatible Windows / Unix
--
CREATE TABLE "customers" (
  id SERIAL PRIMARY KEY,
  firstname varchar(255) default NULL,
  surname varchar(255) default NULL,
  membertype varchar(255),
  dateofbirth varchar(255)
);

INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Geoffrey','Horne','A4X9V','19-04-16'),('Vielka','Vaughan','Q0N0T','19-04-15'),('Amery','Armstrong','T0Y1D','19-04-16'),('Malcolm','Rosario','E7D7H','19-04-16'),('Tanya','Stafford','P6X1A','19-04-17'),('Mannix','Jackson','G8Q8I','19-04-16'),('Uriah','Jensen','E6R4U','19-04-17'),('Keely','Mercado','S8T7U','19-04-17'),('Stone','Flores','S3S1E','19-04-17'),('Karly','Clarke','T9F9W','19-04-16');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('August','Gallegos','F8V3Z','19-04-15'),('Pascale','Mccullough','I0Q1U','19-04-15'),('Isabella','Talley','W5E3G','19-04-17'),('Ingrid','Sampson','L9J9D','19-04-17'),('Cyrus','Woodward','D4E4L','19-04-15'),('Wade','Weaver','H5E9I','19-04-17'),('Breanna','Bass','N8U9K','19-04-17'),('Joan','Curtis','W2Q8O','19-04-16'),('Marcia','Watson','V7B5G','19-04-15'),('Lars','Foreman','C4N3P','19-04-17');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Branden','Alvarado','P9D4P','19-04-17'),('Adena','Kramer','Z7A0Z','19-04-15'),('Maite','Deleon','Q7U7A','19-04-17'),('Clayton','Harrison','Z7J1G','19-04-16'),('Samson','Daugherty','T9H0S','19-04-17'),('Bree','Dickson','A6N2H','19-04-16'),('Lawrence','Warner','X8G9A','19-04-15'),('Wang','Richards','R9Y8S','19-04-17'),('Yoko','Haynes','J4T8Q','19-04-17'),('Kasper','Bullock','U6Z2K','19-04-16');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Damian','Wheeler','X9F6H','19-04-15'),('Thane','Herring','O1R8A','19-04-15'),('Julian','Fry','B4S4N','19-04-17'),('Noah','Marshall','M2K0E','19-04-15'),('Slade','Riddle','T1D4K','19-04-16'),('Barry','Espinoza','K9R6W','19-04-17'),('Axel','Hoffman','Q0K1Z','19-04-16'),('Amy','Ewing','R1R0F','19-04-15'),('Ali','Black','O4L5F','19-04-15'),('Lucius','Morgan','C1Q3J','19-04-15');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Olivia','Rosales','B1C5A','19-04-15'),('Dylan','Lewis','H2A9F','19-04-17'),('Sandra','Johns','O0A4H','19-04-15'),('Myra','Stephens','P4E4B','19-04-16'),('Blaine','Simmons','W9T6I','19-04-17'),('Emily','Richard','A0K1M','19-04-17'),('Quintessa','Osborn','B8H1I','19-04-15'),('Cameron','Buckley','D2B1F','19-04-17'),('Edward','Perez','X1W8Y','19-04-16'),('Byron','Melendez','W3Z6V','19-04-16');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Jena','Hester','L2S3Q','19-04-17'),('Alfreda','Ortiz','H7X1P','19-04-16'),('Francesca','Delgado','T2F8I','19-04-16'),('Sage','Koch','E4B3Y','19-04-16'),('Iona','Morgan','P0B7B','19-04-17'),('Ima','Bradford','I8G6T','19-04-17'),('Imani','Perez','C6O7J','19-04-15'),('Curran','Rutledge','F2R5P','19-04-16'),('Karen','Nichols','K0W9M','19-04-15'),('Richard','Pittman','V0A6S','19-04-17');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Steven','Cohen','T3O5T','19-04-17'),('Dara','Osborne','I7C5C','19-04-16'),('Timothy','Walker','G9P1K','19-04-15'),('Kylee','Mckenzie','L6Y0D','19-04-17'),('Chanda','Booker','T6X2H','19-04-16'),('Luke','Wyatt','L6Y5X','19-04-15'),('Sydney','Burks','M2W7F','19-04-16'),('Mariam','Dixon','F8P5N','19-04-16'),('Susan','Hunter','X5R0A','19-04-15'),('Alec','Snow','F3W2L','19-04-17');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Scarlet','Dixon','P5U9M','19-04-15'),('Noelle','Miranda','X4A5C','19-04-16'),('Mariko','Solomon','P1O3P','19-04-17'),('Nathan','Martin','Q8B5T','19-04-16'),('Ryder','Willis','K4L9W','19-04-15'),('Kevin','Ballard','A9I2E','19-04-15'),('Leah','Knapp','H9H5P','19-04-16'),('Nita','Webb','A4Y7N','19-04-17'),('Jasmine','Yang','D6L6Z','19-04-16'),('Jacqueline','Cantrell','B1K5I','19-04-16');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Zoe','Huffman','H1C0V','19-04-17'),('Keane','House','F7W8C','19-04-15'),('Kane','Soto','D2S2R','19-04-16'),('Ulric','Salas','R6S8M','19-04-16'),('Sage','Watson','X9Z6M','19-04-15'),('Phillip','Hayden','L7P3N','19-04-15'),('Alexa','Conrad','X7X3B','19-04-17'),('Amena','Bonner','Q9F1R','19-04-15'),('Derek','Bradshaw','J2W1X','19-04-16'),('Tanek','Morin','Q7C6Q','19-04-16');
INSERT INTO "customers" (firstname,surname,membertype,dateofbirth) VALUES ('Devin','Vazquez','P0X6H','19-04-16'),('Idona','Barker','X9B9L','19-04-15'),('Jocelyn','Pollard','N1X0S','19-04-16'),('Michael','Lamb','S3U1W','19-04-16'),('Matthew','Joseph','U2Z0H','19-04-17'),('Rogan','Dominguez','A4E0X','19-04-16'),('Chloe','Guzman','R1R2Z','19-04-16'),('Isabelle','Stark','B3Z7X','19-04-15'),('Hayes','Kaufman','Y6P1I','19-04-16'),('Drew','Henry','Q2T7U','19-04-15');
