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
