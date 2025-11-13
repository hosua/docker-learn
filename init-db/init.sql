-- Create tables
CREATE TABLE public.people (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    age INT
);

CREATE TABLE public.chat (
    id integer NOT NULL,
    "user" character varying(32) NOT NULL,
    log character varying(512) NOT NULL,
    ts timestamp without time zone NOT NULL
);

-- Grant privileges to admin
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO admin;
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE public.people TO admin;

-- Optional: create anon role for PostgREST
CREATE ROLE anon NOLOGIN;
GRANT USAGE ON SCHEMA public TO anon;
GRANT SELECT ON TABLE public.people TO anon;

