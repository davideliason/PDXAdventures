--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
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

--
-- Name: activities; Type: TABLE; Schema: public; Owner: brian; Tablespace: 
--

CREATE TABLE activities (
    id integer NOT NULL,
    activity_name character varying
);


ALTER TABLE public.activities OWNER TO brian;

--
-- Name: activities_events; Type: TABLE; Schema: public; Owner: brian; Tablespace: 
--

CREATE TABLE activities_events (
    id integer NOT NULL,
    activity_id integer,
    event_id integer
);


ALTER TABLE public.activities_events OWNER TO brian;

--
-- Name: activities_events_id_seq; Type: SEQUENCE; Schema: public; Owner: brian
--

CREATE SEQUENCE activities_events_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activities_events_id_seq OWNER TO brian;

--
-- Name: activities_events_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brian
--

ALTER SEQUENCE activities_events_id_seq OWNED BY activities_events.id;


--
-- Name: activities_id_seq; Type: SEQUENCE; Schema: public; Owner: brian
--

CREATE SEQUENCE activities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activities_id_seq OWNER TO brian;

--
-- Name: activities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brian
--

ALTER SEQUENCE activities_id_seq OWNED BY activities.id;


--
-- Name: events; Type: TABLE; Schema: public; Owner: brian; Tablespace: 
--

CREATE TABLE events (
    id integer NOT NULL,
    date_event timestamp without time zone,
    description character varying,
    event_name character varying,
    location character varying,
    user_id integer
);


ALTER TABLE public.events OWNER TO brian;

--
-- Name: events_id_seq; Type: SEQUENCE; Schema: public; Owner: brian
--

CREATE SEQUENCE events_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.events_id_seq OWNER TO brian;

--
-- Name: events_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brian
--

ALTER SEQUENCE events_id_seq OWNED BY events.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: brian; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying,
    email character varying,
    phone character varying
);


ALTER TABLE public.users OWNER TO brian;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: brian
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO brian;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: brian
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brian
--

ALTER TABLE ONLY activities ALTER COLUMN id SET DEFAULT nextval('activities_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brian
--

ALTER TABLE ONLY activities_events ALTER COLUMN id SET DEFAULT nextval('activities_events_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brian
--

ALTER TABLE ONLY events ALTER COLUMN id SET DEFAULT nextval('events_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: brian
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: activities; Type: TABLE DATA; Schema: public; Owner: brian
--

COPY activities (id, activity_name) FROM stdin;
1	outdoors
2	soccer
3	biking
4	swimming
5	dog-friendly
\.


--
-- Data for Name: activities_events; Type: TABLE DATA; Schema: public; Owner: brian
--

COPY activities_events (id, activity_id, event_id) FROM stdin;
1	1	2
2	2	2
3	3	2
4	4	2
5	1	3
6	2	3
7	3	3
8	4	3
\.


--
-- Name: activities_events_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brian
--

SELECT pg_catalog.setval('activities_events_id_seq', 8, true);


--
-- Name: activities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brian
--

SELECT pg_catalog.setval('activities_id_seq', 5, true);


--
-- Data for Name: events; Type: TABLE DATA; Schema: public; Owner: brian
--

COPY events (id, date_event, description, event_name, location, user_id) FROM stdin;
1	2015-04-10 11:00:00	Bridge to Brews is a fun and unique event that has grown to be one of the largest in the area. The event continues to be the only running / walking event to take participants over the Fremont Bridge, offering very unique views of the city! We also continue to provide tons of entertainment on the course, great race support, chip timing and a fun kid’s area. http://terrapinevents.com/event/bridge-to-brews-portland-8k-10k-run/	Bridge To Brews	Road Runner Sports 29 NW 23rd Place - Portland	4
2	2015-04-02 14:00:00	Learn all about Portland’s vibrant beer culture and explore Old Town’s best bars and breweries and on this brewery tour. Your tour guide and Professional Beer Judge will introduce you to Portland’s finest beer at award winning local breweries. From local IPA’s to Irish Reds and creamy milk Stouts, you will taste 12 frothy local beers.	Rock Bottom Brewing	BeerQuest Brewery Tour	1
3	2015-02-04 00:00:00	Learn all about Portland’s vibrant beer culture and explore Old Town’s best bars and breweries and on this brewery tour. Your tour guide and Professional Beer Judge will introduce you to Portland’s finest beer at award winning local breweries. From local IPA’s to Irish Reds and creamy milk Stouts, you will taste 12 frothy local beers.	BeerQuest Brewery Tour	Rock Bottom Brewing, Portland, OR	2
\.


--
-- Name: events_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brian
--

SELECT pg_catalog.setval('events_id_seq', 3, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: brian
--

COPY users (id, name, email, phone) FROM stdin;
1	Shady	McShaderson	1234
2	Shady	McShaderson	1234
3	Shady	McShaderson	1234
4	Shady	McShaderson	1234
5	Shady	McShaderson	1234
6	Shady	McShaderson	1234
7	Shady	McShaderson	1234
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: brian
--

SELECT pg_catalog.setval('users_id_seq', 7, true);


--
-- Name: activities_events_pkey; Type: CONSTRAINT; Schema: public; Owner: brian; Tablespace: 
--

ALTER TABLE ONLY activities_events
    ADD CONSTRAINT activities_events_pkey PRIMARY KEY (id);


--
-- Name: activities_pkey; Type: CONSTRAINT; Schema: public; Owner: brian; Tablespace: 
--

ALTER TABLE ONLY activities
    ADD CONSTRAINT activities_pkey PRIMARY KEY (id);


--
-- Name: events_pkey; Type: CONSTRAINT; Schema: public; Owner: brian; Tablespace: 
--

ALTER TABLE ONLY events
    ADD CONSTRAINT events_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: brian; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

