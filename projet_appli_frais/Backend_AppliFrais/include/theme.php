<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
body, h1, h2, h3, h4, h5, h6, p, ul, li {
  margin: 0;
  padding: 0;
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f4f4f4;
  box-sizing: border-box;
}


.dashboard-container {
    margin: 20px;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.img_main{

    text-align: center;
    align-items: center;
    align-self: center;
    margin-left: 20px;
    border-left: 20px;
    padding-left: 20px ;
    display: flex ;
    position: absolute;
}


.h1_ndf{
    text-align: center;
}
header {
  background-color: #412b6b;
  color: #fff;
  padding: 15px;
  text-align: center;
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #412b6b;

}

nav{
    display: flex;
    justify-content: space-around;
    background-color: #444;
    overflow: hidden;
}

.img_nav{
    max-width: 15%;
    height: auto;
    display: block;
    margin: 0 auto;
}

nav a {
    display: block;
    padding: 14px 16px;
    text-decoration: none;
    color: white;
    text-align: center;
}

nav a:hover {
    background-color: #ddd;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #444;
    color: white;
}

@media only screen and (max-width: 600px) {
            nav {
                flex-direction: column;
            }

            nav a {
                width: 100%;
                text-align: left;
            }
        }

</style>
<body>

<nav>
    <a href="index.php" ><img class="img_nav" src="media_back\LogoSwissPharma.png" alt="Membre1"></a>
    <a href="index.php">Menu</a>
    <a href="suivie_facture.php">Mes Notes de Frais</a>
</nav>

    
</body>
</html>