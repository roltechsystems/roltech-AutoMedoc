-- Adminer 4.8.0 PostgreSQL 13.2 dump

DROP TABLE IF EXISTS "access_log";
DROP SEQUENCE IF EXISTS access_log_idaccesslog_seq;
CREATE SEQUENCE access_log_idaccesslog_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 3923 CACHE 1;

CREATE TABLE "public"."access_log" (
    "idaccesslog" bigint DEFAULT nextval('access_log_idaccesslog_seq') NOT NULL,
    "dateevent" timestamp,
    "typeevent" character varying(255),
    "levelevent" character varying(55),
    "eventmessage" json,
    "iduser" bigint,
    CONSTRAINT "pk_access_log_idaccesslog" PRIMARY KEY ("idaccesslog")
) WITH (oids = false);

INSERT INTO "access_log" ("idaccesslog", "dateevent", "typeevent", "levelevent", "eventmessage", "iduser") VALUES
(3857,	'2021-05-16 10:52:29',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\User\\Controller\\NavigationController\\navigationadmin"}}',	NULL),
(3858,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3859,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3860,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3861,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3862,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3863,	'2021-05-16 10:52:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3864,	'2021-05-16 10:52:31',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3865,	'2021-05-16 10:52:31',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3866,	'2021-05-16 10:52:52',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3867,	'2021-05-16 10:52:52',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3868,	'2021-05-16 10:53:16',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\gestion-role"}}',	NULL),
(3869,	'2021-05-16 10:53:17',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3870,	'2021-05-16 10:53:17',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3871,	'2021-05-16 10:53:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3872,	'2021-05-16 10:53:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":""}}',	NULL),
(3873,	'2021-05-16 10:53:19',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\tree-role"}}',	NULL),
(3874,	'2021-05-16 10:53:21',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\index"}}',	NULL),
(3875,	'2021-05-16 10:53:21',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\index"}}',	NULL),
(3876,	'2021-05-16 10:53:22',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3877,	'2021-05-16 10:53:23',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3878,	'2021-05-16 10:53:24',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3879,	'2021-05-16 10:53:25',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3880,	'2021-05-16 10:53:25',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3881,	'2021-05-16 10:53:26',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3882,	'2021-05-16 10:53:27',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3883,	'2021-05-16 10:53:28',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3884,	'2021-05-16 10:53:30',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3885,	'2021-05-16 10:53:31',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3886,	'2021-05-16 10:53:33',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3887,	'2021-05-16 10:53:40',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3888,	'2021-05-16 10:53:41',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3889,	'2021-05-16 10:53:42',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3890,	'2021-05-16 10:53:43',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3891,	'2021-05-16 10:53:48',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3892,	'2021-05-16 10:53:56',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3893,	'2021-05-16 10:53:58',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3894,	'2021-05-16 10:54:02',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3895,	'2021-05-16 10:54:07',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\index"}}',	NULL),
(3896,	'2021-05-16 10:54:07',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\RolesController\\index"}}',	NULL),
(3897,	'2021-05-16 10:54:07',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\System\\Controller\\PrivilegeController\\edit"}}',	NULL),
(3898,	'2021-05-16 10:54:08',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"2\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3899,	'2021-05-16 10:54:08',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"2\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3900,	'2021-05-16 10:54:10',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3901,	'2021-05-16 10:54:10',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3902,	'2021-05-16 10:54:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3903,	'2021-05-16 10:54:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3904,	'2021-05-16 10:54:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3905,	'2021-05-16 10:54:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3906,	'2021-05-16 10:54:31',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3907,	'2021-05-16 10:54:31',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3908,	'2021-05-16 10:55:42',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3909,	'2021-05-16 10:55:42',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3910,	'2021-05-16 10:55:53',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"dispatch.error","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3911,	'2021-05-16 10:55:53',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3912,	'2021-05-16 10:56:59',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3913,	'2021-05-16 10:57:06',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3914,	'2021-05-16 10:57:08',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3915,	'2021-05-16 10:57:10',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3916,	'2021-05-16 10:57:14',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"1\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3917,	'2021-05-16 10:57:15',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"2\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3918,	'2021-05-16 10:57:16',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"3\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3919,	'2021-05-16 10:57:17',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"5\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3920,	'2021-05-16 10:57:18',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"7\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3921,	'2021-05-16 10:57:19',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"8\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3922,	'2021-05-16 10:57:20',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"9\\System\\Controller\\PrivilegeController\\assigne-droit"}}',	NULL),
(3923,	'2021-05-16 10:57:29',	NULL,	'6',	'{"user":"dev.roltechsystems@gmail.com","event":"finish","jobs":{"role":"super-administrateur","routes":"\\User\\Controller\\LogoutController\\index"}}',	NULL);

DROP TABLE IF EXISTS "access_menu";
DROP SEQUENCE IF EXISTS access_menu_id_seq;
CREATE SEQUENCE access_menu_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."access_menu" (
    "submenuid" bigint,
    "menu_label" character varying(512),
    "menuroute" character varying(512),
    "menu_help" text,
    "resource_id" bigint,
    "access_menu_id" bigint DEFAULT nextval('access_menu_id_seq') NOT NULL,
    "templatemenuattribute" json,
    "ordreaffichage" integer,
    "idaccessmodule" bigint,
    CONSTRAINT "pk_access_menu_access_menu_id" PRIMARY KEY ("access_menu_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "access_mode";
CREATE TABLE "public"."access_mode" (
    "idaccessmode" character varying(55) NOT NULL,
    "labelaccessmode" character varying(512),
    "descaccessmode" text,
    CONSTRAINT "pk_access_mode_idaccessmode" PRIMARY KEY ("idaccessmode")
) WITH (oids = false);

INSERT INTO "access_mode" ("idaccessmode", "labelaccessmode", "descaccessmode") VALUES
('Administration',	'Administration',	'Administration'),
('Consultation',	'Consultation',	'Consultation'),
('Impression',	'Impression',	'Impression'),
('Libre',	'Libre',	'Libre'),
('EnvoiMail',	'Envoi des mails',	'Action d''Envoi des mails');

DROP TABLE IF EXISTS "access_modules";
DROP SEQUENCE IF EXISTS access_modules_access_module_id_seq;
CREATE SEQUENCE access_modules_access_module_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."access_modules" (
    "access_module_id" bigint DEFAULT nextval('access_modules_access_module_id_seq') NOT NULL,
    "module_name" character varying(255),
    "module_descrept" text,
    "module_afficher" boolean DEFAULT true,
    "templateattruibute" json,
    "moduleroute" character varying(512),
    CONSTRAINT "pk_access_modules_access_module_id" PRIMARY KEY ("access_module_id")
) WITH (oids = false);

INSERT INTO "access_modules" ("access_module_id", "module_name", "module_descrept", "module_afficher", "templateattruibute", "moduleroute") VALUES
(1,	'invite',	'module accés sans authentification',	'f',	NULL,	NULL),
(2,	'profil',	'Profil utilisateur',	't',	NULL,	NULL),
(3,	'Système',	'Système',	't',	NULL,	NULL),
(4,	'Stock',	'Stock',	't',	NULL,	NULL),
(5,	'Commande',	'Commande',	't',	NULL,	NULL),
(7,	'EntreeStock',	'EntreeStock',	't',	NULL,	NULL),
(8,	'Préventif',	'Préventif',	't',	NULL,	NULL),
(9,	'Statistique',	'Statistique',	't',	NULL,	NULL);

DROP TABLE IF EXISTS "access_privileges";
CREATE TABLE "public"."access_privileges" (
    "resource_id" bigint NOT NULL,
    "role_id" character varying(150) NOT NULL,
    CONSTRAINT "pk_tbl_resource_id" PRIMARY KEY ("resource_id", "role_id")
) WITH (oids = false);

INSERT INTO "access_privileges" ("resource_id", "role_id") VALUES
(1,	'invite'),
(2,	'invite'),
(3,	'invite'),
(4,	'invite'),
(5,	'invite'),
(6,	'invite'),
(11,	'invite'),
(12,	'super-administrateur'),
(14,	'super-administrateur'),
(15,	'super-administrateur'),
(16,	'super-administrateur'),
(19,	'super-administrateur'),
(17,	'super-administrateur'),
(23,	'super-administrateur'),
(25,	'super-administrateur'),
(26,	'super-administrateur'),
(2,	'super-administrateur'),
(1,	'super-administrateur'),
(3,	'super-administrateur'),
(4,	'super-administrateur'),
(5,	'super-administrateur'),
(6,	'super-administrateur'),
(11,	'super-administrateur'),
(10,	'super-administrateur'),
(9,	'super-administrateur'),
(27,	'super-administrateur'),
(28,	'super-administrateur'),
(29,	'super-administrateur'),
(30,	'super-administrateur'),
(31,	'super-administrateur'),
(38,	'super-administrateur'),
(13,	'super-administrateur'),
(20,	'super-administrateur'),
(22,	'super-administrateur'),
(24,	'super-administrateur'),
(21,	'super-administrateur'),
(32,	'super-administrateur'),
(37,	'super-administrateur'),
(51,	'super-administrateur'),
(52,	'super-administrateur'),
(54,	'super-administrateur'),
(55,	'super-administrateur'),
(53,	'super-administrateur'),
(56,	'super-administrateur'),
(58,	'super-administrateur'),
(57,	'super-administrateur'),
(59,	'super-administrateur');

DROP TABLE IF EXISTS "access_resources";
DROP SEQUENCE IF EXISTS resources_resource_id_seq;
CREATE SEQUENCE resources_resource_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."access_resources" (
    "resource_id" bigint DEFAULT nextval('resources_resource_id_seq') NOT NULL,
    "module" character varying(255),
    "controller" character varying(255),
    "action" character varying(255),
    "idaccessmodules" bigint,
    "resources_descrept" text,
    "idaccessmode" character varying(55),
    CONSTRAINT "pk_resources_resource_id" PRIMARY KEY ("resource_id")
) WITH (oids = false);

INSERT INTO "access_resources" ("resource_id", "module", "controller", "action", "idaccessmodules", "resources_descrept", "idaccessmode") VALUES
(1,	'user',	'login',	'index',	1,	NULL,	'Libre'),
(2,	'user',	'logout',	'index',	1,	NULL,	'Libre'),
(3,	'user',	'password',	'forgot',	1,	NULL,	'Libre'),
(4,	'user',	'password',	'reset',	1,	NULL,	'Libre'),
(5,	'application',	'index',	'index',	1,	'Application access',	'Libre'),
(6,	'user',	'auth',	'create',	1,	'creation compte',	'Libre'),
(9,	'user',	'profile',	'uploadimage',	2,	'upload image de profil',	'Libre'),
(10,	'user',	'profile',	'cropimage',	2,	'crop image de profil',	'Libre'),
(11,	'user',	'login',	'login-admin',	1,	'Authentification pour Administration',	'Libre'),
(12,	'system',	'ressources',	'edit',	3,	'',	'Administration'),
(13,	'system',	'ressources',	'index',	3,	'',	'Consultation'),
(14,	'system',	'ressources',	'deleteressources',	3,	'',	'Administration'),
(15,	'system',	'ressources',	'updateressources',	3,	'',	'Administration'),
(16,	'system',	'ressources',	'save-ressources',	3,	'',	'Administration'),
(17,	'user',	'navigation',	'navigationadmin',	2,	'Menu d''acceuil d''administration qui contien tout les module et les lien associé',	'Consultation'),
(19,	'system',	'privilege',	'edit',	3,	'edition des droits',	'Administration'),
(20,	'system',	'privilege',	'index',	3,	'affichage des prévilege utilisateur',	'Consultation'),
(21,	'system',	'roles',	'tree-role',	3,	'<b>Json action </b> : Générer la liste des  rôles dans une structure  <b>Json : </b> ',	'Consultation'),
(22,	'system',	'roles',	'gestion-role',	3,	'Gestion des role apartir de tree des roles',	'Consultation'),
(23,	'system',	'roles',	'edit',	3,	'Ajouter un rôle a l''application, un rôle correspond a un ensemble de droit à gérer',	'Administration'),
(24,	'system',	'roles',	'index',	3,	'Liste les rôles de l''application ',	'Consultation'),
(25,	'system',	'privilege',	'assigne-droit',	3,	'assigner un privilége a un role',	'Administration'),
(26,	'system',	'privilege',	'update-privilege',	3,	'Ajouter un prévilége à un ressource',	'Administration'),
(27,	'system',	'privilege',	'assigner-mode-module',	3,	'Assigner plusieurs ressource de même module et de même mode',	'Administration'),
(28,	'system',	'roles',	'save-role',	3,	'save-role',	'Administration'),
(29,	'system',	'roles',	'delete-role',	3,	'supprimer un role : affecté les role déjà assigné au utilisateur a null et supprimer les droit donnée a ce role et supprimer le role ',	'Administration'),
(30,	'system',	'ressources',	'tree-ressources',	3,	'affichage de ressources',	'Administration'),
(31,	'system',	'ressources',	'gestion-ressources',	3,	'affichage de ressources',	'Administration'),
(32,	'system',	'ressources',	'filter-module',	3,	'Filter ressource pas module',	'Consultation'),
(37,	'system',	'appmodules',	'index',	3,	'Gestion des module de l''application',	'Consultation'),
(38,	'system',	'appmodules',	'edit',	3,	'Gestion des module de l''application',	'Administration'),
(51,	'system',	'menu',	'tree-menu',	3,	'menu',	'Consultation'),
(52,	'system',	'menu',	'gestion-menu',	3,	'menu',	'Consultation'),
(53,	'system',	'menu',	'add-menu',	3,	'add-menu',	'Administration'),
(54,	'system',	'menu',	'index',	3,	'add-menu',	'Consultation'),
(55,	'system',	'menu',	'save-menu',	3,	'add-menu',	'Administration'),
(56,	'system',	'menu',	'delete-menu',	3,	'delete-menu',	'Administration'),
(57,	'system',	'menu',	'menu-menu',	3,	'menu-menu menu de gestion',	'Consultation'),
(58,	'system',	'menu',	'menu-module',	3,	'menu-module menu de gestion de module de menu',	'Consultation'),
(59,	'system',	'ressources',	'getoption-ressource',	3,	'getoption-ressource',	'Consultation');

DROP TABLE IF EXISTS "access_rolemodule";
CREATE TABLE "public"."access_rolemodule" (
    "role_id" character varying(150) NOT NULL,
    "access_module_id" bigint NOT NULL,
    "idaccessmode" character varying(55) NOT NULL,
    CONSTRAINT "pk_access_rolemodule_role_id" PRIMARY KEY ("role_id", "access_module_id", "idaccessmode")
) WITH (oids = false);

INSERT INTO "access_rolemodule" ("role_id", "access_module_id", "idaccessmode") VALUES
('super-administrateur',	3,	'Administration'),
('super-administrateur',	1,	'Administration'),
('super-administrateur',	1,	'Consultation'),
('super-administrateur',	1,	'Impression'),
('super-administrateur',	1,	'Libre'),
('super-administrateur',	1,	'EnvoiMail'),
('super-administrateur',	2,	'Administration'),
('super-administrateur',	2,	'Consultation'),
('super-administrateur',	2,	'Impression'),
('super-administrateur',	2,	'Libre'),
('super-administrateur',	2,	'EnvoiMail'),
('super-administrateur',	3,	'Impression'),
('super-administrateur',	3,	'Libre'),
('super-administrateur',	3,	'EnvoiMail'),
('invite',	1,	'Administration'),
('invite',	1,	'Consultation'),
('invite',	1,	'Impression'),
('invite',	1,	'Libre'),
('invite',	1,	'EnvoiMail');

DROP TABLE IF EXISTS "access_roles";
CREATE TABLE "public"."access_roles" (
    "role_id" character varying(150) NOT NULL,
    "role_name" character varying(255),
    "role_descrept" text,
    CONSTRAINT "pk_roles_role_id" PRIMARY KEY ("role_id")
) WITH (oids = false);

INSERT INTO "access_roles" ("role_id", "role_name", "role_descrept") VALUES
('invite',	'invite',	'Aucune authentification necessaire'),
('super-administrateur',	'super-administrateur',	'Le profile systéme avec la totalité d''accès'),
('Responsable-stock',	'Responsable-stock',	'Responsable-stock'),
('Responsable-commande',	'Responsable-commande',	'Responsable-commande');

DROP TABLE IF EXISTS "oauth_users";
DROP SEQUENCE IF EXISTS oauth_users_iduser_seq;
CREATE SEQUENCE oauth_users_iduser_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."oauth_users" (
    "email" character varying(512) NOT NULL,
    "changermotdepasse" boolean,
    "password" character varying(2000),
    "first_name" character varying(255),
    "last_name" character varying(255),
    "datechangepwd" date,
    "views" integer,
    "created" date,
    "modified" date,
    "historiqueaccount" json,
    "confirmer" boolean DEFAULT false,
    "role_id" character varying(150),
    "active" integer DEFAULT '1',
    "iduser" bigint DEFAULT nextval('oauth_users_iduser_seq') NOT NULL,
    CONSTRAINT "pk_oauth_users_iduser" PRIMARY KEY ("iduser"),
    CONSTRAINT "unq_oauth_users _role_id" UNIQUE ("role_id")
) WITH (oids = false);

INSERT INTO "oauth_users" ("email", "changermotdepasse", "password", "first_name", "last_name", "datechangepwd", "views", "created", "modified", "historiqueaccount", "confirmer", "role_id", "active", "iduser") VALUES
('dev.roltechsystems@gmail.com',	NULL,	'$2y$10$PWDokF0XwptTr6ODV4fWT..9TwHj8EUjh22spzbmMi1bXbzSo.KEO',	'roltechsystems',	'roltechsystems',	NULL,	NULL,	'2021-03-23',	'2021-03-23',	NULL,	'f',	'super-administrateur',	1,	2);

ALTER TABLE ONLY "public"."access_log" ADD CONSTRAINT "fk_access_log_oauth_users" FOREIGN KEY (iduser) REFERENCES oauth_users(iduser) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."access_menu" ADD CONSTRAINT "fk_access_menu_access_menu" FOREIGN KEY (submenuid) REFERENCES access_menu(access_menu_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_menu" ADD CONSTRAINT "fk_access_menu_access_modules" FOREIGN KEY (idaccessmodule) REFERENCES access_modules(access_module_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_menu" ADD CONSTRAINT "fk_access_menu_access_resources" FOREIGN KEY (resource_id) REFERENCES access_resources(resource_id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."access_privileges" ADD CONSTRAINT "fk_access_privileges_access_resources" FOREIGN KEY (resource_id) REFERENCES access_resources(resource_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_privileges" ADD CONSTRAINT "fk_access_privileges_access_roles" FOREIGN KEY (role_id) REFERENCES access_roles(role_id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."access_resources" ADD CONSTRAINT "fk_access_resources_access_mode" FOREIGN KEY (idaccessmode) REFERENCES access_mode(idaccessmode) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_resources" ADD CONSTRAINT "fk_access_resources_access_modules" FOREIGN KEY (idaccessmodules) REFERENCES access_modules(access_module_id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."access_rolemodule" ADD CONSTRAINT "fk_access_rolemodule_access_mode" FOREIGN KEY (idaccessmode) REFERENCES access_mode(idaccessmode) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_rolemodule" ADD CONSTRAINT "fk_access_rolemodule_access_modules" FOREIGN KEY (access_module_id) REFERENCES access_modules(access_module_id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."access_rolemodule" ADD CONSTRAINT "fk_access_rolemodule_access_roles" FOREIGN KEY (role_id) REFERENCES access_roles(role_id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."oauth_users" ADD CONSTRAINT "fk_oauth_users _access_roles" FOREIGN KEY (role_id) REFERENCES access_roles(role_id) NOT DEFERRABLE;

-- 2021-05-16 09:04:29.571751+00
