--
-- PostgreSQL database dump
--

-- Dumped from database version 17.3
-- Dumped by pg_dump version 17.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: actualizar_campos_calculados(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.actualizar_campos_calculados() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Calcular necesidad
    NEW.necesidad := (NEW.inventario_actual - NEW.stock_seguridad) - NEW.consumo;
    -- Calcular final_teorico
    NEW.final_teorico := (NEW.inventario_actual - NEW.stock_seguridad ) - NEW.consumo_mrp + NEW.pedido;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.actualizar_campos_calculados() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: credenciales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.credenciales (
    id_usuario integer NOT NULL,
    "contraseña" character varying(8) NOT NULL,
    CONSTRAINT "credenciales_contraseña_check" CHECK ((("contraseña")::text ~ '^[A-Za-z0-9]{8}$'::text))
);


ALTER TABLE public.credenciales OWNER TO postgres;

--
-- Name: plan_compras; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plan_compras (
    referencia character varying(7) NOT NULL,
    materia_prima character varying(50) NOT NULL,
    inventario_actual integer NOT NULL,
    cantidad character varying(50) NOT NULL,
    stock_seguridad integer NOT NULL,
    final_teorico_rotura_stock integer GENERATED ALWAYS AS ((inventario_actual - stock_seguridad)) STORED,
    consumo_mrp integer NOT NULL,
    consumo integer NOT NULL,
    necesidad integer,
    pedido integer NOT NULL,
    final_teorico integer,
    CONSTRAINT inventario_consumo_check CHECK ((consumo >= 0)),
    CONSTRAINT inventario_consumo_mrp_check CHECK ((consumo_mrp >= 0)),
    CONSTRAINT inventario_inventario_actual_check CHECK ((inventario_actual >= 0)),
    CONSTRAINT inventario_pedido_check CHECK ((pedido >= 0)),
    CONSTRAINT inventario_stock_seguridad_check CHECK ((stock_seguridad >= 0))
);


ALTER TABLE public.plan_compras OWNER TO postgres;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    correo_electronico character varying(150) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: credenciales credenciales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credenciales
    ADD CONSTRAINT credenciales_pkey PRIMARY KEY (id_usuario);


--
-- Name: plan_compras inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plan_compras
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (referencia);


--
-- Name: usuarios usuarios_correo_electronico_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_electronico_key UNIQUE (correo_electronico);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: plan_compras trg_actualizar_campos; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trg_actualizar_campos BEFORE INSERT OR UPDATE ON public.plan_compras FOR EACH ROW EXECUTE FUNCTION public.actualizar_campos_calculados();


--
-- Name: credenciales credenciales_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.credenciales
    ADD CONSTRAINT credenciales_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

