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
GRANT ALL PRIVILEGES ON DATABASE devtools TO devtools;

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
