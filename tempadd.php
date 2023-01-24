<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="add.js"></script>
    <link rel="stylesheet" href="home.css">
    <title>Document</title>
</head>

<body>
    <div class="popUpAddEmployer">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="civilite">civilité : </label>
                    </td>
                    <td>
                        <select name="civilite">
                            <option value="M">M</option>
                            <option value="Mme">Mme</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Nom : </label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Nom" maxlength="50">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="firstname">Prénom : </label>
                    </td>
                    <td>
                        <input type="text" name="firstname" placeholder="Prénom">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email : </label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone">Téléphone : </label>
                    </td>
                    <td>
                        <input type="text" name="phone" placeholder="Phone">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Adresse : </label>
                    </td>
                    <td>
                        <input type="text" name="address" placeholder="Address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="arrivalDate">Date d'arrivé : </label>
                    </td>
                    <td>
                        <input type="date" name="arrivalDate" placeholder="Date d'arrivé">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="idPost">Post : </label>
                    </td>
                    <td>
                        <select name="idPost">
                            <script>
                                showPost()
                            </script>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="idDepartment">Département : </label>
                    </td>
                    <td>
                        <select name="idDepartment">
                            <script>
                                showDepartment()
                            </script>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>