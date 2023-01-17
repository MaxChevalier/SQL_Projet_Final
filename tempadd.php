
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="add.js"></script>
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="civilite">civilité</label>
        <select name="civilite">
            <option value="M">M</option>
            <option value="Mme">Mme</option>
            <option value="Autre">Autre</option>
        </section>
        <label for="name">Nom</label>
        <input type="text" name="name" placeholder="Nom">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" placeholder="Prénom">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email">
        <label for="phone">Téléphone</label>
        <input type="text" name="phone" placeholder="Phone">
        <label for="address">Adresse</label>
        <input type="text" name="address" placeholder="Address">
        <label for="arrivalDate">Date d'arrivé</label>
        <input type="date" name="arrivalDate" placeholder="Date d'arrivé">
        <label for="idPost">Post</label>
        <select name="idPost">
            <script>showPost</script>
        </select>
        <label for="idDepartment">Département</label>
        <select name="idDepartment">
            <script>showDepartment</script>
        </select>
        <button type="submit">Ajouter</button>
    </form>
    <?php include 'show employes.php'; ?>
</body>
</html>