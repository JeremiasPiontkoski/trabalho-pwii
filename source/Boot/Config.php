<?php
// DATABASE

define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "bd-tosolve"); // aqui deve ser alterado para o nome do banco de dados

// PROJECT URLs

define("CONF_URL_BASE", "http://www.localhost/trabalho-pwii"); // depois da / deve vir o nome da pasta do trabalho
define("CONF_URL_TEST", "http://www.localhost/trabalho-pwii"); // depois da / deve vir o nome da pasta do trabalho

// VIEW

define("CONF_VIEW_WEB", __DIR__ . "/../../themes/web");
define("CONF_VIEW_APP", __DIR__ . "/../../themes/app");
define("CONF_VIEW_ADMIN", __DIR__ . "/../../themes/adm");

// SITE

define("CONF_SITE_NAME", "To Solve");

define("CONF_UPLOAD_DIR", "storage");

define("CONF_UPLOAD_IMAGE_DIR", "images");

define("CONF_UPLOAD_FILE_DIR", "files");