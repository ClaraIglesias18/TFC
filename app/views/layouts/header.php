<!DOCTYPE html>
<html>

<head>
    <title><?php echo $pageTitle; ?></title>
    <style>
        header,
        footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            background-color: blue;
            color: #ddd;
        }

        h1, #cerrar, #version {
            margin: 10px;
        }


        a:hover {
            color: #ddd;
            text-decoration: none;

        }

        a:visited {
            color: #ddd;
            text-decoration: none;
        }

        a:link {
            color: #ddd;
            text-decoration: none;
        }

        h1 {
            padding: 0;
            margin: 3px;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            display: flex;
            flex-direction: row;
            height: 70vh;
            gap: 50px;
        }

        .vertical-menu {
            background-color: coral;
            flex-grow: 1;
        }

        .pagina {
            flex-grow: 7;
            padding: 10px;
        }


        .vertical-menu a {
            padding: 10px 8px;
            text-decoration: none;
            color: #343a40;
            display: block;
        }

        .vertical-menu a:hover {
            background-color: #e9ecef;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <h1>Employee Portal</h1>
        <?php if (isset($_SESSION['idEmpleado'])) : ?>
            <a href="index.php?route=auth/logout" id="cerrar">Cerrar sesión</a>
        <?php endif; ?>
    </header>
    <main>
        <!-- Aquí coloca el contenido del cuerpo de la página -->
        <?php require_once 'app/views/layouts/menu.php'; ?>