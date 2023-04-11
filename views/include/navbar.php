
<nav class="navbar navbar-expand-lg bg-gold shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="../accueil.php?month=<?=date('m')?>&year=<?=date('Y')?>"><img src="/assets/img/calendar.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse lien" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="../accueil.php?month=<?=date('m')?>&year=<?=date('Y')?>">Accueil</a>
        <a class="nav-link" href="../documents.php">Documents</a>
        <a class="nav-link" href="../evenements.php">Événements</a>
        <a class="nav-link" href="../infos.php">Mes infos</a>
      </div>

      <div><a class="nav-link deco" href="../connexion.php?logout">Déconnexion</a></div>
    </div>
  </div>
</nav>



<script>
  
</script>

